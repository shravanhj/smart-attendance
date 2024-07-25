
<?php include 'config/config.php'; ?>
<?php include 'common/header.php';

if(isset($_SESSION['Admin']) OR isset($_SESSION['Staff']) OR isset($_SESSION['Student']) ){
    header("Location:index.php");
    exit();
}
?>
<?php
$reg_no = '';
if(isset($_POST['login'])){
    $reg_no = strtoupper($_POST['registration_no']);
    $password = $_POST['student_password'];
    
    $check_student = $connection->prepare("SELECT * FROM `students` WHERE reg_no = ? AND password = ?");
    $check_student->execute([$reg_no, $password]);

    if($check_student->rowCount() > 0){
        $student_data = $check_student->fetch(PDO::FETCH_ASSOC);
        $_SESSION['Student'] = $student_data['reg_no'];
        if($student_data['password'] == $student_data['temp_password']){
            $delete_password = $connection->prepare("UPDATE `students` SET password = '' WHERE unique_id = ?");
            $delete_password->execute([$student_data['unique_id']]);
            if($delete_password){
                $message = 'Your Old password is deleted now. Please update password in your dashboard.';
                header('Location:changePassword.php');
            }
        }
        header('Location:studentDashboard.php');
    }
    else{
        $message = "Incorrect e-Mail or Password entered";
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
                    <button type="button" class="btn m-0 btn-secondary" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <?php
?>

<div class="mt-3  col-md-3 p-4 p-lg-2 mx-auto">
    <div class="container-sm bg-white rounded shadow-sm border mx-auto ">
                
        <div class="p-4 pb-1">
            <h3 class="fw-bold text-center mb-0 text-black">Smart<b class="bg-green ms-2 p-1 pt-0 text-dark rounded">Attendance</b></h3>
            <h6 class="text-center text-black mb-1 mt-2 p-0 ">Student Login</h6>
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
                    <label class="form-label text-black mb-1">University Reg. No</label>
                    <input type="text" id="reg_no" placeholder="UXXXXXXSXXXX" value="<?= $reg_no; ?>" class="form-control form-control-sm" name="registration_no" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md mb-3">
                    <label class="form-label text-black mb-1">Password</label>
                    <input type="password" id="student_password" placeholder="*********" class="form-control form-control-sm" name="student_password" required>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <p class="p-1 m-0" id="status"><b>Note </b> : First login? then Enter Password sent to your e-Mail.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <input type="submit" class="btn mb-3 btn-warning shadow  col-sm-12 text-black" value="Login" name="login">
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
