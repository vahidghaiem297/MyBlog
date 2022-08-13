<?php
include("./include/config.php");
include("./include/db.php");

session_start();
if (isset($_POST['signin'])) {
    if (trim($_POST['email']) != "" && trim($_POST['password']) != "") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $check_query = $db->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
        $check_query->execute(['email' => $email, 'password'=> $password]);
        if ($check_query->rowCount() == 1) {
            $_SESSION['email'] = $email;
            header("Location:index.php");
            exit();
        } else {
            header("Location:signin.php?err_msg=Email Or Password are Incorrect.");
        }
        
    } else {
        header("Location:signin.php?err_msg=Please Fill All Required Fields.");
        exit();
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <!-- Font Awesome CDN -->
      <script src="https://kit.fontawesome.com/272a6bdf68.js" crossorigin="anonymous"></script>
      <!-- Bootstrap 4 CDN files-->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Main CSS File -->
      <link rel="stylesheet" href="css/register.css">
</head>
<body>

<section class="forms">
<div class="container">
    <h1 class="text-center text-dark">Sign In Form</h1>
    <?php
    if (isset($_GET['err_msg'])) {
        ?>
        <div class="alert alert-danger my-2">
            <?php echo $_GET['err_msg'] ?>
        </div>
        <?php
    }
    
    ?>
    <form method="post" id="form">
        
       
        <div class="form-group"><input type="email" class="form-control" name="email" placeholder="Enter Email Address"></div>
        <div class="form-group"><input type="password" class="form-control" name="password" placeholder="Enter Password"></div>
       
            <button type="submit" name="signin" class="btn btn-primary mt-2">Log In</button>
       
    </form>
</div>
</section>


</body>
</html>