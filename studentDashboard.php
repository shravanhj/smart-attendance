<?php include 'config/config.php'; ?>
<?php include 'common/header.php';

if(isset($_SESSION['Student']) ){
    $select_logged_in_user = $connection->prepare("SELECT * FROM `students` WHERE reg_no = ?");
    $select_logged_in_user->execute([$_SESSION['Student']]);
    $logged_in_data = $select_logged_in_user->fetch(PDO::FETCH_ASSOC);
}
else{
    header('Location:login.php');
}
?>

<?php
if(isset($_POST['update'])){
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $mobile_no = $_POST['mobile_no'];
    $semester = $_POST['semester'];

    $update_student = $connection->prepare("UPDATE `students` set name = ?, gender = ?, mobile_no = ?, current_semester = ? WHERE reg_no = ?");
    $update_student->execute([$fullname, $gender, $mobile_no, $semester, $_SESSION['Student']]);
    if($update_student){
        $message = 'Profile updated successfully.';
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

<div class="mt-3  col-md-4 p-3 p-lg-3 mx-auto">
    <div class="container-sm bg-white rounded shadow-sm border mx-auto ">
        <div class="p-4 pb-1">
            <h3 class="fw-bold text-center mb-0 text-black">Update Student Profile</h3>
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
                <div class="col-sm-12">
                    <p class="p-2 mb-3 bg-danger text-white rounded"><b>Note</b> : Please ensure your details are accurate and up-to-date, as they will be used for capturing your attendance in the future..</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md mb-3">
                    <p class=" fw-bold p-o m-0 text-black">My Details</p>
                    <label class="form-label text-black mb-1">University Reg. No</label>
                    <input type="text" id="reg_no" placeholder="<?= $logged_in_data['reg_no'];?>" disabled class="form-control form-control-sm" name="registration_no">
                </div>
            </div>

            <div class="row">
                <div class="col-md mb-3">
                    <label class="form-label text-black mb-1">Fingerprint Stauts</label>
                    <input type="text" id="status" placeholder="Scanned" disabled class="form-control form-control-sm" name="status">
                </div>
            </div>

            <div class="row">
                <div class="col-md mb-3">
                    <label class="form-label text-black mb-1">Full Name</label>
                    <input type="text" id="fullname" value="<?= $logged_in_data['name'];?>" placeholder="Full Name" class="form-control form-control-sm" name="fullname" required>
                </div>
            </div>

            <label class="form-label text-black mb-1">Gender</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input " type="radio" name="gender" value="male" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1" >Male</label>
            </div>

            <div class="form-check form-check-inline mb-3">
                <input class="form-check-input" type="radio" name="gender" value="female" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">Female</label>
            </div>

            <div class="row">
                <div class="col-md mb-3">
                    <label class="form-label text-black mb-1">Email</label>
                    <input type="text" id="email" placeholder="<?= $logged_in_data['email'];?>" class="form-control form-control-sm" name="email" disabled>
                </div>
            </div>

            <div class="row">
                <div class="col-md mb-3">
                    <label class="form-label text-black mb-1">Mobile No.</label>
                    <input type="text" id="fmobile_no" <?= $logged_in_data['mobile_no'];?> placeholder="Mobile No" class="form-control form-control-sm" name="mobile_no" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md mb-3">
                    <p class=" fw-bold p-o m-0 text-black">Academic Details</p>
                    <label>Current Semester</label>
                    <select name="semester" class="form-select form-select-sm p-1 shadow-sm bg-white rounded" required>
                        <option selected disabled>--Select--</option>
                        <option value="first">I</option>
                        <option value="third">III</option>
                        <option value="fifth">V</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <input type="submit" class="btn mb-3 btn-warning  col-sm-12 text-black" value="Update" name="update">
                </div>
            </div>

        </form>
    </div>
</div>

<script>
    function onChange() {
  const password = document.querySelector('input[name=student_password]');
  const confirm = document.querySelector('input[name=confirm_password]');
    if(document.getElementById('student_password').value.length < 8 ){
        password.setCustomValidity("Password must be 8 characters");
    }
    
  if (confirm.value === password.value) {
    confirm.setCustomValidity('');
  } else {
    confirm.setCustomValidity('Passwords do not match');
  }
}
</script>
<?php include 'common/footer.php';?>