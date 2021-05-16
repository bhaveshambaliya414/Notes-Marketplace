
<?php

session_start();
ob_start();
include "connection_db.php";



?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">

    <!-- Title -->
    <title>Notes Details</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

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
    if (!isset($_SESSION['loggedin'])) {
    header('location:../login.php');
    } else {
        $firstname = $_SESSION['firstname'];
        $lastname = $_SESSION['lastname'];
        $email_id = $_SESSION['email'];
        $user_id = $_SESSION['userid'];
    }

    include 'sendmail.php';

    ?>


    <?php
    if (!(isset($_GET['edit']))) {
        header("Location:dashboard.php");
    } else {
        $note_id = (int)$_GET['edit'];

        $edit_notes = "SELECT * FROM sellernotes WHERE id ='$note_id'";
        $edit_notes_query = mysqli_query($conn, $edit_notes);
        if (!($edit_notes_query)) {
            die("QUERY FAILED" . mysqli_error($conn));
        }
        $count = mysqli_num_rows($edit_notes_query);

        $row = mysqli_fetch_assoc($edit_notes_query);

        $edit_title = $row['title'];

        $edit_category = $row['category'];
        $edit_type = $row['notetype'];
        $edit_pages = $row['numberofpages'];
        $description = $row['description'];
        $country = $row['country'];
        $institution_name = $row['universityname'];
        $course = $row['course'];
        $course_code = $row['coursecode'];
        $professor = $row['professor'];
        $sell = $row['ispaid'];
        $sell_price = $row['sellingprice'];
        $edit_dp = $row['displaypicture'];
        $edit_cv = $row['notespreview'];
        //$flag = 1;
    }

    if (isset($_POST['submit'])) {
        date_default_timezone_set('Asia/Kolkata');
        $save_title = $_POST['title'];

        $save_category = $_POST['category'];
        $save_type = $_POST['notetype'];
        $save_pages = $_POST['no_of_pages'];
        $save_description = $_POST['description'];
        $save_country = $_POST['country'];
        $save_institution_name = $_POST['institute'];
        $save_course = $_POST['coursename'];
        $save_course_code = $_POST['coursecode'];
        $save_professor = $_POST['professor'];
        $save_sell = $_POST['ispaid'];
        $save_sell_price = $_POST['sellingprice'];

        $attachment = $_FILES['notes-data']['name'];
        $attachment_temp = $_FILES['notes-data']['tmp_name'];

        $profile_picture = $_FILES['display-picture']['name'];
        $profile_picture_tmp = $_FILES['display-picture']['tmp_name'];
        $preview_cv = $_FILES['note-preview']['name'];
        $preview_cv_tmp = $_FILES['note-preview']['tmp_name'];
        $accepted_image = array('png', 'jpg', 'jpeg');
        $accepted_pdf = array('pdf');


        if (!empty($_FILES['display-picture']['tmp_name'])) {

            $profile_picture_ext = pathinfo($_FILES["display-picture"]["name"], PATHINFO_EXTENSION);

            $profile_picture = "DP_" . date("dmYhis") . "." . $profile_picture_ext;
        } else {
            $profile_picture = $edit_dp;
            $profile_picture_ext = "jpg";
        }
        if (!empty($_FILES['note-preview']['tmp_name'])) {
            $preview_cv_ext = pathinfo($_FILES["note-preview"]["name"], PATHINFO_EXTENSION);
            $preview_cv = "Preview_" . date("dmYhis") . "." . $preview_cv_ext;
        } else {
            $preview_cv = $edit_cv;
            $preview_cv_ext = "pdf";
        }


        if (!in_array($profile_picture_ext, $accepted_image)) {
            echo "<script>alert('please enter valid image file extension like .jpg ,.jpeg or .png ');</script>";
        } elseif (!in_array($preview_cv_ext, $accepted_pdf)) {
            echo "<script>alert('please enter valid image file extension like .jpg ,.jpeg or .png ');</script>";
        }
        $update_query = "UPDATE sellernotes SET Title = '{$save_title}', ";
        $update_query .= "category = '{$save_category}', ";
        $update_query .= "notetype = '{$save_type}', ";
        $update_query .= "numberofpages = '{$save_pages}', ";
        $update_query .= "country = '{$save_country}', ";
        $update_query .= "universityname = '{$save_institution_name}', ";
        $update_query .= "coursename = '{$save_course}', ";
        $update_query .= "coursecode = '{$save_course_code}', ";
        $update_query .= "professor = '{$save_professor}', ";
        $update_query .= "ispaid = $save_sell, ";
        $update_query .= "sellingprice = $save_sell_price, ";
        $update_query .= "displaypicture = '{$profile_picture}', ";
        $update_query .= "notespreview = '{$preview_cv}' ";
        $update_query .= "WHERE id= $note_id ";
        $update_select_query = mysqli_query($conn, $update_query);
        if (!($update_select_query)) {
            die("QUERY FAILED" . mysqli_error($conn));
        } else {

            $atta_count = count($_FILES['notes-data']['name']);
            print_r($_FILES['notes-data']['name']);
            if ($attachment_temp[0] != "") {
                $get_attachment = mysqli_query($conn, "SELECT * FROM sellernotesattachments WHERE noteid = '$note_id'");
                if (!($get_attachment)) {
                    die("QUERY FAILED" . mysqli_error($conn));
                } else {

                    $att_count = mysqli_num_rows($get_attachment);
                    echo "<script> alert('xyz')</script>";
                    while ($atta_data = mysqli_fetch_assoc($get_attachment)) {
                        $atta_name = $atta_data['filename'];
                        if (file_exists("../Members/$user_id/$note_id/Attachements/$atta_name")) {
                            unlink("../Members/$user_id/$note_id/Attachements/$atta_name");
                        }
                    }
                    $delete_atta = mysqli_query($conn, "DELETE FROM sellernotesattachments WHERE noteid = '$note_id'");
                    if (!($delete_atta)) {
                        die("QUERY FAILED" . mysqli_error($conn));
                    }
                }
            }

            if ($attachment_temp[0] != "") {

                for ($i = 0; $i < $atta_count; $i++) {
                    $notes_data_filename = $_FILES['notes-data']['name'][$i];
                    $notes_data_filetemp = $_FILES['notes-data']['tmp_name'][$i];

                    $note_date_fileext = explode('.', $notes_data_filename);
                    $note_data_filecheck = strtolower(end($note_date_fileext));
                    $note_data_ext = end($note_date_fileext);

                    if (in_array($note_data_filecheck, $accepted_pdf)) {

                        $store_name_atta = "Attachement_" . $i . "_" . date("dmyhis") . "." . $note_data_ext;
                        $atta_path = "../Members/$user_id/$note_id/Attachements/$store_name_atta";

                        $insert_attachements = "INSERT INTO `sellernotesattachments`(`noteid`, `filename`, `filepath`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES ($note_id, '$store_name_atta', '$atta_path', current_timestamp(), '$user_id', current_timestamp(), '$user_id', b'1')";

                        date_default_timezone_set('Asia/Kolkata');

                        if (!is_dir("../Members/$user_id/$note_id/Attachements")) {
                            mkdir("../Members/$user_id/$note_id/Attachements", 0777, true);
                        }
                        move_uploaded_file($notes_data_filetemp, "../Members/$user_id/$note_id/Attachements/$store_name_atta");

                        $ins_atta_query = mysqli_query($conn, $insert_attachements);
                        if (!($ins_atta_query)) {
                            die("QUERY FAILED" . mysqli_error($conn));
                        }
                    } else {
    ?>
                        <script>
                            alert("select proper file type for note attachements")
                        </script>
                <?php
                    }
                } // for loop over
            }

            if ($profile_picture != $edit_dp) {
                if (file_exists("../Members/$user_id/$note_id/$edit_dp")) {
                    unlink("../Members/$user_id/$note_id/$edit_dp");
                    move_uploaded_file($profile_picture_tmp, "../Members/$user_id/$note_id/$profile_picture");
                } else {
                    move_uploaded_file($profile_picture_tmp, "../Members/$user_id/$note_id/$profile_picture");
                }
            }

            if ($preview_cv != $edit_cv) {
                if (file_exists("../Members/$user_id/$note_id/$edit_cv")) {
                    unlink("../Members/$user_id/$note_id/$edit_cv");
                    move_uploaded_file($preview_cv_tmp, "../Members/$user_id/$note_id/$preview_cv");
                } else {
                    move_uploaded_file($preview_cv_tmp, "../Members/$user_id/$note_id/$preview_cv");
                }
            }


            header('location:dashboard.php');
        }
    }

    if (isset($_POST['publish'])) {

        $last_note_id = $_SESSION['last_id'];
        $seller_email = $_SESSION['email'];
        $seller_name =  $_SESSION['firstname'];
        $note_title = $_SESSION['note_title'];
        $query = "UPDATE sellernotes SET status = 5 WHERE id = $note_id";
        $uquery = mysqli_query($conn, $query);
        if ($uquery) {

            // This email address and name will be visible as sender of email

            $mail->addAddress($seller_email);  // This email is where you want to send the email
            $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address

            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = "$seller_name sent his note for review";

            $mail->Body = "Hello Admins,<br><br> We want to inform you that, $seller_name sent his note <br> $note_title for review. Please look at the notes and take required actions. <br><br> Regards,<br>Notes Marketplace";

            if (!$mail->send()) {
                ?>
                <script>
                    alert('somthing went wrong');
                </script>
            <?php
            } else {
                header('location:dashboard.php');
            }
        } else {
            ?>
            <script>
                alert("query fail")
            </script>
    <?php
        }
    }

    ?>

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
        <form action="addnotes.php" method="POST" enctype="multipart/form-data">
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
                                    placeholder="Enter your notes title" <?php if (isset($edit_title)) {
                                                                                echo "value='$edit_title'";
                                                                            } ?>>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="category">Category *</label>
                                <?php
                                $getcategoryquery = "SELECT * FROM notecategories WHERE isactive = b'1'";
                                $categoryquery = mysqli_query($conn, $getcategoryquery);
                                $categoryrows = mysqli_num_rows($categoryquery);
                                ?>
                                <select id="category" name="category" class="form-control">
                                    <?php
                                        for ($i = 1; $i <= $categoryrows; $i++) {
                                            $categoryrow = mysqli_fetch_array($categoryquery);
                                            $cat_id = $categoryrow['id'];
                                            $cat_name = $categoryrow['name'];
                                            if ($cat_id == $edit_category) {
                                                echo "<option value='$cat_id}' selected>$cat_name</option>";
                                            } else {
                                                echo "<option value='$cat_id}'>$cat_name</option>";
                                            }
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="display-picture">Display Picture</label>
                                <input type="file" name="display-picture" class="form-control-file image-upload1"
                                    id="display-picture" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="upload-notes">Upload Notes *</label>
                                <input type="file" name="notes-data[]" class="form-control-file image-upload2"
                                    id="upload-notes" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="type">Type</label>
                                <?php
                                $getnotetypequery = "SELECT * FROM notetypes WHERE isactive = b'1'";
                                $notetypequery = mysqli_query($conn, $getnotetypequery);
                                $notetyperows = mysqli_num_rows($notetypequery);
                                ?>
                                <select id="type" name="notetype" class="form-control">
                                    <?php
                                        for ($i = 1; $i <= $notetyperows; $i++) {
                                            $notetyperow = mysqli_fetch_array($notetypequery);
                                            $note_type_id = $notetyperow['id'];
                                            $note_type_name = $notetyperow['name'];
                                            if ($note_type_id == $edit_type) {
                                                echo "<option value='$note_type_id}' selected>$note_type_name</option>";
                                            } else {
                                                echo "<option value='$note_type_id}'>$note_type_name</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pages">Number of Pages</label>
                                <input type="text" name="no_of_pages" class="form-control" id="pages"
                                    placeholder="Enter number of note pages" <?php if (isset($edit_pages)) {
                                                                                echo "value='$edit_pages'";
                                                                            } ?>>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Description *</label>
                                <textarea class="form-control" name="description" id="description"
                                    <?php echo "placeholder='$description'"; ?> required></textarea>
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
                                <?php
                                $getcountryquery = "SELECT * FROM countries WHERE isactive = b'1'";
                                $countryquery = mysqli_query($conn, $getcountryquery);
                                $countryrows = mysqli_num_rows($countryquery);
                                ?>
                                <select id="country" name="country" class="form-control">
                                    <?php
                                        for ($i = 1; $i <= $countryrows; $i++) {
                                            $countryrow = mysqli_fetch_array($countryquery);
                                            $country_id = $countryrow['id'];
                                            $country_name = $countryrow['name'];
                                            if ($note_type_id == $country) {
                                                echo "<option value='$country_id' selected>$country_name</option>";
                                            } else {
                                                echo "<option value='$country_id'>$country_name</option>";
                                            }
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="institution">Institution Name</label>
                                <input type="text" name="institute" class="form-control" id="institution"
                                    placeholder="Enter your Institution Name" <?php if (isset($institution_name)) {
                                                                                echo "value='$institution_name'";
                                                                            } ?>>
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
                                    placeholder="Enter your course name" <?php if (isset($course)) {
                                                                                echo "value='$course'";
                                                                            } ?>>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="code">Course Code</label>
                                <input type="text" name="coursecode" class="form-control" id="#"
                                    placeholder="Enter your course code" <?php if (isset($course_code)) {
                                                                                echo "value='$course_code'";
                                                                            } ?>>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="professor">Professor/Lecturer</label>
                                <input type="text" name="professor" class="form-control" id="#"
                                    placeholder="Enter your professor name"<?php if (isset($professor)) {
                                                                                echo "value='$professor'";
                                                                            } ?>>
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
                                    <p id="radio-heading">Sell For *</p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ispaid" id="free"
                                            value="0" <?php if ($sell == 0) {
                                                            echo "checked";
                                                        } ?>>
                                        <label class="form-check-label" for="free">Free</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ispaid" id="paid"
                                            value="1" <?php if ($sell == 1) {
                                                            echo "checked";
                                                        } ?>>
                                        <label class="form-check-label" for="paid">Paid</label>
                                    </div>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="sell-price">Sell Price</label>
                                    <input type="text" name="sellingprice" class="form-control" id="#sell-price"
                                        placeholder="Enter your price" <?php if ($sell == 0) {
                                                                            echo "value='$sell_price'";
                                                                        } ?>>
                                </div>

                            </div>
                            <div class="col-md-6 sell-section">
                                <div class="form-group col-md-12">
                                    <label for="note-preview">Note Preview</label>
                                    <input type="file" name="note-preview" class="form-control-file image-note-preview" id="note-preview" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="sell-btn">
                                <button type="submit" name="submit" class="btn btn-sell" <?php echo isset($_POST['submit']) ? 'disabled="true"' : '';?> >SAVE</button>
                            </div>
                            <div class="sell-btn">
                                
                                <button type="submit" name="publish" class="btn btn-sell btn-publish">PUBLISH</button>
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