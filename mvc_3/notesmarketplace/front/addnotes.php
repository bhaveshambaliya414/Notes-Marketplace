<?php
session_start();
ob_start();

include "connection_db.php";
include 'sendmail.php';

$userid = $_SESSION['id'];


$isflag = 0;



if (isset($_POST['submit'])) {
    
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $display_pic = mysqli_real_escape_string($conn, $_POST['display_pic']);
    $uploadnote = mysqli_real_escape_string($conn, $_POST['uploadnote']);
    $type = mysqli_real_escape_string($conn, $_POST['notetype']);
    $no_of_pages = mysqli_real_escape_string($conn, $_POST['no_of_pages']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $institute = mysqli_real_escape_string($conn, $_POST['institute']);
    $coursename = mysqli_real_escape_string($conn, $_POST['coursename']);
    $coursecode = mysqli_real_escape_string($conn, $_POST['coursecode']);
    $professor = mysqli_real_escape_string($conn, $_POST['professor']);
    $ispaid = mysqli_real_escape_string($conn, $_POST['ispaid']);
    $sellingprice = mysqli_real_escape_string($conn, $_POST['sellingprice']);
    $notepreview = mysqli_real_escape_string($conn, $_POST['notepreview']);
    $_SESSION['title'] = $title;
    $_SESSION['uploadnote'] = $uploadnote;
        
    $insertquery = "INSERT INTO sellernotes(sellerid, status, actionedby, adminremarks, title, category, displaypicture, notetype, numberofpages, description, universityname, country, course, coursecode, professor, ispaid, sellingprice, notespreview, createddate, createdby, modifieddate, modifiedby, isactive) VALUES ('$userid', '1', '$userid', NULL, '$title', '1', '$display_pic', '1', '$no_of_pages', '$description','$institute', '1', '$coursename', '$coursecode', '$professor', '$ispaid', '$sellingprice', '$notepreview', current_timestamp(),'$userid', current_timestamp(), NULL, b'0')";
    
    $notequery = mysqli_query($conn, $insertquery);
    
    
    if($notequery){

        $query = "true";
        $last_id = mysqli_insert_id($conn);
        $_SESSION['last_id'] = $last_id;
        $_SESSION['title'] = $title;
        $_SESSION['uploadnote'] = $uploadnote; 
        $attech = "INSERT INTO `sellernotesattachments`(`noteid`, `filename`, `filepath`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES ('$last_id', '$title', '$uploadnote', current_timestamp(), '$userid', current_timestamp(), NULL, b'0')";
        $attechquery = mysqli_query($conn, $attech);
    } else{
        echo "query not insert";
    }
    
 $isflag = 1;   
}

if (isset($_POST['publish'])) {
    $note_id = $_SESSION['last_id'];
    $seller_email = $_SESSION['email'];
    $seller_name= $_SESSION['firstname'];
    $notetitle = $_SESSION['title'];
    
    $uquery = "UPDATE sellernotes SET status = 2 WHERE id = '$note_id'";
    
    $query = mysqli_query($conn, $uquery);
    if($query){
        // This email address and name will be visible as sender of email
 
        $mail->addAddress($seller_email);  // This email is where you want to send the email
        $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address
 
        // Setting the email content
        $mail->IsHTML(true);  
        $mail->Subject = "$seller_name sent his note for review"; 
                
        $mail->Body = "Hello Admin, <br><br> $seller_name sent his note $notetitle for review. ";
        
        if(!$mail->send()){
        ?>
            <script>
                alert('something went wrong');
            </script> 
        <?php       
        }else{
            header('location:http://localhost/notesmarketplace/front/dashboard.php');
        }
    }else{
    ?>
        <script>
            alert('query failed');
        </script> 
    <?php    
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user scalable=no">

    <!-- Title -->
    <title>Add Notes</title>

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

                    <button class="navbar-toggler collapsed col-2" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarsExampleDefault"
                        aria-expanded="false" aria-label="Toggle navigation">
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
                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
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



    <!-- Add Notes Home -->
    <section id="add-notes">

        <div id="add-content">

            <div class="container">

                <div id="add-content-inner" class="text-center">

                    <div class="basic-heading-lg" class="text-center">
                        <h3>Add Notes</h3>
                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- Add Notes Home Ends -->
    <section>
        <form action="addnotes.php" method="POST">
            <!--  Basic Details -->
            <section id="basic-details">

                <div class="content-box">

                    <div class="container">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="basic-heading">
                                    <h3>Basic Note Details</h3>
                                    <?php //if (!$query) {
                                        // echo mysqli_error($conn);
                                         // } 
                                    ?>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="title">Title *</label>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="Enter your notes title" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="category">Category *</label>
                                <select id="inputstate" name="category" class="form-control" required>
                                    <option value="hide">Select your Category</option>
                                    <option>IT</option>
                                    <option>computer science</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="display-picture">Display Picture</label>
                                <input type="file" name="display_pic" class="form-control-file image-upload1"
                                    id="display-picture" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="upload-notes">Upload Notes *</label>
                                <input type="file" name="uploadnote" class="form-control-file image-upload2"
                                    id="upload-notes">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="type">Type</label>
                                <select id="inputstate" name="notetype" class="form-control">
                                    <option value="hide">Select your note type</option>
                                    <option>Handwritten Notes</option>
                                    <option>Story Books</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pages">Number of Pages</label>
                                <input type="text" name="no_of_pages" class="form-control" id="pages"
                                    placeholder="Enter number of note pages">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Description *</label>
                                <textarea class="form-control" name="description" id="description"
                                    placeholder="Enter your description" required></textarea>
                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <!--  Basic Details Ends-->

            <!--  Institution information -->
            <section id="insti-info">

                <div class="content-box">

                    <div class="container">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="basic-heading">
                                    <h3>Institution Information</h3>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="country">Country</label>
                                <select id="inputstate" name="country" class="form-control">
                                    <option value="hide">Select your Country</option>
                                    <option>India</option>
                                    <option>USA</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="institution">Institution Name</label>
                                <input type="text" name="institute" class="form-control" id="institution"
                                    placeholder="Enter your Institution Name">
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!--  Institution information Ends-->

            <!--  Course Details -->
            <section id="course-details">

                <div class="content-box">

                    <div class="container">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="basic-heading">
                                    <h3>Course Details</h3>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="course">Course Name</label>
                                <input type="text" name="coursename" class="form-control" id="#"
                                    placeholder="Enter your course name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="code">Course Code</label>
                                <input type="text" name="coursecode" class="form-control" id="#"
                                    placeholder="Enter your course code">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="professor">Professor/Lecturer</label>
                                <input type="text" name="professor" class="form-control" id="#"
                                    placeholder="Enter your professor name">
                            </div>

                        </div>

                    </div>

                </div>
            </section>
            <!-- Course Details Ends -->

            <!--  Selling Information -->
            <section id="selling-info">

                <div class="content-box">

                    <div class="container">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="basic-heading">
                                    <h3>Selling Information</h3>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 sell-section">

                                <div class="form-group col-md-12" id="sell-for-radio-btn">
                                    <p id="radio-heading" name="ispaid">Sell For *</p>
                                    <div class="form-check form-check-inline" name="ispaid">
                                        <input class="form-check-input" type="radio" name="ispaid" id="free"
                                            value="free">
                                        <label class="form-check-label" for="free">Free</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ispaid" id="paid"
                                            value="paid" checked>
                                        <label class="form-check-label" for="paid">Paid</label>
                                    </div>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="sell-price">Sell Price</label>
                                    <input type="text" name="sellingprice" class="form-control" id="#sell-price"
                                        placeholder="Enter your price">
                                </div>

                            </div>
                            <div class="col-md-6 sell-section">
                                <div class="form-group col-md-12">
                                    <label for="note-preview">Note Preview</label>
                                    <input type="file" name="notepreview" class="form-control-file image-note-preview" id="note-preview" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="sell-btn">
                                <button type="submit" name="submit" class="btn btn-sell" <?php echo isset($_POST['submit']) ? 'disabled="true"' : '';?> >SAVE</button>
                            </div>
                            <div class="sell-btn">
                                
                                <button type="submit" name="publish"  href="dashboard.php" class="btn btn-sell btn-publish" <?php if($isflag == 0) { echo 'disabled';} else {echo 'enabled';} ?> >PUBLISH</button>
                            </div>
                        </div>

                    </div>

                </div>

            </section>
            <!-- Selling Information Ends -->
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