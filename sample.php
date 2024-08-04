<?php include 'config/config.php';?>

<body>
    <button onclick="captureFP()">Clo</button>

    <form action="" id="template_1_form" method="post">
        <input type="hidden" name="template_1" id="template_1" value="">
    </form>

    <form method="POST" id="returning_form">
        <input type="text" name="returned_template" id="returned_template" value="">
    </form>
    </body>

<script>
    function captureFP(){
        document.getElementById('template_1').value = '';
        var uri = "https://localhost:8443/SGIFPCapture";
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function(){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
                fingerpring_object = JSON.parse(xmlhttp.responseText);
                if(fingerpring_object.ErrorCode == 0){
                    document.getElementById('template_1').value = fingerpring_object.TemplateBase64;
                    document.getElementById('template_1_form').submit();
                }
                else if(fingerpring_object.ErrorCode == 55){
                    alert('Connect the scanner and try again...');
                }
                else{
                    alert('Check wether driver installed correctly...');
                }

                }
            else if (xmlhttp.status == 404) {
                console.log('Error page not found');
                }
            }
            xmlhttp.open("POST", uri, true);
            xmlhttp.send();

            xmlhttp.onerror = function () {
                console.log("failed");
            }
    }
</script>
<?php
$select_fingers = $connection->prepare("SELECT * from `students`");
$select_fingers->execute();

if(isset($_POST['template_1'])){
    while($fingerprint_array = $select_fingers->fetch(PDO::FETCH_ASSOC)){
        ?>
        <script>
        var template1;
    
        var template_1 = '<?= $_POST['template_1']; ?>';
        var template_2 = '<?= $fingerprint_array['fingerprint_template']; ?>';
        matchScore(template_1, template_2);
        function matchScore(succFunction, failFunction) {
    
            if (template_1 == "" || template_2 == "") {
                alert("Please scan two fingers to verify!!");
                return;
            }
            var uri = "https://localhost:8443/SGIMatchScore";
    
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    fpobject = JSON.parse(xmlhttp.responseText);
                    if(fpobject.ErrorCode == 0){
                        document.getElementById('returned_template').value = template_1;
                        document.getElementById('returning_form').submit();
                    }
                }
                else if (xmlhttp.status == 404) {
                    failFunction(xmlhttp.status)
                }
            }
            var params = "template1=" + encodeURIComponent(template_1);
            params += "&template2=" + encodeURIComponent(template_2);
            xmlhttp.open("POST", uri, false);
            xmlhttp.send(params);
        }    
        </script>
        <?php
    }
}
else{
    echo 'not clicked';
}

if(isset($_POST['returned_template'])){
    
    $select_reg_no = $connection->prepare("SELECT * FROM `students` where fingerprint_template = ?");
    $select_reg_no->execute([$_POST['returned_template']]);
    while($selected_reg_no = $select_reg_no->fetch(PDO::FETCH_ASSOC))
    {
        echo $selected_reg_no['name'];
    }
}
?>