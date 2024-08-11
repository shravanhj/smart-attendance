<?php
ob_start();
session_name("___UserAuthenticated");
session_start();
?>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Smart Attendance</title>
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
        <script src="../assets/css/bootstrap.js"></script>
        <script src="../assets/js/script.js"></script>

        <style>
            :root{
                --main-bg-color: #d3d4d5;
                --main-color:  #6db33f;
                --main-color-2: #ffc107;
            }
            body{
                letter-spacing: 0.5px;
                background-color: var(--main-bg-color);

            }
            .bg-green{
                background-color: var(--main-color);
                color: white;
            }
            .text-green{
                color: var(--main-color);
            }
            a{
                color: black;
            }
            .nav-link{
                color: black;
            }
            .nav-link:hover{
                color: var(--main-color);
            }
            .form-control:focus{
            box-shadow: none;
            border-color: var(--main-color);
            }
        </style>
    </head>

    <body>
        <?php
        if(isset($_SESSION['Admin'])){
            ?>
            <nav class="navbar navbar-expand-lg bg-white p-3 mb-2">
                <div class="container">

                    <div class="">
                        <div class="d-flex align-items-center  pb-0">
                            <img src="../assets/images/fingerprint-scan.png" width="42px" alt="">
                            <h3 class="fw-bold text-black mb-0">Smart<b class="bg-green ms-2 p-1 text-dark rounded">Attendance</b></h3>
                        </div>
                        <p class="ms-5 text-black mb-0">Admin Module</p>
                    </div>
                    <a class="navbar-toggler" style="border:0px; outline:none;"  type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars-staggered "></i>
                    </a>
                    <div class="collapse navbar-collapse justify-content-end mt-2" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item me-3">
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link me-3 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    User Management
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" target="__blank" href="registration.php">Add New Staff</a></li>
                                    <li><a class="dropdown-item" href="../registration.php">Add New Student</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="logout.php">Role Assignment</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link me-3 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Attendance Management
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="sessionDetails.php">Start Capture Attendance</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="attendanceRecords.php">View Attendance Records</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link me-3 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Profile
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="staffDashboard.php">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="../changePassword.php">Change Password</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        <a class="btn btn-sm text-white" style="background-color: #6db33f;border-color: #6db33f;border-width: 2px;border-style: solid;border-radius: 10px;box-shadow: 5px 5px 15px #6db33f;" href="https://wa.me/917406492844" target="_blank"><i class="me-1 fa-brands fa-whatsapp"></i>Help</a>

                    </div>
                </div>
            </nav>
            <?php
        }
        else if(isset($_SESSION['Staff'])){
            if(basename($_SERVER['PHP_SELF'])  == 'registration.php' || basename($_SERVER['PHP_SELF'])  == 'login.php' || basename($_SERVER['PHP_SELF'])  == 'captureAttendance.php'){
            }
            else{
                ?>
            <nav class="navbar navbar-expand-lg bg-white p-3 mb-2">
                <div class="container">

                    <div class="">
                        <div class="d-flex align-items-center  pb-0">
                            <img src="../assets/images/fingerprint-scan.png" width="42px" alt="">
                            <h3 class="fw-bold text-black mb-0">Smart<b class="bg-green ms-2 p-1 text-dark rounded">Attendance</b></h3>
                        </div>
                        <p class="ms-5 text-black mb-0">Staff Module</p>
                    </div>
                    <a class="navbar-toggler" style="border:0px; outline:none;"  type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars-staggered "></i>
                    </a>
                    <div class="collapse navbar-collapse justify-content-end mt-2" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item me-3">
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item me-3">
                                <a class="nav-link" href="#">Reports</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link me-3 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" target="__blank" href="registration.php">Add new student</a></li>
                                    <li><a class="dropdown-item" href="studentDashboard.php">View Regd. Students</a></li>
                                    <li><a class="dropdown-item" href="changePassword.php">View Reports</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="logout.php">My Attendances</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link me-3 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Profile
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="studentDashboard.php">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="studentDashboard.php">Update Details</a></li>
                                    <li><a class="dropdown-item" href="changePassword.php">Change Password</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        <a class="btn btn-sm text-white" style="background-color: #6db33f;border-color: #6db33f;border-width: 2px;border-style: solid;border-radius: 10px;box-shadow: 5px 5px 15px #6db33f;" href="https://wa.me/917406492844" target="_blank"><i class="me-1 fa-brands fa-whatsapp"></i>Help</a>

                    </div>
                </div>
            </nav>
            <?php
        }
    }
        else if(isset($_SESSION['Student'])){
            header("Location:../index.php");
        }
        else{
            if(basename($_SERVER['PHP_SELF'])  == 'registration.php' || basename($_SERVER['PHP_SELF'])  == 'login.php' || basename($_SERVER['PHP_SELF'])  == 'captureAttendance.php'){
            }
            else{
                ?>
            <nav class="navbar navbar-expand-lg bg-white p-3 mb-2">
                <div class="container">

                    <div class="">
                        <div class="d-flex align-items-center  pb-0">
                            <img src="../assets/images/fingerprint-scan.png" width="42px" alt="">
                            <h3 class="fw-bold text-black mb-0">Smart<b class="bg-green ms-2 p-1 text-dark rounded">Attendance</b></h3>
                        </div>
                        <p class="ms-5 text-black mb-0">Staff Module</p>
                    </div>
                    <a class="navbar-toggler" style="border:0px; outline:none;"  type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars-staggered "></i>
                    </a>
                    <div class="collapse navbar-collapse justify-content-end mt-2" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item me-3">
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item me-3">
                                <a class="nav-link" href="">About</a>
                            </li>
                            <li class="nav-item me-3">
                                <a class="nav-link" target="__blank" href="login.php">Login</a>
                            </li>
                            <li class="nav-item me-3">
                                <a class="nav-link" target="__blank" href="registration.php">Register</a>
                            </li>
                        </ul>

                        <a class="btn btn-sm text-white" style="background-color: #6db33f;border-color: #6db33f;border-width: 2px;border-style: solid;border-radius: 10px;box-shadow: 5px 5px 15px #6db33f;" href="https://wa.me/917406492844" target="_blank"><i class="me-1 fa-brands fa-whatsapp"></i>Help</a>

                    </div>
                </div>
            </nav>
                <?php   
            }
        }
        ?>


        <!--
        <div class="scan">
            <div class="fingerprint"></div>
            <h3>Scanning...</h3>
        </div>
        -->
        

