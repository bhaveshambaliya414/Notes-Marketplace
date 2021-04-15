<?php
session_start();
ob_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">


    <!-- Title -->
    <title>Sign Up</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Font-awasome -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>

<?php 

include 'connection_db.php';
include 'sendmail.php';

    
if(isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    
    
    
    $token = bin2hex(random_bytes(15));
    $emailquery = "SELECT * FROM users WHERE email ='$email'";
    $equery = mysqli_query($conn,$emailquery);
    
    
    $result = mysqli_num_rows($equery);
    echo $result;  
    
    if($result>0) {
        echo "email already exists";
    } 
    else {
        if($password === $cpassword){
            
            
            $insertquery = "INSERT INTO users ( roleid, firstname, lastname, email, password, token ,isemailverified, createddate, createdby, modifieddate, modifiedby, isactive) VALUES ('1', '$firstname', '$lastname', '$email', '$password', '$token', b'0', current_timestamp(), NULL, current_timestamp(), NULL, b'1')";    
            $iquery = mysqli_query($conn, $insertquery);
            
            if($iquery) {
            // This email address and name will be visible as sender of email
 
                $mail->addAddress($email);  // This email is where you want to send the email
                $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address
 
                // Setting the email content
                $mail->IsHTML(true);  
                $mail->Subject = "Note Marketplace - Email Verification"; 
                
                $mail->Body = "
                <table style='height:60%;width: 60%; position: absolute;margin-left:10%;font-family:Open Sans !important;background: white;border-radius: 3px;padding-left: 2%;padding-right: 2%;'>
                <thead>
                    <th>
                        <img src='https://i.ibb.co/HVyPwqM/top-logo1.png' alt='logo' style='margin-top: 5%; margin-left: 0px;'>
                    </th>
                </thead>
                <tbody>
                    <tr style='height: 60px;font-family: Open Sans;font-size: 26px;font-weight: 600;line-height: 30px;color: #6255a5;'>
                        <td class='text-1'>Email Verification</td>
                    </tr>
                    <tr style='height: 40px;font-family: Open Sans;font-size: 18px;font-weight: 600;line-height: 22px;color: #333333;margin-bottom: 20px;'>
                        <td class='text-2'>Dear $firstname,</td>
                    </tr>
                    <tr style='height: 60px;'>
                        <td class='text-3'>
                            Thanks for Signing up! <br>
                            Simply click below for email verification.
                        </td>
                    </tr>
                    <tr style='height: 120px;font-size: 16px;font-weight: 400;line-height: 22px;color: #333333;margin-bottom: 50px;'>
                        <td style='text-align: center;'>
                            <button class='btn btn-verify' style='width: 100% !important;height:50px;font-family: Open Sans; font-size: 18px;font-weight: 600;line-height: 22px;color: #fff;background-color: #6255a5;border-radius: 3px;'><a class='btn' href='http://localhost/notesmarketplace/front/activate.php?token=$token' role='button' style='color: #fff; text-decoration: none; text-transform: uppercase;'>Verify email address</a>
                            </button>
                        </td>
                    </tr>
                </tbody>
                </table>";

                $mail->send();
                $_SESSION['msg'] = "check your mail to activate your account $email";
                echo "email sent";
                
            } 
            else {
            ?>
                <script>
                    alert("NO Inserted")
                </script>
            <?php
                
            } 
        }
        else {
            echo "password and confirm password should match";
        }
    }
}
mysqli_close($conn);

?>

    <!-- Signup -->
    <section id="signup">
        <div class="box">
            <div class="logo">
                <div class="text-center">
                    <img src="./images/Logos/top-logo-white.png" alt="">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-content">
                    <div class="basic-login-heading">
                        <h3 class="text-center">Create an Account</h3>
                        <p class="text-center">Enter your details to Signup</p>
                    </div>
                    <p class="text-center success"><i class="fa fa-check-circle" aria-hidden="true"></i> Your account has been successfully created.</p> 
                    
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="firstname">First Name *</label>
                            <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Enter your first name" required>
                        </div>

                        <div class="form-group">
                            <label for="lastname">Last Name *</label>
                            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter your last name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" name="email" class="form-control" id="emailAdd" placeholder="Enter your email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Enter your Password" required>
                        </div>

                        <div class="form-group">
                            <label for="con_password">Confirm Password</label>
                            <input id="con_password" type="password" class="form-control" name="cpassword" placeholder="Enter your Password" required>
                        </div>

                        <button type="submit" name="submit" class="btn signup-btn">Sign Up</button>

                        <!-- signup -->
                        <p class="text-center sign-up-text">Already have an Account? <a href="login.php">Login</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section> 
    <!-- Signup Ends -->



    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
    
</body>
</html>

 
  