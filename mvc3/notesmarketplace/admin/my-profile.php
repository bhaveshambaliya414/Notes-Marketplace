<?php

session_start();
ob_start();
include "../front/connection_db.php";


if (!isset($_SESSION['loggedin']) && !((isset($_SESSION['is_admin'])) || (isset($_SESSION['is_superadmin'])))) {
    header('location:../login.php');
} else {
    $first_name = $_SESSION['firstname'];
    $last_name = $_SESSION['lastname'];
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
    <title>My Profile</title>

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
    

    $name_to_store_pp = "";
    $isset_profile = "false";
    $dp_file_name = "";

    $get_data = "SELECT * FROM userprofile WHERE userid='$adminid'";
    $result = mysqli_query($conn, $get_data);
    $count_id = mysqli_num_rows($result);

    if ($result) {
        if ($count_id > 0) {
            $data = mysqli_fetch_assoc($result);

            $edit_countrycode = $data['phoneno_countrycode'];
            $edit_secondary_email = $data['secondaryemailaddress'];
            $edit_phonenumber = $data['phonenumber'];
            $dp_file_name = $data['profilepicture'];
            $isset_profile = "true";
        } else {
            echo "no data";
        }
    } // get data from database and set it to inute tag for update profile
    else {
        die("QUERY FAILED" . mysqli_error($conn));
    }

    if (isset($_POST['submit'])) {

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['p-email'];
        $semail = $_POST['s-email'];
        $countrycode = $_POST['ccode'];
        $phonenumber = $_POST['phonenumber'];


        $profile_picture = $_FILES['profilepic'];

        // display picture file data
        $profile_picture_filename = $profile_picture['name'];
        $profile_picture_fileerror = $profile_picture['error'];
        $profile_picture_filetemp = $profile_picture['tmp_name'];

        $profile_picture_fileext = explode('.', $profile_picture_filename);
        $profile_picture_filecheck = strtolower(end($profile_picture_fileext));
        $profile_picture_ext = end($profile_picture_fileext);
        $profile_picture_fileextstored = array('png', 'jpg', 'jpeg');

        if (!empty($profile_picture_filename)) {
            if (in_array($profile_picture_filecheck, $profile_picture_fileextstored)) {

                $name_to_store_pp = $profile_picture_filename;
            } else {
    ?>
                <script>
                    alert("select proper file type for profile picture")
                </script>
    <?php
            }
        } // display pic provided end 

        if ($isset_profile == "false") {
            if (!empty($firstname) && !empty($lastname)) {
                date_default_timezone_set('Asia/Kolkata');
                $store_name_dp = "DP_" . date("dmyhis") . "." . $profile_picture_ext;
                $update_profile = "INSERT INTO `userprofile` (`userid`, `secondaryemailaddress`, `phoneno_countrycode`, `phonenumber`, `profilepicture`, `createddate`, `createdby`, `modifieddate`, `modifiedby`) VALUES ('$adminid', '$semail', '$countrycode', '$phonenumber', '$store_name_dp', current_timestamp(), '$adminid', current_timestamp(), '$adminid')";
                $query = mysqli_query($conn, $update_profile);

                if ($query) {
                    $isset_profile = "true";

                    if (!is_dir("../Members/$adminid")) {
                        mkdir("../Members/$adminid", 0777, true);
                    }

                    if (!empty($profile_picture_filetemp)) {
                        move_uploaded_file($profile_picture_filetemp, "../Members/$adminid/$store_name_dp");
                    }
                    
                } else {
                    echo "error";
                }
            } // data inserted

        } // data inserted ends 
        else {
            if (!empty($firstname) && !empty($lastname)) {
                date_default_timezone_set('Asia/Kolkata');
                $store_name_dp = "DP_" . date("dmyhis") . "." . $profile_picture_ext;
                if (!empty($name_to_store_pp)) {
                    $name_to_store_pp = $store_name_dp;
                }
                $update = "UPDATE `userprofile` SET `secondaryemailaddress` = '$semail', `phoneno_countrycode` = '$countrycode', `phonenumber` = '$phonenumber', `profilepicture` = '$name_to_store_pp', `modifieddate` = current_timestamp(), `modifiedby` = '$adminid' WHERE `userprofile`.`userid` = '$adminid'";
                $query2 = mysqli_query($conn, $update);
                if ($query2) {
                    $isset_profile = "true";

                    if (!is_dir("../Members/$adminid")) {
                        mkdir("../Members/$adminid", 0777, true);
                    }

                    if (!empty($profile_picture_filetemp)) {
                        if (!empty($dp_file_name) && file_exists("../Members/$adminid/$dp_file_name")) {
                            unlink("../Members/$adminid/$dp_file_name");
                        }
                        move_uploaded_file($profile_picture_filetemp, "../Members/$adminid/$store_name_dp");
                    } else {
                        if (!empty($dp_file_name) && file_exists("../Members/$adminid/$dp_file_name")) {
                            unlink("../Members/$adminid/$dp_file_name");
                        }
                    }
                    
                } else {
                    echo "error update";
                }
            } // data inserted

        } // data updated ends


    }

    ?>

    <!--  My Profile -->
    <section id="my-profile">

        <div class="content-box">

            <div class="container">
                <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="basic-heading">
                        <h3>My Profile</h3>
                    </div>
                </div>
                <div class="row">
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first name">First Name *</label>
                            <input type="text" name="firstname" class="form-control" id="first-name" placeholder="Enter your first name"<?php if (isset($first_name)) {
                                            echo "value='$first_name'";
                                        } ?>>
                        </div>
                        <div class="form-group">
                            <label for="last name">Last Name *</label>
                            <input type="text" name="lastname" class="form-control" id="last-name" placeholder="Enter your last name"<?php if (isset($last_name)) {
                                       echo "value='$last_name'";
                                    } ?>>
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="text" name="p-email" class="form-control" id="email" placeholder="Enter your email address"<?php if (isset($email_id)) {
                                       echo "value='$email_id'";
                                    } ?>readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Secondary Email</label>
                            <input type="text" name="s-email" class="form-control" id="s-email" placeholder="Enter your email address"<?php if (isset($edit_secondary_email)) {
                                       echo "value='$edit_secondary_email'";
                                    } ?>>
                        </div>
                        <div class="row">
                            <div class="form-group phone-no col-lg-3 col-md-3 col-sm-3 col-3">
                                <label for="phone-no.">Phone Number</label>
                                <?php
                                    $getcountryquery = "SELECT * FROM countries WHERE isactive = b'1'";
                                    $countryquery = mysqli_query($conn, $getcountryquery);
                                    $countryrows = mysqli_num_rows($countryquery);
                                    ?>
                                    <select id="country-code" name="ccode" class="form-control">
                                        <?php
                                        if (!(isset($edit_countrycode))) {
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
                                                if ($code_id == $edit_countrycode) {
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
                                <input type="text" name="phonenumber" class="form-control" id="phone-no." placeholder="Enter your phone number"<?php if (isset($edit_phonenumber)) {
                                                    echo "value='$edit_phonenumber'";
                                                  } ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="profile-picture">Profile Picture</label>
                            <input type="file" name="profilepic" class="form-control-file image-upload-file" id="profile-picture" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="submit-btn">
                        <button class="btn btn-submit" name="submit" type="submit" title="submit" role="button">Submit</button>           
                    </div>
                </div>
                </form>
            </div>

        </div>

    </section>
    <!--  My Profile Ends -->
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