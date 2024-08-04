<?php include '../config/config.php'; ?>
<?php include 'common/header.php'; ?>

<?php
date_default_timezone_set("Asia/Calcutta");
if(!isset($_SESSION['Staff'])){
}
if(isset($_POST['start_session'])){
    $subject_id = $_POST['session_subject'];
    $capturing_by = $_POST['logged_user'];

    ?>
    <?php
}
captureFinger();
    
    $select_subject = $connection->prepare("SELECT * FROM `subjects` WHERE subject_name = ?");
    $select_subject->execute([$subject_id]);
    $select_sub = $select_subject->fetch(PDO::FETCH_ASSOC);
?>
        <div class="p-3" id="capture">
            <div class="container mx-auto rounded  bg-white align-items-center p-2">
                <h3 class="fw-bold mb-0 text-center text-black text-bold mb-3">Capturing Attendance</h3>
                <h6 class="fw-bold mb-0 text-start text-black text-bold mt-3 mb-0 p-0 ms-4">Attendance Details</h6>
    
                <div class="row justify-content-start ps-4 pt-3">
    
                    <div class="col-sm-4">
                        <p class="text-bold text-start text-bold"><b>Subject</b>&emsp;&emsp; &nbsp;: <?= $select_sub['subject_name']; ?></p>
                        <p class="text-bold text-start text-bold"><b>Date</b>&emsp; &emsp; &ensp;&nbsp;&nbsp; : <?= date('d-M-y'); ?></p>
                        <p class="text-bold text-start text-bold"><b>Time from</b>&nbsp; &nbsp; :  <?= date("h:iA"); ?></p>
                        <p class="text-bold text-start text-bold"><b>Time to</b>&emsp;&emsp;&nbsp; : ----- </p>
                    </div>
    
                    <div class="col-sm-4">
                        <p class="text-bold text-start text-bold"><b>Semester</b>&ensp;&ensp;&nbsp; : Semester 3</p>
                        <p class="text-bold text-start text-bold"><b>Admin</b>&emsp;&emsp;&ensp; : Shravan Jampanagoudra</p>
                        <p class="text-bold text-start text-bold"><b>Mode</b>&emsp; &ensp; &ensp;&nbsp; : Scanning Fingerprint</p>
                        <form>     
                            <input type="submit" name="cancel" class="btn btn-outline-danger" value="Cancel Attendance">
                            <input type="submit" name="stop" class="btn btn-outline-success" value="End Session">
                        </form>
                    </div>
    
                </div>
            </div>
        </div>

        <?php
function captureFinger() {
    $uri = "https://localhost:8443/SGIFPCapture";
    $ch = curl_init($uri);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200) {
        $fingerprint_object = json_decode($response);
        if ($fingerprint_object->ErrorCode == 0) {
            $fingerprint_template = $fingerprint_object->TemplateBase64;
            echo "<b>Scan Status</b> : Scanned successfully.";
            echo "<input type='hidden' id='fingerprint_template' value='" . htmlspecialchars($fingerprint_template) . "'>";
            echo "<script>document.getElementById('reg_form').submit();</script>";
        } elseif ($fingerprint_object->ErrorCode == 55) {
            echo "<script>alert('Connect the scanner and try again...');</script>";
        } else {
            echo "<script>alert('Check whether driver installed correctly...');</script>";
        }
    } elseif ($httpCode == 404) {
        error_log('Error page not found');
    }

    // Handle curl error
    if ($response === false) {
        error_log("failed");
    }
}
?>


<?php include 'common/footer.php'; ?>