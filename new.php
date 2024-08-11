
<body>
    <button onclick="captureFinger()">Click</button>
    <form method="post" id="template_1_form">
        <input type="text" value="" name="template_1" id="template_1">
    </form>
</body>
<script>
    function captureFinger(){
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

if(isset($_POST['template_1'])){
    $template_1 = $_POST['template_1'];
    echo $template_1;
}

$select_templates = $connection->prepare("SELECT * FROM `students`");
$select_templates->execute();

while($selected_template = $select_templates->fetch(PDO::FETCH_ASSOC))
{
    ?>
    <script>
        var template_1 = '<?= $template_1; ?>';
        var template_2 = '<?= $selected_template['fingerprint_template']; ?>;';
        matchScore(template_1, template_2);
        function matchScore(succFunction, failFunction) {
            if (template_1 == "" || template_2 == "") {
                alert("Please scan two fingers to verify!!");
                return;
            }
            var uri = "https://localhost:8443/SGIMatchScore";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    fpobject = JSON.parse(xmlhttp.responseText);
                    if(fpobject.ErrorCode == 0){
                        document.getElementById('returned_template').value = template_1;
                        document.getElementById('returning_form').submit();
                    }
                }
                else if (xmlhttp.status == 404){
                    alert("Page not FOund!!");
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
?>