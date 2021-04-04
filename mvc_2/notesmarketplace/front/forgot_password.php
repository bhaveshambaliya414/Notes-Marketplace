<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Forgot Password</title>

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

include 'connection_db.php';
include 'sendmail.php';

    
if(isset($_POST['submit'])) {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $emailquery = "SELECT * FROM users WHERE email ='$email'";
    $result = mysqli_query($conn,$emailquery);
   
    $row = mysqli_fetch_assoc($result);
    
    
    
	
	$email_id=$row['email'];
	$password=$row['password'];
	if($email==$email_id){
            if ($email){
            
            // This email address and name will be visible as sender of email
 
                $mail->addAddress($email);  // This email is where you want to send the email
                $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address
 
                // Setting the email content
                $mail->IsHTML(true);  
                $mail->Subject = "Note Marketplace"; 
                
                $mail->Body = "$password";

                $mail->send();
                $_SESSION['msg'] = "check your mail to activate your account $email";
                echo "email sent";
            }
    } 
}
?>
    <!-- Forget password -->
    <section id="forget-password">
        <div class="box">
            <div class="logo">
                <div class="text-center">
                    <img src="./images/Logos/top-logo-white.png" alt="">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-content">
                    <div class="basic-login-heading">
                        <h3 class="text-center">Forgot Password?</h3>
                        <p class="text-center">Enter your email to reset password</p>
                    </div>

                    <form id="for-pass-form" class="form" action="" method="POST">

                        <!-- email -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email *</label>
                            <input type="email"  name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email" required>
                        </div>


                        <!-- login btn -->
                        <button type="submit" name="submit" class="btn for-pass-btn">Submit</button>

                    </form>

                </div>
            </div>
        </div>
    </section>
    <!-- Forget password Ends -->



    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>