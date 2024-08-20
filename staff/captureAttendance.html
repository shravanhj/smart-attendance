<?php include '../config/config.php'; ?>
<?php include 'common/header.php'; ?>

<?php
date_default_timezone_set("Asia/Calcutta");
$today_date = date('Y-m-d');
if(isset($_SESSION['Staff']) || isset($_SESSION['Admin'])){
    if(isset($_SESSION['Staff'])){
        $logged_in_staff = $_SESSION['Staff'];
    }
    else{
        $logged_in_staff = $_SESSION['Admin'];
    }
}
else{
    header('Location:../index.php');
}

$select_logged_in_user = $connection->prepare("SELECT * FROM `staff_admin` WHERE unique_id = ?");
$select_logged_in_user->execute([$logged_in_staff]);
$logged_in_data = $select_logged_in_user->fetch(PDO::FETCH_ASSOC);

$ongoing_attendance = $connection->prepare("SELECT * FROM `ongoing_attendance` WHERE capturing_by = ? AND status = 'Capturing' ");
$ongoing_attendance->execute([$logged_in_data['staff_name']]);
$ongoing_attendance_data = $ongoing_attendance->fetch(PDO::FETCH_ASSOC);
$batch = $ongoing_attendance_data['batch'];

    $select_subject = $connection->prepare("SELECT * FROM `subjects` WHERE subject_name = ?");
    $select_subject->execute([$ongoing_attendance_data['subject']]);
    $select_sub = $select_subject->fetch(PDO::FETCH_ASSOC);
    $session_semester = $select_sub['semester'];


    $select_from_students_temp = $connection->prepare("SELECT * FROM `students` WHERE current_semester = ? LIMIT 1");
    $select_from_students_temp->execute([$session_semester]);
    if($select_from_students_temp->rowCount() <=0){
        echo "<script type='text/javascript'>alert('No Students present or registered for this semester yet.,,');window.location.href='sessionDetails.php';</script>";
    }

    $fetched_from_students = $select_from_students_temp->fetch(PDO::FETCH_ASSOC);
    $university_reg_no_temp = mb_strimwidth($fetched_from_students['reg_no'], 0, 9, '');

    if(isset($_POST['registration'])){
        $no = $_POST['registration'];
        $real_reg_no = $university_reg_no_temp.$no;

        $select_real_student = $connection->prepare("SELECT * FROM `students` WHERE reg_no = ? AND current_semester = ? LIMIT 1");
        $select_real_student->execute([$real_reg_no, $session_semester]);
        $real_student_data = $select_real_student->fetch(PDO::FETCH_ASSOC);
    }

    if(isset($_POST['cancel'])){
        $delete_ongoing = $connection->prepare("DELETE FROM `ongoing_attendance` WHERE capturing_by = ? AND status = 'Capturing'");
        $delete_ongoing->execute([$logged_in_data['staff_name']]);
        $delete_history = $connection->prepare("DELETE FROM `attendance_history` WHERE captured_by = ? AND status = 'Not Confirmed'");
        $delete_history->execute([$logged_in_data['staff_name']]);
        if($delete_ongoing){
            echo "<script type='text/javascript'>alert('Capturing attendance data deleted');window.location.href='sessionDetails.php';</script>";
        }
    }
    if(isset($_POST['stop'])){
        $delete_ongoing = $connection->prepare("UPDATE`ongoing_attendance` WHERE capturing_by = ? AND status = 'Captured' WHERE status = 'Capturing'");
        $delete_ongoing->execute([$logged_in_data['staff_name']]);
        $delete_history = $connection->prepare("UPDATE `attendance_history` SET status = 'Confirmed' WHERE captured_by = ? AND status = 'Not Confirmed'");
        $delete_history->execute([$logged_in_data['staff_name']]);
        if($delete_ongoing){
            echo "<script type='text/javascript'>alert('Capturing attendance Completed');window.location.href='sessionDetails.php';</script>";
        }
    }
