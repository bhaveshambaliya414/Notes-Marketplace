<?php
session_start();
ob_start();
include "../front/connection_db.php";

if (!isset($_SESSION['loggedin']) && (isset($_SESSION['is_superadmin'])))) {
    header('location:../login.php');
} else {
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $email_id = $_SESSION['email'];
    $adminid = $_SESSION['userid'];
}

?>


    



<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">

    <!-- Title -->
    <title>Add Administrator</title>

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

    <!-- Navigation  -->
    <header>

        <nav class="navbar navbar-expand-lg white-navbar navbar-fixed-height fixed-top">

            <div class="container">
                <div class="row">

                    <!-- Logo -->
                    <div class="navbar-header col-lg-3 col-10">

                        <a class="navbar-brand text-left" href="#">
                            <img src="images/admin-images/logo.png" alt="logo">
                        </a>

                    </div>

                    <button class="navbar-toggler collapsed col-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="mobile-nav-close-btn">&times;</span>
                        <span class="mobile-nav-open-btn">&#9776;</span>
                    </button>

                    <div class="collapse navbar-collapse col-lg-9" id="navbarSupportedContent">

                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="dashboard_admin.php">Dashboard</a></li>
                            <li class="nav-item notes-dropdown">
                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Notes
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="notesunderreview.php">Notes Under Review</a>
                                    <a class="dropdown-item" href="publishednotes.php">Published Notes</a>
                                    <a class="dropdown-item" href="downloadsnotes.php">Download Notes</a>
                                    <a class="dropdown-item" href="rejectednotes.php">Rejected Notes</a>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="members.php">Members</a></li>
                            <li class="nav-item reports-dropdown">
                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Reports
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="spamreports.php">Spam Reports</a>
                                </div>
                            </li>
                            <li class="nav-item settings-dropdown">
                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Settings
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="manage_system_configuration.php">Manage System Configuration</a>
                                    <a class="dropdown-item" href="manageadministrator.php">Manage Administrator</a>
                                    <a class="dropdown-item" href="managecategory.php">Manage Category</a>
                                    <a class="dropdown-item" href="managetype.php">Manage Type</a>
                                    <a class="dropdown-item" href="managecountry.php">Manage Countries</a>
                                </div>
                            </li>
                            <li class="nav-item profile-dropdown">
                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="images/admin-images/user-img.png" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="my-profile.php">Update Profile</a>
                                    <a class="dropdown-item" href="../front/changepassword.php">Change Password</a>
                                    <a class="dropdown-item logout-action" href="../logout.php">Logout</a>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link logout-action" href="../logout.php">Logout</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </nav>

    </header>
    <!-- Navigation  Ends -->
    <?php
    include '../front/sendmail.php';
    
    $last_inserted_id = "";

    if (isset($_GET['id'])) {
        $eadminid = $_GET['id'];
        $getadmin = "SELECT * FROM users WHERE ID = '$eadminid'";
        $getadminquery = mysqli_query($conn, $getadmin);

        $getadminphone = mysqli_query($conn, "SELECT * FROM userprofile WHERE userid = '$eadminid'");

        if (!($getadminquery) || !($getadminphone)) {
            die("QUERY FAILED" . mysqli_error($conn));
        } else {
            $admindata = mysqli_fetch_assoc($getadminquery);
            $adminphonedata = mysqli_fetch_assoc($getadminphone);
            $adminfname = $admindata['firstname'];
            $adminlname = $admindata['lastname'];
            $adminemail = $admindata['email'];
            $adminpcode = $adminphonedata['phoneno_countrycode'];
            $adminphone = $adminphonedata['Phonenumber'];
            $editadmin = 1;
        }
    }

    if (isset($_POST['submit'])) {
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
        $ccode = $_POST['countrycode'];
        $phonenumber = $_POST['phonenumber'];


        if (isset($editadmin)) {
            $updateadmin = "UPDATE users SET `firstname` = '$fname', `lastname` = '$lname', `modifieddate` = current_timestamp(), `modifiedby` = '$adminid' WHERE id = '$eadminid'";
            $updatequery = mysqli_query($conn, $updateadmin);


            $updatecontect = "UPDATE userprofile SET `phoneno_countrycode` = '$ccode', `phonenumber` = '$phonenumber', `modifieddate` = current_timestamp(), `modifiedby` = '$adminid' WHERE userid = '$eadminid'";
            $updatecontactquery = mysqli_query($conn, $updatecontect);
            if (!($updateadmin) || !($updatecontactquery)) {
                die("QUERY FAILED" . mysqli_error($conn));
            } else {
                header('location:manageadministrator.php');
            }
        } else {
            $pass = bin2hex(random_bytes(4));
            

            $token = bin2hex(random_bytes(15));

            $emailquery = "SELECT * FROM users WHERE email ='$email'";
            $query = mysqli_query($conn, $emailquery);

            $emailcount = mysqli_num_rows($query);

            if ($emailcount > 0) {
    ?>
                <script>
                    alert("email already exists")
                </script>
                <?php
            } else {
                $insertadmin = "INSERT INTO `users` (`roleid`, `firstname`, `lastname`, `email`, `Password`, `token`, `isemailverified`, `createddate`, `createdby`, `modifieddate`, `modifiedmy`, `isactive`) VALUES ('2', '$fname', '$lname', '$email', '$pass', '$token', b'1', current_timestamp(), '$adminid', current_timestamp(), '$adminid', b'1')";
                $adminquery = mysqli_query($conn, $insertadmin);

                $last_inserted_id = mysqli_insert_id($conn);

                if ($adminquery) {
                    // This email address and name will be visible as sender of email

                    $mail->addAddress($email);  // This email is where you want to send the email
                    $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address

                    // Setting the email content
                    $mail->IsHTML(true);
                    $mail->Subject = "Login Credentials for admin";

                    $mail->Body = " Hello Admin,<br><br>We have generated an username and  password for you <br>username: $email <br> password: $pass <br><br> Regards,<br>Notes Marketplace ";

                    if (!($mail->send())) {
                ?>
                        <script>
                            alert("error in sending mail")
                        </script>
    <?php
                    }
                }
                $insertcontect = "INSERT INTO `userprofile` (`userid`, `phoneno_countrycode`, `phonenumber`, `createddate`, `createdby`, `modifieddate`, `modifiedby`) VALUES ('$last_inserted_id', '$ccode', '$phonenumber', current_timestamp(), '$adminid', current_timestamp(), '$adminid')";
                $phonequery = mysqli_query($conn, $insertcontect);
                if (!($phonequery)) {
                    die("QUERY FAILED" . mysqli_error($conn));
                }
            }
        }
    }
    ?>

    <!--  Add Administrator -->
    <section id="add-administrator">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="basic-heading">
                        <h3>Add Administrator</h3>
                    </div>
                </div>
                <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first name">First Name *</label>
                            <input type="text" name="firstname" class="form-control" id="first-name" placeholder="Enter your first name" <?php if (isset($adminfname)) {
                                            echo "value = $adminfname";
                                        }?> required>
                        </div>
                        <div class="form-group">
                            <label for="last name">Last Name *</label>
                            <input type="text" name="lastname" class="form-control" id="last-name" placeholder="Enter your last name"  <?php if (isset($adminlname)) {
                                        echo "value = $adminlname";
                                    }?> required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Enter your email address" <?php if (isset($adminemail)) {
                                            echo "value = $adminemail";
                                        }?> required>
                        </div>
                        <div class="row">
                            <div class="form-group phone-no col-lg-3 col-md-3 col-sm-3 col-3">
                                <label for="phone-no.">Phone Number</label>
                                
                                <?php
                                    $getcountryquery = "SELECT * FROM countries WHERE isactive = b'1'";
                                    $countryquery = mysqli_query($conn, $getcountryquery);
                                    $countryrows = mysqli_num_rows($countryquery);
                                    ?>
                                    <select id="countrycode" name="countrycode" class="form-control">
                                        <?php
                                        if (!(isset($adminpcode))) {
                                        ?>
                                            <option selected hidden value="+91">+91<type></type>
                                            </option>
                                            <?php
                                            for ($i = 1; $i <= $countryrows; $i++) {
                                                $countryrow = mysqli_fetch_array($countryquery);
                                            ?>
                                                <option value="<?php echo $countryrow["countrycode"] ?>"><?php echo $countryrow["countrycode"] ?></option>
                                        <?php
                                            }
                                        } else {
                                            for ($i = 1; $i <= $countryrows; $i++) {
                                                $countryrow = mysqli_fetch_array($countryquery);

                                                $code_name = $countryrow['countrycode'];
                                                $code_id = $code_name;
                                                if ($code_id == $adminpcode) {
                                                    echo "<option value='$code_id' selected>$code_id</option>";
                                                } else {
                                                     echo "<option value='$code_id'>$code_id</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                
                            </div>
                            <div class="form-group phone-number col-lg-9 col-md-9 col-sm-9 col-9">
                                <input type="text" name="phonenumber" class="form-control" id="phone-no." placeholder="Enter your phone number" <?php if (isset($adminphone)) {
                                                            echo "value = $adminphone";
                                                        }?>>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="submit-btn">
                        <button type="submit" name="submit" class="btn btn-submit">Submit</button>
                        
                    </div>
                </div>
                </form>
            </div>

        </div>

    </section>
    <!--  Add administrator Ends -->
    <hr>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <!-- Copyright -->
                <div class="col-md-6 col-sm-4 footer-text text-left">
                    <p>Version:1.1.24 </p>
                </div>
                <div class="col-md-6 col-sm-8 footer-text text-right">
                    <p>Copyright &copy; TatvaSoft All rights reserved. </p>
                </div>
            </div>
        </div>
    </footer>


    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="js/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>