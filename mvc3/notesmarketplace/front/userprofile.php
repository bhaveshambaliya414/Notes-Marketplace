<?php
session_start();
ob_start();

if (!isset($_SESSION['loggedin'])) {
    header('location:../login.php');
} else {
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $email_id = $_SESSION['email'];
    $user_id = $_SESSION['userid'];
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
    <title>User Profile</title>

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
                            <li class="nav-item"><a class="nav-link" href="buyerrequests.php">Buyer Requests</a></li>
                            <li class="nav-item"><a class="nav-link" href="FAQ.php">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link" href="contactus.php">Contact Us</a></li>
                            <li class="nav-item profile-dropdown">
                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="images/Logos/user-img.png" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="userprofile.php">My Profile</a>
                                    <a class="dropdown-item" href="mydownloads.php">My Downloads</a>
                                    <a class="dropdown-item" href="mysold_notes.php">My Sold Notes</a>
                                    <a class="dropdown-item" href="myrejected_notes.php">My Rejected Notes</a>
                                    <a class="dropdown-item" href="changepassword.php">Change Password</a>
                                    <a class="dropdown-item logout btn-logout" href="../logout.php">Logout</a>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link btn-logout" href="../logout.php">Logout</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </nav>

    </header>
    <!-- Navigation  Ends -->
    
<?php 

include 'connection_db.php';

    
    $name_to_store_pp = "";
    $isset_profile = "false";
    $dp_file_name = "";

    $getdata = "SELECT * FROM userprofile WHERE userid='$user_id'";
    $result = mysqli_query($conn, $getdata);
    $count_id = mysqli_num_rows($result);
    if ($result) {
        if ($count_id > 0) {
            $data = mysqli_fetch_assoc($result);

            $e_dob = $data['dob'];
            $e_gender = $data['gender'];
            $e_countrycode = $data['phonecode'];
            $e_phonenumber = $data['phonenumber'];
            $e_addline1 = $data['addressline1'];
            $e_addline2 = $data['addressline2'];
            $e_city = $data['city'];
            $e_state = $data['state'];
            $e_zipcode = $data['zipcode'];
            $e_country = $data['country'];
            $e_university = $data['university'];
            $e_college = $data['college'];
            $dp_file_name = $data['profilepicture'];
            $isset_profile = "true";
        } else {
            echo "no data";
        }
    } // get data from database and set it to inute tag for update profile
    else {
        die("QUERY FAILED" . mysqli_error($conn));
    }


    if (isset($_POST['setprofile'])) {
        
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $phonecode = mysqli_real_escape_string($conn, $_POST['phonecode']);
        $phoneno = mysqli_real_escape_string($conn, $_POST['phoneno']);
        
        $add1 = mysqli_real_escape_string($conn, $_POST['add1']);
        $add2 = mysqli_real_escape_string($conn, $_POST['add2']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $university = mysqli_real_escape_string($conn, $_POST['university']);
        $college = mysqli_real_escape_string($conn, $_POST['college']);
        

        $profile_picture = $_FILES['profilepicture'];

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
        }  

        if ($isset_profile == "false") {
            if (!empty($phonecode) && !empty($phoneno) && !empty($add1) && !empty($add2) && !empty($city) && !empty($state) && !empty($zipcode) && !empty($country)) {
                date_default_timezone_set('Asia/Kolkata');
                $store_name_dp = "DP_" . date("dmyhis") . "." . $profile_picture_ext;
                $update_profile = "INSERT INTO userprofile(userid, dob, gender, secondaryemailaddress, phoneno_countrycode, phonenumber, profilepicture, addressline1, addressline2, city, state, zipcode, country, university, college, createddate, createdby, modifieddate, modifiedby) VALUES ('$user_id','$dob','$gender','$email','$phonecode','$phoneno','$store_name_dp','$add1','$add2','$city','$state','$zipcode','$country','$university','$college', current_timestamp(), NULL, current_timestamp(), NULL)";
                
                $query = mysqli_query($conn, $update_profile);

                if ($query) {
                    $isset_profile = "true";

                    if (!is_dir("../Members/$user_id")) {
                        mkdir("../Members/$user_id", 0777, true);
                    }

                    if (!empty($profile_picture_filetemp)) {
                        move_uploaded_file($profile_picture_filetemp, "../Members/$user_id/$store_name_dp");
                    }
                    header('location:searchnotes.php');
                } else {
                    echo "error";
                }
            } // data inserted

        } // data inserted ends 
        else {
            if (!empty($phonecode) && !empty($phoneno) && !empty($add1) && !empty($add2) && !empty($city) && !empty($state) && !empty($zipcode) && !empty($country)) {
                date_default_timezone_set('Asia/Kolkata');
                $store_name_dp = "DP_" . date("dmyhis") . "." . $profile_picture_ext;
                if (!empty($name_to_store_pp)) {
                    $name_to_store_pp = $store_name_dp;
                }
                $update = "UPDATE userprofile SET `dob`='$dob',`gender`='$gender',`phoneno_countrycode`='$phonecode',`phonenumber`='$phoneno',`profilepicture`='$name_to_store_pp',`addressline1`='$add1',`addressline2`='$add2',`city`='$city',`state`='$state',`zipcode`='$zipcode',`country`='$country',`university`='$university',`college`='$college',`modifieddate` = current_timestamp(), `modifiedby` = '$user_id' WHERE `userprofile`.`userid` = '$user_id'";
                    
                $up_query = mysqli_query($conn, $update);
                if ($up_query) {
                    $isset_profile = "true";
                    echo "$isset_profile";

                    if (!is_dir("../Members/$user_id")) {
                        mkdir("../Members/$user_id", 0777, true);
                    }

                    if (!empty($profile_picture_filetemp)) {
                        if (!empty($dp_file_name) && file_exists("../Members/$user_id/$dp_file_name")) {
                            unlink("../Members/$user_id/$dp_file_name");
                        }
                        move_uploaded_file($profile_picture_filetemp, "../Members/$user_id/$store_name_dp");
                    } else {
                        if (!empty($dp_file_name) && file_exists("../Members/$user_id/$dp_file_name")) {
                            unlink("../Members/$user_id/$dp_file_name");
                        }
                    }
                    header('location:searchnotes.php');
                } else {
                    echo "error in update";
                }
            } // data inserted

        } // data updated ends


    }

    
    

?>  
<section>
    <form action="userprofile.php" method="POST" enctype="multipart/form-data">      

    <!-- user profile home -->
    <section id="user-profile">

        <div id="user-content">

            <div class="container">

                <div id="user-content-inner">

                    <div class="basic-heading-lg">
                        <h3>User Profile</h3>
                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- user profile Home Ends -->

    <!--  Basic Details -->
    <section id="basic-details">

        <div class="content-box">

            <div class="container">

                <div class="row">

                    <div class="col-md-12">
                        <div class="basic-heading">
                            <h3>Basic Note Details</h3>
                            <?php 
                                //if (!$query) {
                                    //echo mysqli_error($conn);
                                //} 
                            ?>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="first-name">First Name *</label>
                        <input type="text" name="fname" class="form-control" id="first-name" placeholder="Enter your first name" <?php if (isset($firstname)) {
                                       echo "value='$firstname'";
                                    } ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last-name">Last Name *</label>
                        <input type="text" name="lname" class="form-control" id="last-name" placeholder="Enter your last name"<?php if (isset($lastname)) {
                                       echo "value='$lastname'";
                                    } ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email *</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="Enter your email address"<?php if (isset($email_id)) {
                                       echo "value='$email_id'";
                                    } ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date">Date Of Birth</label>
                        <input type="text" name="dob" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" id="datepicker" placeholder="Enter your date of birth"
                        <?php if (isset($e_dob)) {
                                    echo "value='$e_dob'";
                                } ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="gender">Gender</label>
                        <?php
                            $getgenderquery = "SELECT * FROM referencedata WHERE isactive = b'1' AND refcategory = 'Gender'";
                            $genderquery = mysqli_query($conn, $getgenderquery);
                            $genderrows = mysqli_num_rows($genderquery);
                        ?>
                            <select id="gender" name="gender" class="form-control">
                                <?php
                                if (!(isset($e_gender))) {

                                ?>
                                    <option selected hidden value="">Select your gender</option>
                                    <?php
                                    for ($i = 1; $i <= $genderrows; $i++) {
                                        $genderrow = mysqli_fetch_array($genderquery);
                                    ?>
                                        <option value="<?php echo $genderrow["id"] ?>"><?php echo $genderrow["value"] ?></option>
                                <?php
                                    }
                                } else {

                                    for ($i = 1; $i <= $genderrows; $i++) {
                                        $genderrow = mysqli_fetch_array($genderquery);
                                        $gender_id = $genderrow['id'];
                                        $gender_name = $genderrow['value'];
                                        if ($gender_id == $e_gender) {
                                            echo "<option value='$gender_id' selected>$gender_name</option>";
                                        } else {
                                            echo "<option value='$gender_id'>$gender_name</option>";
                                        }
                                    }
                                }
                                ?>

                            </select>
                    </div>

                    <div class="form-group phone-no col-md-2 col-sm-3 col-3">
                        <label for="phone-no.">Phone Number</label>
                        <?php
                        $getcountryquery = "SELECT * FROM countries WHERE isactive = b'1'";
                        $countryquery = mysqli_query($conn, $getcountryquery);
                        $countryrows = mysqli_num_rows($countryquery);
                        ?>
                        <select id="country-code" name="phonecode" class="form-control">
                            <?php
                            if (!(isset($e_countrycode))) {
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
                                    if ($code_id == $e_countrycode) {
                                        echo "<option value='$code_id' selected>$code_id</option>";
                                    } else {
                                        echo "<option value='$code_id'>$code_id</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group phone-number col-md-4 col-sm-9 col-9">
                        <input type="text" name="phoneno" class="form-control" id="phone-no." placeholder="Enter your phone number"<?php if (isset($e_phonenumber)) {
                                       echo "value='$e_phonenumber'";
                                    } ?>>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="profile-picture">Profile Picture</label>
                        <input type="file" name="profilepicture" class="form-control-file image-upload1" id="profile-picture">
                    </div>

                </div>

            </div>

        </div>

    </section>
    <!--  Basic Details Ends-->

    <!--  Address Details -->
    <section id="address-details">

        <div class="content-box">

            <div class="container">

                <div class="row">

                    <div class="col-md-12">
                        <div class="basic-heading">
                            <h3>Address Details</h3>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="address">Address Line 1 *</label>
                        <input type="text" name="add1" class="form-control" id="address1" placeholder="Enter your address"
                        <?php if (isset($e_addline1)) {
                                    echo "value='$e_addline1'";
                                } ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address">Address Line 2 *</label>
                        <input type="text" name="add2" class="form-control" id="address2" placeholder="Enter your address" 
                        <?php if (isset($e_addline2)) {
                                    echo "value='$e_addline2'";
                                } ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city">City *</label>
                        <input type="text" name="city" class="form-control" id="city" placeholder="Enter your city"
                        <?php if (isset($e_city)) {
                                    echo "value='$e_city'";
                                } ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="state">State *</label>
                        <input type="text" name="state" class="form-control" id="state" placeholder="Enter your state"
                        <?php if (isset($e_state)) {
                                    echo "value='$e_state'";
                                } ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="zipcode">ZipCode *</label>
                        <input type="text" name="zipcode" class="form-control" id="zipcode" placeholder="Enter your zipcode"
                        <?php if (isset($e_zipcode)) {
                                    echo "value='$e_zipcode'";
                                } ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="country">Country *</label>
                        <?php
                        $getcountryquery = "SELECT * FROM countries WHERE isactive = b'1'";
                        $countryquery = mysqli_query($conn, $getcountryquery);
                        $countryrows = mysqli_num_rows($countryquery);
                        ?>
                        <select id="country" name="country" class="form-control" required>
                            <?php
                            if (!(isset($e_country))) {
                            ?>
                                <option selected hidden value="">Select your country<type></type>
                                </option>
                                <?php
                                for ($i = 1; $i <= $countryrows; $i++) {
                                    $countryrow = mysqli_fetch_array($countryquery);
                                ?>
                                    <option value="<?php echo $countryrow["name"] ?>"><?php echo $countryrow["name"] ?></option>
                            <?php
                                }
                            } else {
                                for ($i = 1; $i <= $countryrows; $i++) {
                                    $countryrow = mysqli_fetch_array($countryquery);

                                    $country_name = $countryrow['name'];

                                    if ($country_name == $e_country) {
                                        echo "<option value='$country_name' selected>$country_name</option>";
                                    } else {
                                        echo "<option value='$country_name'>$country_name</option>";
                                    }
                                }
                            }
                            ?>

                        </select>
                    </div>

                </div>

            </div>

        </div>

    </section>
    <!--  Address Details Ends-->

    <!--  University and College Information -->
    <section id="college-details">

        <div class="content-box">

            <div class="container">

                <div class="row">

                    <div class="col-md-12">
                        <div class="basic-heading">
                            <h3>University and College Information</h3>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="university">University</label>
                        <input type="text" name="university" class="form-control" id="university" placeholder="Enter your university"<?php if (isset($e_university)) {
                                    echo "value='$e_university'";
                                } ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="college">College</label>
                        <input type="text" name="college" class="form-control" id="college" placeholder="Enter your college"
                        <?php if (isset($e_college)) {
                                    echo "value='$e_college'";
                                } ?>>
                    </div>
                    <div class="submit-btn col-md-12">
                        
                        <button type="submit" name="setprofile" class="btn btn-submit">SUBMIT</button>
                    </div>
                </div>

            </div>

        </div>

    </section>
    <!-- University and College Information Ends-->
    </form>
</section>    
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