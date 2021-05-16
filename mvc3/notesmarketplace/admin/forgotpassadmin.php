<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">
    
    <!-- Title -->
    <title>Forgot Password Admin</title>

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

    <!-- Forget password -->
    <section id="forget-password">
        <div class="box">
            <div class="logo">
                <div class="text-center">
                    <img src="./images/top-logo.png" alt="">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-content">
                    <div class="basic-login-heading">
                        <h3 class="text-center">Forgot Password?</h3>
                        <p class="text-center">Enter your email to reset password</p>
                    </div>

                    <form id="for-pass-form" class="form" action="" method="post">

                        <!-- email -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email *</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email" required>
                        </div>


                        <!-- login btn -->
                        <button type="button" class="btn for-pass-btn">Submit</button>

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