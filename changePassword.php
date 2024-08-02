<?php include 'config/config.php'; ?>
<?php include 'common/header.php';

if(isset($_SESSION['Student']) ){
    $select_logged_in_user = $connection->prepare("SELECT * FROM `students` WHERE reg_no = ?");
    $select_logged_in_user->execute([$_SESSION['Student']]);
    $logged_in_data = $select_logged_in_user->fetch(PDO::FETCH_ASSOC);
    $table = 'students';
    $access = 'reg_no';
    $user = $logged_in_data['reg_no'];
}
else if(isset($_SESSION['Staff'])){
    $select_logged_in_user = $connection->prepare("SELECT * FROM `staff_admin` WHERE unique_id = ?");
    $select_logged_in_user->execute([$_SESSION['Staff']]);
    $logged_in_data = $select_logged_in_user->fetch(PDO::FETCH_ASSOC);
    $table = 'staff_admin';
    $access = 'unique_id';
    $user = $logged_in_data['unique_id'];
}
else{
    header('Location:login.php');
}
?>

<?php
if(isset($_POST['update_password'])){
    $password = $_POST['student_password'];

    $update_student = $connection->prepare("UPDATE `$table` set password = ? WHERE $access = ?");
    $update_student->execute([$password, $user]);
    if($update_student){
        $message = 'Password updated successfully.';
        if($_SESSION['Student']){
            header('Location:index.php');
        }
        else{
            header('Location:staff/index.php');
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
                    <button type="button" class="btn m-0 btn-secondary" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
<?php
?>
<div class="mt-3  col-md-3 p-5 p-lg-2 mx-auto">
    <div class="container-sm bg-white rounded shadow-sm border mx-auto ">
        <div class="p-4 pb-1">
            <h3 class="fw-bold text-center mb-0 text-black">Change Password</h3>
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
                    <label class="form-label text-black mb-1">Password</label>
                    <input type="password" id="student_password" placeholder="New Password" onchange="onChange()" class="form-control form-control-sm" name="student_password" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md mb-3">
                    <label class="form-label text-black mb-1">Confirm Password</label>
                    <input type="text" id="confirm_password" placeholder="Confirm Password" onchange="onChange()" class="form-control form-control-sm" name="confirm_password" required>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <input type="submit" class="btn mb-3 btn-warning  col-sm-12 text-black" value="Update" name="update_password">
                </div>
            </div>

        </form>
    </div>
</div>

<script>
    function onChange() {
  const password = document.querySelector('input[name=student_password]');
  const confirm = document.querySelector('input[name=confirm_password]');
    
  if (confirm.value === password.value) {
    confirm.setCustomValidity('');
  } else {
    confirm.setCustomValidity('Passwords do not match');
  }
}
</script>
<?php include 'common/footer.php';?>