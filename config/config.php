<?php

$db_name = 'mysql:host=localhost;dbname=smart_attendance';
$user_name = 'root';
$user_password = '';

try{
    $connection = new PDO($db_name, $user_name, $user_password);

}

catch(Exception $e){
    echo "<script type='text/javascript'>alert('Failed to Establish Connection. Contact Admin: shravanhj@gmail.com');window.location.href='error.php';</script>";
}

$select_fingers = $connection->prepare("SELECT * from `students`");
$select_fingers->execute();
?>