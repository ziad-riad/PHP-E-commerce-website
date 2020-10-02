<?php 
session_start();
require("../include/connect.php");
if(isset($_POST['submit'])){
    $email   =$_POST['email'];
    $password=$_POST['password'];
    $query   ="SELECT * FROM admin WHERE admin_email   = '$email' AND
                                         admin_password= '$password'";

          $result = mysqli_query($conn,$query);
          $login  = mysqli_fetch_assoc($result);
          if(!empty($login['admin_id'])){
            $_SESSION['id']=$login['admin_id'];
            header("location:../manage_admin.php");
          }                              
          else{
            $error= "User Not Found";
          }
}

 ?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {
        height: 100%;

    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card" >
            
            <div class="card-header text-center"><a href="../index.html"><img class="logo-img" src="../assets/images/logo.png" alt="logo"></a><span class="splash-description">Please enter your <big>ADMIN</big> user information.</span></div>
            <div class="card-body">
                <form action="" method="post">
                    <?php if (isset($error)) {
                                    echo "<div class='alert alert-danger'>{$error}</div>";
                                } 
                                 ?>
                    <div class="form-group">
                        <input class="form-control form-control-lg" type="text" name="email" placeholder="Username" autocomplete="on">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" type="password" name="password" placeholder="Password">
                    </div>
                    
                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>
            
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
 
</html>