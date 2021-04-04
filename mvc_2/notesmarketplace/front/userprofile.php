<?php 
session_start();
ob_start();

if(!isset($_SESSION['firstname'])){
    header('location:login.php');
}else{
    $firstname =  $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $userid = $_SESSION['userid'];
    $email = $_SESSION['email'];
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
                                    <a class="dropdown-item logout" href="login.php">Logout</a>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="login.php">Logout</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </nav>

    </header>
    <!-- Navigation  Ends -->
    
<?php 

include 'connection_db.php';
$userid = $_SESSION['userid'];


    
if(isset($_POST['submit'])) {
    $uid = $_SESSION['userid'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $phonecode = mysqli_real_escape_string($conn, $_POST['phonecode']);
    $phoneno = mysqli_real_escape_string($conn, $_POST['phoneno']);
    $profile_pic = mysqli_real_escape_string($conn, $_POST['profile_pic']);
    $add1 = mysqli_real_escape_string($conn, $_POST['add1']);
    $add2 = mysqli_real_escape_string($conn, $_POST['add2']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $university = mysqli_real_escape_string($conn, $_POST['university']);
    $college = mysqli_real_escape_string($conn, $_POST['college']);
    
    $showquery = "select * from userprofile where userid='$userid'";    
    $showdata = mysqli_query($conn, $showquery);

    $array = mysqli_fetch_array($showdata);    
    
    if(!$array){
        $insert_query = "INSERT INTO userprofile(userid, dob, gender, secondaryemailaddress, phoneno_countrycode, phonenumber, profilepicture, addressline1, addressline2, city, state, zipcode, country, university, college, createddate, createdby, modifieddate, modifiedby) VALUES ('$uid','$dob','1','$email','$phonecode','$phoneno','$profile_pic','$add1','$add2','$city','$state','$zipcode','$country','$university','$college', NULL, NULL, NULL, NULL)";
        $query = mysqli_query($conn, $insert_query);
    }else{

        $update_query = "UPDATE userprofile SET `userid`='$uid',`dob`='$dob',`gender`='$gender',`secondaryemailaddress`='$email',`phoneno_countrycode`='$phonecode',`phonenumber`='$phoneno',`profilepicture`='$profile_pic',`addressline1`='$add1',`addressline2`='$add2',`city`='$city',`state`='$state',`zipcode`='$zipcode',`country`='$country',`university`='$university',`college`='$college' WHERE id='$uid'";
        $result = mysqli_query($conn, $update_query);
    
        if($result){
        ?>
            <script>
            alert("data updated");
            location.replace("searchnotes.php");    
            </script>
        <?php    
        } 
    }
}
?>  
<section>
    <form action="userprofile.php" method="POST">      

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
                                if (!$query) {
                                    echo mysqli_error($conn);
                                } 
                            ?>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="first-name">First Name *</label>
                        <input type="text" name="fname" class="form-control" id="first-name" value="<?php echo $_SESSION['firstname']; ?>" placeholder="Enter your first name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last-name">Last Name *</label>
                        <input type="text" name="lname" class="form-control" id="last-name" value="<?php echo $_SESSION['lastname']; ?>" placeholder="Enter your last name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email *</label>
                        <input type="text" name="email" class="form-control" id="email" value="<?php echo $_SESSION['email']; ?>" placeholder="Enter your email address">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date">Date Of Birth</label>
                        <input type="date" name="dob" class="form-control" id="date" placeholder="Enter your date of birth">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="gender">Gender</label>
                        <select id="inputstate" name="gender" class="form-control">
                            <option value="hide">Select your gender</option>
                            <option>M</option>
                            <option>F</option>
                        </select>
                    </div>

                    <div class="form-group phone-no col-md-2 col-sm-3 col-3">
                        <label for="phone-no.">Phone Number</label>
                        <select id="inputstate" name="phonecode" class="form-control">
                            <option value="hide">+91</option>
                            <option>01</option>
                            <option>02</option>
                        </select>
                    </div>
                    <div class="form-group phone-number col-md-4 col-sm-9 col-9">
                        <input type="text" name="phoneno" class="form-control" id="phone-no." placeholder="Enter your phone number">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="profile-picture">Profile Picture</label>
                        <input type="file" name="profile_pic" class="form-control-file image-upload1" id="profile-picture" required>
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
                        <input type="text" name="add1" class="form-control" id="address1" placeholder="Enter your address">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address">Address Line 2 *</label>
                        <input type="text" name="add2" class="form-control" id="address2" placeholder="Enter your address">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city">City *</label>
                        <input type="text" name="city" class="form-control" id="city" placeholder="Enter your city">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="state">State *</label>
                        <input type="text" name="state" class="form-control" id="state" placeholder="Enter your state">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="zipcode">ZipCode *</label>
                        <input type="text" name="zipcode" class="form-control" id="zipcode" placeholder="Enter your zipcode">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="country">Country *</label>
                        <select id="inputstate" name="country" class="form-control">
                            <option value="hide">Select your Country</option>
                            <option>INDIA</option>
                            <option>USA</option>
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
                        <input type="text" name="university" class="form-control" id="university" placeholder="Enter your university">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="college">College</label>
                        <input type="text" name="college" class="form-control" id="college" placeholder="Enter your college">
                    </div>
                    <div class="submit-btn col-md-12">
                        
                        <button type="submit" name="submit" class="btn btn-submit">SUBMIT</button>
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