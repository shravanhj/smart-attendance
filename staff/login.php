
<?php include '../config/config.php'; ?>
<?php include 'common/header.php';

if(isset($_SESSION['Student']) ){
    header("Location:../index.php");
    exit();
}
else if(isset($_SESSION['Admin']) OR isset($_SESSION['Staff'])){
    header('Location:index.php');
}
?>
<?php
$reg_no = '';
if(isset($_POST['login'])){
    $email = strtoupper($_POST['email']);
    $password = $_POST['password'];
    
    $check_staff = $connection->prepare("SELECT * FROM `staff_admin` WHERE email = ? AND password = ?");
    $check_staff->execute([$email, $password]);

    if($check_staff->rowCount() > 0){
        $staff_data = $check_staff->fetch(PDO::FETCH_ASSOC);
        $_SESSION['Staff'] = $staff_data['unique_id'];

        if($staff_data['password'] == $staff_data['temp_password']){
            $delete_password = $connection->prepare("UPDATE `staff_admin` SET password = '' WHERE unique_id = ?");
            $delete_password->execute([$staff_data['unique_id']]);
            $message = 'Your Old password is deleted now. Please update password in your dashboard.';
            header('Location:../changePassword.php');
        }
        else{
            header('Location:sessionDetails.php');
        }
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
            <h6 class="text-center text-black mb-1 mt-2 p-0 ">Staff/Admin Login</h6>
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
                    <input type="text" id="email" value="<?= $reg_no; ?>" class="form-control form-control-sm" name="email" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md mb-3">
                    <label class="form-label text-black mb-1">Password</label>
                    <input type="password" id="password" class="form-control form-control-sm" name="password" required>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <p class="p-1 m-0" id="status"><b>Note </b> : First login? then Enter Password sent to your e-Mail.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <input type="submit" class="btn mb-3 bg-green shadow  col-sm-12 text-black" value="Login" name="login">
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
