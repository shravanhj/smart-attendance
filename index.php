<?php include 'config/config.php'; ?>
<?php include 'common/header.php';
?>
<?php
if(isset($_SESSION['Student']) ){
  $select_logged_in_user = $connection->prepare("SELECT * FROM `students` WHERE reg_no = ?");
  $select_logged_in_user->execute([$_SESSION['Student']]);
  $logged_in_data = $select_logged_in_user->fetch(PDO::FETCH_ASSOC);
  ?>
  <h3 class="text-center text-black">Hi, Welcome <?= $logged_in_data['name'];?></h3>
  <div class="container">
  <div class="row mx-auto justify-content-center">
    <div class="col-sm-4">
        <p class="p-2 mb-3 rounded text-black bg-warning"><b>Note</b> : Please enter your details are correct and up-to-date, as they will be used for capturing your attendance in the future..</p>
    </div>
  </div>
  </div>
  <?php
}
else{?>
<div class="row p-4 justify-content-around mt-3">
  <div class="col-sm-4 bg-white mt-3 rounded p-3">
    <h4>Students Dashboard</h4>
    <a href="login.php" class="btn btn-warning ">Login as student</a>
    <p>If not registered?</p>
    <h6>Steps: </h6>
    <ol>
      <li>Click "Register as student" Button below</li>
      <li>Enter Correct University Reg. No and Email</li>
      <li>Click Scan Now Button and Place finger on the scanner.</li>
      <li>A Temproary password will be sent to student e-Mail ID</li>
      <li>Login in your mobile and Update the details correctly.</li>
    </ol>
    <a href="registration.php" class="btn btn-secondary">Register as student</a>
  </div>
  <div class="col-sm-4 bg-white mt-3 rounded p-3">
    <h4>Admin/Staff Dashboard</h4>
    <a href="staff/login.php" class="btn btn-warning">Login as Staff/Admin</a>
    <p>If not registered?</p>
    <h6>Steps: </h6>
    <ol>
      <li>Click "Register Button" below</li>
      <li>Enter Correct staff/admin name and Email</li>
      <li>Select appropriate role</li>
      <li>Click Scan Now Button and Place finger on the scanner.</li>
      <li>A Temproary password will be sent to given e-Mail ID</li>
      <li>Login in your mobile and Update the details correctly.</li>
    </ol>
    <a href="staff/registration.php" class="btn btn-secondary">Register as Staff/Admin</a>
  </div>
</div>
<?php
}
?>
<?php include 'common/footer.php'; ?>
