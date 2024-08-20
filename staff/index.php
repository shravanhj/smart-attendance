<?php include '../config/config.php'; ?>
<?php include 'common/header.php';


if(isset($_SESSION['Staff']) || isset($_SESSION['Admin'])){
    header('Location:staffDashboard.php');
}
else{
    header('Location:login.php');
}

?>

<?php include 'common/footer.php';?>