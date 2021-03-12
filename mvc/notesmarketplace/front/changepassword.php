<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">

    <!-- Title -->
    <title>Change Password</title>

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

    <!-- Change Password -->
    <section id="change-password">
        <div class="box">

            <div class="logo">
                <div class="text-center">
                    <img src="./images/Logos/top-logo-white.png" alt="">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="form-content">
                    <div class="basic-login-heading">
                        <h3 class="text-center">Change Password</h3>
                        <p class="text-center">Enter your password to change your password</p>
                    </div>

                    <form id="change-pass-form" class="form" action="" method="post">

                        <div class="form-group">
                            <label for="old_password">Old Password </label>
                            <input id="old_password" type="password" class="form-control" name="password" placeholder="Enter your old password" required>
                        </div>

                        <div class="form-group">
                            <label for="new_password">New Password </label>
                            <input id="new_password" type="password" class="form-control" name="password" placeholder="Enter your new password" required>
                        </div>

                        <div class="form-group">
                            <label for="con_password">Confirm Password </label>
                            <input id="con_password" type="password" class="form-control" name="password" placeholder="Enter your confirm password" required>
                        </div>


                        <!-- login btn -->
                        <button type="button" class="btn change-pass-btn">Submit</button>

                    </form>
                </div>

            </div>

        </div>

    </section>
    <!-- Change Password Ends -->



    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>