?>

        <div class="p-3" id="capture">
            <div class="container mx-auto rounded  bg-white align-items-center p-2">
                <h3 class="fw-bold mb-0 text-center text-black text-bold mb-3">Capturing Attendance</h3>
                <h6 class="fw-bold mb-0 text-start text-black text-bold mt-3 mb-0 p-0 ms-4">Attendance Details</h6>
    
                <div class="row justify-content-start ps-4 pt-3">
    
                    <div class="col-sm-4">
                        <p class="text-bold text-start text-bold"><b>Subject</b>&emsp;&emsp; &nbsp;: <?= $select_sub['subject_name']; ?></p>
                        <p class="text-bold text-start text-bold"><b>Date</b>&emsp; &emsp; &ensp;&nbsp;&nbsp; : <?= $today_date; ?></p>
                        <p class="text-bold text-start text-bold"><b>Time from</b>&nbsp; &nbsp; :  <?= date("h:iA"); ?></p>
                        <p class="text-bold text-start text-bold"><b>Time to</b>&emsp;&emsp;&nbsp; : ----- </p>
                    </div>
    
                    <div class="col-sm-4">
                        <p class="text-bold text-start text-bold"><b>Semester</b>&ensp;&ensp;&nbsp; : Semester <?= $session_semester; ?></p>
                        <p class="text-bold text-start text-bold"><b>Admin</b>&emsp;&emsp;&ensp; : <?= $logged_in_data['staff_name']; ?></p>
                        <p class="text-bold text-start text-bold"><b>Mode</b>&emsp; &ensp; &ensp;&nbsp; : Scanning Fingerprint</p>
                        <form method="post">     
                            <input type="submit" name="cancel" class="btn btn-outline-danger" value="Cancel Attendance">
                            <input type="submit" name="stop" class="btn btn-outline-success" value="End Session">
                        </form>
                    </div>

                    <div class="col-sm-4">
                        <h3 class="fw-bold text-center mb-0 text-black">Give Attendance</h3>
                    
                            
                    <form action="" method="POST" class="p-3" style="font-size: 0.9rem;">

                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label text-black mb-1">Registration No.</label>
                                <input type="number" id="reg_no" value="" onchange="this.form.submit()" placeholder="000(Last Three Digits)" class="form-control form-control-sm" name="registration" required>
                            </div>
                        </div>

                    </form>

                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" onclick="captureFinger()" class="btn mb-3 btn-warning text-black" value="" name="give_attendance">Capture Finger</button>
                            </div>
                        </div>

                    </div>

    
                </div>
            </div>
        </div>
        <form method="post" id="returned_value_form">
            <input type="hidden" name="returned_value" id="returned_value" value="">
        </form>

<script>

    function captureFinger(){

        var template_1 = '';
        template_1 = '<?= $real_student_data['fingerprint_template'];?>';
        var uri = "https://localhost:8443/SGIFPCapture";
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function(){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
                fingerpring_object = JSON.parse(xmlhttp.responseText);
                if(fingerpring_object.ErrorCode == 0){
                    var template_2 = fingerpring_object.TemplateBase64;
                    matchScore(template_1, template_2);
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

    function matchScore(template_1, template_2) {
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
                    if(fpobject.MatchingScore > 70){
                        var returning_form =document.getElementById('returned_value_form');
                        var returning_data =document.getElementById('returned_value');
                        returning_data.value = template_1;
                        returning_form.submit();
                    }
                    else{
                        console.log(fpobject.MatchingScore);
                    }
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
if(isset($_POST['returned_value'])){
    $returned_value = $_POST['returned_value'];
    $presented_student = $connection->prepare("SELECT * FROM `students` WHERE fingerprint_template = ?");
    $presented_student->execute([$returned_value]);
    $presented_student_date = $presented_student->fetch(PDO::FETCH_ASSOC);

    $insert_attendance = $connection->prepare("INSERT INTO `attendance_history` (subject, batch, captured_by, semester, student_reg_no, date) VALUES (?, ?, ?, ?, ?, ?)");
    $insert_attendance->execute([$ongoing_attendance_data['subject'], $batch, $logged_in_data['staff_name'], $session_semester, $presented_student_date['reg_no'], $today_date]);
}
?>

<?php

$display_attendance = $connection->prepare("SELECT * FROM `attendance_history` WHERE batch = ? AND captured_by = ? AND date = ? AND status = 'Not Confirmed'");
$display_attendance->execute([$batch, $logged_in_data['staff_name'], $today_date]);
if($display_attendance->rowCount() < 0){
    echo 'No sutdents present';
}
else{
    ?>
    <div class="container">
        <div class="row justify-content-start">
    <?php
    while($attendance_data = $display_attendance->fetch(PDO::FETCH_ASSOC))
    {
        $select_student_to_display = $connection->prepare("SELECT * FROM `students` WHERE reg_no = ?");
        $select_student_to_display->execute([$attendance_data['student_reg_no']]);
        while($student_display_data = $select_student_to_display->fetch(PDO::FETCH_ASSOC)){
            ?>
                <div class="card bg-warning me-2 mt-1" style="width: 8.6rem;">
                    <div class="p-2">
                        <img class="rounded-circle mx-auto" width="100px" height="100px" src="../profile.jpg">
                        <p class="text-bold text-start p-0 m-0 text-bold" style="font-size: 0.8rem;"><b><?= $student_display_data['reg_no'] ;?></b></p>
                        <p class="text-bold text-start text-bold" style="font-size: 0.8rem;"><?= $student_display_data['name'] ;?></p>
                    </div>
                </div>
            <?php
        }
    }
    ?>
        </div>
    </div>
    <?php
}
?>

<?php include 'common/footer.php';?>


