<?php

include 'config/config.php';


session_name("___UserAuthenticated");

session_start();
session_unset();
session_destroy();

header('Location: index.php');

?>