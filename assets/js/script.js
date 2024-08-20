
    function captureFP(){
        var uri = "https://localhost:8443/SGIFPCapture";
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function(){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
                fingerpring_object = JSON.parse(xmlhttp.responseText);
                if(fingerpring_object.ErrorCode == 0){
                    var fingerprint_template = fingerpring_object.TemplateBase64;
                    document.getElementById('status').innerHTML = "<b>Scan Status</b> : Scanned successfully. Sending Mail....";
                    document.getElementById('fingerprint_template').value = fingerprint_template;
                    var form =document.getElementById('reg_form');
                    form.submit();
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