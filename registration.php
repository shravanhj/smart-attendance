
<?php include 'config/config.php'; ?>
<?php include 'common/header.php';

if(isset($_SESSION['Student'])){
    header("Location:index.php");
    exit();
}
?>
<?php
use PHPMailer\PHPMailer\PHPmailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST['capture'])){
    $email = strtolower($_POST['student_email']);
    $reg_no = strtoupper($_POST['registration_no']);
    $fingerprint_template = $_POST['fingerprint_template'];

    if($fingerprint_template == ''){
        $message = 'Please Scan Fingerprint';
    }
    else if($email == '' OR $reg_no == ''){
        $message = 'e-Mail or Registration fields are required';
    }
    else{
        $check_student = $connection->prepare("SELECT * FROM `students` WHERE reg_no = ? OR email = ?");
        $check_student->execute([$reg_no, $email]);
        if($check_student->rowCount() > 0)
        {
            $message = "Student with Registation or E-Mail already exists.";
        }
        else{
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 6; $i++) {
                $randomString .= $characters[random_int(0, $charactersLength - 1)];
            }
            $email_message = '
                <h3>Smart Attendance</h3>
                <h5">Student Registration</h5>
                <p class="fs-3">
                Dear student,<br>
                Your password is : <b>'.$randomString.'</b> use thsi password to login.<br><br>
                Team Smart Attendance.
                </p>';

                
            $mail = new PHPMailer(true);

            try{
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username =  'iamwilliamsmith07@gmail.com';
                $mail->Password = 'bplcpnotbaavazdy';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                
                $mail->setFrom('iamwilliamsmith07@gmail.com');
                $mail->addAddress($email);
        
                $mail->isHTML(true);
                $mail->Subject = 'Welcome to Smart Attendance System';
                $mail->Body = $email_message;
        
                $mail->send();
                $insert_student = $connection->prepare("INSERT INTO `students`(reg_no, email, fingerprint_template, password, temp_password) VALUES (?, ?, ?, ?, ?)");
                $insert_student->execute([$reg_no, $email, $fingerprint_template, $randomString, $randomString]);
                if($insert_student){
                    $message = 'Password has been sent to your e-Mail id. Please login and update your academic details.<br><br>
                    <b>Note : </b>Please connect to the same Wi-Fi network and access the update page after login.';

                }
                else{
                    $message = 'Password has been sent through email but failed to insert it into database.<br><br>
                    <b>Note : </b>Please scan and register yourself again.';
                }
            }
    
            catch(Exception $e){
                $message= $e->getMessage();
            }
        }
    }
}
    ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Message from Smart-Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><?= $message; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <?php

?>

<div class="mt-3  col-md-3 p-5 p-lg-2 mx-auto">
    <div class="container-sm bg-white rounded shadow-sm border mx-auto ">
                
        <div class="p-4 pb-1">
            <h3 class="fw-bold text-center mb-0 text-black">Smart<b class="bg-green ms-2 p-1 pt-0 text-dark rounded">Attendance</b></h3>
            <h6 class="text-center text-black mb-1 mt-2 p-0 ">Student Registration</h6>
        </div>
        <form action="" id="reg_form" method="post" class="p-3" style="font-size: 0.9rem;">

        <?php
        if(isset($message)){
            ?>
            <script>
            var myModal = new bootstrap.Modal(document.getElementById("exampleModal"));
            myModal.show();
            </script>
            <?php
            }
        
                ?>
            <div class="row">
                <div class="col-md mb-3">
                    <label class="form-label text-black mb-1">Email</label>
                    <input type="email" id="student_email" placeholder="iamstudent@example.com" class="form-control form-control-sm" name="student_email" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md mb-3">
                    <label class="form-label text-black mb-1">University Reg. No</label>
                    <input type="text" id="reg_no" placeholder="UXXXXXXSXXXX" class="form-control form-control-sm" name="registration_no" required>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <p class="p-1 m-0" id="status"><b>Scan Status</b> : Not Scanned.</p>
                    <input type="hidden"  name="fingerprint_template" id="fingerprint_template" required>
                    <input type="hidden"  name="capture">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <a onclick="captureFP()" class="btn mb-3 btn-warning  col-sm-12 text-black" >Scan now</a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <p class="p-1 m-0"><b>Note</b> : Please check you mail and submit all details.</p>
                </div>
            </div>

        </form>
    </div>
</div>
<?php include 'common/footer.php';?>
