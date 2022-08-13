<?php
include("./include/config.php");
include("./include/db.php");



$query_category = "SELECT * FROM categories";
$categories = $db->query($query_category);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog About Animals</title>
   
    <!-- Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/272a6bdf68.js" crossorigin="anonymous"></script>
    <!-- Bootstrap 4 CDN files-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
     <!-- Main CSS File -->
     <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Header -->
<header class="bg-dark">
    <div class="container">
        <div class="navigation d-flex justify-content-between align-items-center">
            <h1 class="logo"><a href="index.php">MyBlog.ir</a></h1>
            <div class="navbar navbar-expand navbar-dark">
                <ul class="navbar-nav">
                    <?php
                    if ($categories->rowCount() > 0) {
                        foreach ($categories as $category) {
                            ?>
                 <li class="nav-item <?php echo (isset($_GET['category']) && $_GET['category'] == $category['id']) ? "active" : "" ?>">
                    <a href="index.php?category=<?php echo $category['id']?>" class="nav-link"><?php echo $category['title'] ?></a>
                </li>
                        <?php

                        }
                    }
                    
                   ?>
                  
                </ul>
             
            </div>
        </div>
    </div>
</header>

    <!-- Header End-->