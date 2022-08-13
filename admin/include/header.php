<?php
include("config.php");
include("db.php");
session_start();
if (! isset($_SESSION['email'])) {
    header("Location:signin.php?err_msg=You Should Login First.");
    exit();
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/272a6bdf68.js" crossorigin="anonymous"></script>
    <!-- Bootstrap 4 CDN files-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Main CSS File -->
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <!-- Header -->
    <header>
        <div class="d-flex justify-content-between align-items-center px-3">
            <h1 class="text-white">Blog</h1>
            <ul class="nav d-flex align-items-center justify-content-between">
                <li class="nav-item">
                    <a href="logout.php" id="logout" class="nav-link text-white d-flex align-items-center"><i
                            class="fas fa-power-off pr-1"></i> Exit</a>
                </li>
                <li class="nav-item"><a href="#" class="nav-link" onclick="openNav()"><i class="fas fa-bars"></i></a></li>
            </ul>
        </div>
    </header>

    <!-- Header End-->
    <?php

include("footer.php");
    ?>