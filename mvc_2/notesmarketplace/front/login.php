<?php


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">

    <!-- Title -->
    <title>Login Page</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Font-awasome -->
    <link rel="stylesheet" href="css/font-awasome/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    
<?php 
session_start();
ob_start();    
include 'connection_db.php';


    
if(isset($_POST['submit'])) {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    
    $emailsearch = "SELECT * FROM users WHERE email ='$email'";
    $pquery = mysqli_query($conn,$emailsearch);
    
    $emailcount = mysqli_num_rows($pquery);
    
    if($emailcount){
        $email_pass = mysqli_fetch_assoc($pquery);
        $db_pass = $email_pass['password'];
        $userid = $email_pass['id'];
        
        $_SESSION['firstname']=$email_pass['firstname'];
        $_SESSION['lastname']=$email_pass['lastname'];
        $_SESSION['id']=$email_pass['id'];
        $_SESSION['email']=$email_pass['email'];
        
        $checkquery = "SELECT * FROM userprofile WHERE userid ='$userid'";
        $result = mysqli_query($conn,$checkquery);
        $count = mysqli_num_rows($result);
        
        if($db_pass==$password){
            echo "login successfully";
            ?>
            <script>
                location.replace("userprofile.php");
            </script>
            <?php
            
        }else{
            echo "password is incorrect";
        }
        
    }else{
        echo "invalid email";
    }
    
}
    
?>
    <!-- Login -->
    <section id="login">
        <div class="box">
            <div class="logo">
                <div class="text-center">
                    <img src="./images/Logos/top-logo-white.png" alt="">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-content">
                    <div class="basic-login-heading">
                        <h3 class="text-center">Login</h3>
                        <p class="text-center">Enter your email address and password to login</p>
                    </div>

                    <form id="login-form" class="form" action="" method="POST">

                        <!-- email -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email *</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email" required>
                        </div>

                        <!-- password -->
                        <div class="form-group">
                            <div class="pass-and-forgpass">
                                <label for="password">Password *</label>
                                <a href="forgot%20password.php">Forgot Password ?</a>
                            </div>
                            <div class="password-input">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Enter your Password" required>
                            </div>
                            <p id="passwordHelpBlock" class="form-text">
                                The password that you've entered is incorrect
                            </p>
                        </div>
                        <!-- remember me -->
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1"> Remember Me</label>
                        </div>

                        <button type="submit" name="submit" class="btn login-btn">Login</button>
                        <p class="text-center sign-up-text">Don't have an account? <a href="signup.php">Sign Up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Ends -->



    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/scripthome.js"></script>
</body>

</html>