<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">

    <!-- Title -->
    <title>Contact Us</title>



    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Fontawesome -->
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
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $comment = mysqli_real_escape_string($conn, $_POST['comments']); 
        
        echo"hi hello";

        $mail->setFrom($config_email, $fullname);
        // This email address and name will be visible as sender of email

        $mail->addAddress($config_email, 'Notes-Marketplace');  // This email is where you want to send the email
        $mail->addReplyTo($config_email, $fullname);   // If receiver replies to the email, it will be sent to this email address

        // Setting the email content
        $mail->IsHTML(true);  
        $mail->Subject = "$fullname - $subject"; 

        $mail->Body = "Hello, <br><br> $comment <br><br> Regards, <br> $fullname";

        $mail->send();
    }
    
?>

    <!-- Navigation  -->
    <header>

        <nav class="navbar navbar-expand-lg white-navbar navbar-fixed-height fixed-top">

            <div class="container">
                <div class="row">

                    <!-- Logo -->
                    <div class="navbar-header col-lg-3 col-10">

                        <a class="navbar-brand text-left" href="#">
                            <img src="images/Logos/logo.png" alt="logo">
                        </a>

                    </div>

                    <button class="navbar-toggler collapsed col-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="mobile-nav-close-btn">&times;</span>
                        <span class="mobile-nav-open-btn">&#9776;</span>
                    </button>

                    <div class="collapse navbar-collapse col-lg-9" id="navbarSupportedContent">

                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="searchnotes.php">Search Notes</a></li>
                            <li class="nav-item"><a class="nav-link" href="dashboard.php">Sell Your Notes</a></li>
                            <li class="nav-item"><a class="nav-link" href="FAQ.php">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link" href="contactus.php">Contact Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </nav>

    </header>
    <!-- Navigation  Ends -->

    <!-- Contact Home -->
    <section id="contact">

        <div id="contact-content">

            <div class="container">

                <div id="contact-content-inner">

                    <div class="basic-heading-lg">
                        <h3>Contact Us</h3>
                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- Contact Home Ends -->

    <!--  Contact Details -->
    <section id="contact-details">

        <div class="content-box">

            <div class="container">
                
                <div class="row">

                    <div class="col-md-12">
                        <div class="basic-heading">
                            <h3>Get in Touch</h3>
                            <p>Let us know how to get back to you</p>
                        </div>
                    </div>

                </div>
                <!-- about left -->
                <form action="" method="POST">
                    <div class="row">

                        <div class="col-md-6 details">

                            <div class="form-group col-md-12">
                                <label for="name">Full Name *</label>
                                <input type="text" name="fullname" class="form-control" id="full-name" placeholder="Enter your full name" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="email">Email Address *</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Enter your email address" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="subject">Subject *</label>
                                <input type="text" name="subject" class="form-control" id="subject" placeholder="Enter your subject" required>
                            </div>

                        </div>

                        <!-- about right -->

                        <div class="col-md-6 details">
                            <div class="form-group col-md-12">
                                <label for="comments">Comments/Questions *</label>
                                <textarea class="form-control" name="comments" id="comment" placeholder="Comments..." required></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- button -->

                    <div class="row">
                        <div class="submit-btn">
                            <button type="submit" name="submit" class="btn btn-submit">submit </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </section>
    <!--  Basic Details Ends-->
    <hr>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <!-- Copyright -->
                <div class="col-md-6 col-sm-8 footer-text text-left">
                    <p>Copyright &copy; TatvaSoft All rights reserved. </p>
                </div>
                <!-- Social Icon -->
                <div class="col-md-6 col-sm-4 footer-icon text-right">
                    <ul class="social-list">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>