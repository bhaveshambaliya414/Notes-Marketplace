<?php
session_start();
ob_start();

if (!isset($_SESSION['loggedin'])) {
    header('location:../login.php');
} else {
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $email_id = $_SESSION['email'];
    $userid = $_SESSION['userid'];
}

include "connection_db.php";
include 'sendmail.php';


$userid = "";
$userid = $_SESSION['userid'];
$isflag = 0;
$name_to_store_np = "";
$name_to_store_dp = "";
$selling_price = "";
$last_inserted_id = "";
$is_note_inserted = "false";
$last_query = "";


if (isset($_POST['submit'])) {
    
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
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
    $note_preview = $_FILES['note-preview'];
    $display_picture = $_FILES['display-picture'];
    $notes_data = $_FILES['notes-data'];
    
    // note preview 
    $note_preview_filename = $note_preview['name'];
    $note_preview_fileerror = $note_preview['error'];
    $note_preview_filetemp = $note_preview['tmp_name'];

    $note_preview_fileext = explode('.', $note_preview_filename);
    $note_preview_filecheck = strtolower(end($note_preview_fileext));
    $note_preview_ext = end($note_preview_fileext);

    $fileextstored = array('pdf');


    // display picture 
    $display_pic_filename = $display_picture['name'];
    $display_pic_fileerror = $display_picture['error'];
    $display_pic_filetemp = $display_picture['tmp_name'];

    $display_pic_fileext = explode('.', $display_pic_filename);
    $display_pic_filecheck = strtolower(end($display_pic_fileext));
    $display_pic_ext = end($display_pic_fileext);
    $display_pic_fileextstored = array('png', 'jpg', 'jpeg');

    
        if ($ispaid == "0") {

            if (!empty($note_preview_filename)) {
                if (in_array($note_preview_filecheck, $fileextstored)) {


                    $name_to_store_np = $note_preview_filename;
                } else {
    ?>
                    <script>
                        alert("select proper file type for preview 1")
                    </script>
                <?php
                }
            } // free with preview end

        } // free selling off
        else {
            if (!empty($sellingprice) && !empty($note_preview_filename)) {
                if (in_array($note_preview_filecheck, $fileextstored)) {

                    $name_to_store_np = $note_preview_filename;
                } else {
                ?>
                    <script>
                        alert("select proper file type for preview 2")
                    </script>
                <?php
                }
            }
        } // paid selling off

        if (!empty($display_pic_filename)) {
            if (in_array($display_pic_filecheck, $display_pic_fileextstored)) {

                $name_to_store_dp = $display_pic_filename;
            } else {
                ?>
                <script>
                    alert("select proper file type for preview 2")
                </script>
                <?php
            }
        } // display pic provided end 
        else {
        } // default display pic end

        if (!empty($title) && !empty($category) && !empty($notes_data) && !empty($type) && !empty($description) && !empty($country) && !empty($institute) && !empty($coursename) && !empty($coursecode)) {

            if ($ispaid == "1") {
                if (!empty($sellingprice) && !empty($name_to_store_np)) {
                    $selling_price = $sellingprice;
                    
                    $insert_note_query = "INSERT INTO sellernotes(sellerid, status, actionedby, adminremarks, publisheddate, title, category, displaypicture, notetype, numberofpages, description, universityname, country, course, coursecode, professor, ispaid, sellingprice, notespreview, createddate, createdby, modifieddate, modifiedby, isactive) VALUES ('$userid', '1', '$userid', NULL, current_timestamp(), '$title', '$category', '$name_to_store_dp', $type, '$no_of_pages', '$description','$institute', '$country', '$coursename', '$coursecode', '$professor', '$ispaid', '$selling_price', '$name_to_store_np', current_timestamp(),'$userid', current_timestamp(), '$userid', b'1')";

                    $inotequery = mysqli_query($conn, $insert_note_query);

                    if ($inotequery) {
                        $is_note_inserted = "true";
                        $last_inserted_id = mysqli_insert_id($conn);

                        $_SESSION['last_id'] = $last_inserted_id;
                        $_SESSION['note_title'] = $title;
                    } else {
                ?>
                        <script>
                            alert("query fail to insert with paid note")
                        </script>
                    <?php
                    }
                } // paid note with selling price end
                else {
                    ?>
                    <script>
                        alert("please enter selling amount and notes preview")
                    </script>
                <?php
                } // paid note withour selling price
            } // paid note inserted successfully
            else {
                $selling_price = 0;
                
                $insert_note_query = "INSERT INTO sellernotes(sellerid, status, actionedby, adminremarks, publisheddate, title, category, displaypicture, notetype, numberofpages, description, universityname, country, course, coursecode, professor, ispaid, sellingprice, notespreview, createddate, createdby, modifieddate, modifiedby, isactive) VALUES ('$userid', '1', '$userid', NULL, current_timestamp(), '$title', '$category', '$name_to_store_dp', $type, '$no_of_pages', '$description','$institute', '$country', '$coursename', '$coursecode', '$professor', '$ispaid', '$selling_price', '$name_to_store_np', current_timestamp(),'$userid', current_timestamp(), '$userid', b'1')";

                $inotequery = mysqli_query($conn, $insert_note_query);

                if ($inotequery) {
                    $is_note_inserted = "true";
                    $last_inserted_id = mysqli_insert_id($conn);

                    $_SESSION['last_id'] = $last_inserted_id;
                    $_SESSION['note_title'] = $title;
                } else {
                ?>
                    <script>
                        alert("query fail to insert with free note")
                    </script>
                    <?php
                }
            }
        } // all field provided ends
        else {
            echo "all fields are required please fill all fields..";
        } // missing some field ends

        if ($is_note_inserted == "true") {

            if (!empty($last_inserted_id)) {

                // notes atteachments file data

                $atta_count = count($_FILES['notes-data']['name']);

                for ($i = 0; $i < $atta_count; $i++) {
                    $notes_data_filename = $_FILES['notes-data']['name'][$i];
                    $notes_data_filetemp = $_FILES['notes-data']['tmp_name'][$i];

                    $note_date_fileext = explode('.', $notes_data_filename);
                    $note_data_filecheck = strtolower(end($note_date_fileext));
                    $note_data_ext = end($note_date_fileext);

                    if (in_array($note_data_filecheck, $fileextstored)) {

                        $store_name_atta = "Attachement_" . $i . "_" . date("dmyhis") . "." . $note_data_ext;
                        $atta_path = "../Members/$userid/$last_inserted_id/Attachements/$store_name_atta";

                        $insert_attachements = "INSERT INTO `sellernotesattachments`(`noteid`, `filename`, `filepath`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES ($last_inserted_id, '$store_name_atta', '$atta_path', current_timestamp(), '1', current_timestamp(), '1', b'1')";


                        date_default_timezone_set('Asia/Kolkata');


                        if (!is_dir("../Members/$userid/$last_inserted_id/Attachements")) {
                            mkdir("../Members/$userid/$last_inserted_id/Attachements", 0777, true);
                        }
                        move_uploaded_file($notes_data_filetemp, "../Members/$userid/$last_inserted_id/Attachements/$store_name_atta");

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

                $store_name_dp = "DP_" . date("dmyhis") . "." . $display_pic_ext;
                $store_name_np = "Preview_" . date("dmyhis") . "." . $note_preview_ext;
                if (!is_dir("../Members/$userid/$last_inserted_id")) {
                    mkdir("../Members/$userid/$last_inserted_id", 0777, true);
                }

                move_uploaded_file($display_pic_filetemp, "../Members/$userid/$last_inserted_id/$store_name_dp");
                if (!empty($note_preview_filetemp)) {
                    move_uploaded_file($note_preview_filetemp, "../Members/$userid/$last_inserted_id/$store_name_np");
                }

                $update_name = "UPDATE `sellernotes` SET `displaypicture` = '$store_name_dp', `notespreview` = '$store_name_np' WHERE `sellernotes`.`id` = '$last_inserted_id'";
                $update_name_query = mysqli_query($conn, $update_name);
                if (!($update_name_query)) {
                    die("QUERY FAILED" . mysqli_error($conn));
                }
                $isflag = 1;
            } // notes attachements are stored and files are moved to folder
            else {
                ?>
                <script>
                    alert("somthing went wrong")
                </script>
            <?php
            }
            $is_note_inserted == "true";
        }
    }    
    

if (isset($_POST['publish'])) {
    $last_note_id = $_SESSION['last_id'];
    $seller_email = $_SESSION['email'];
    $seller_name= $_SESSION['firstname'];
    $notetitle = $_SESSION['note_title'];
    
    $uquery = "UPDATE sellernotes SET status = 2 WHERE id = '$last_note_id'";
    
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
            header('location:dashboard.php');
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
                                    placeholder="Enter your notes title" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="category">Category *</label>
                                <?php
                                $getcategoryquery = "SELECT * FROM notecategories WHERE isactive = b'1'";
                                $categoryquery = mysqli_query($conn, $getcategoryquery);
                                $categoryrows = mysqli_num_rows($categoryquery);
                                ?>
                                <select id="category" name="category" class="form-control">
                                    <option selected hidden value="">Select your category <type></type>
                                    </option>
                                    <?php
                                    for ($i = 1; $i <= $categoryrows; $i++) {
                                        $categoryrow = mysqli_fetch_array($categoryquery);
                                    ?>
                                        <option value="<?php echo $categoryrow["id"] ?>"><?php echo $categoryrow["name"] ?></option>
                                    <?php
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
                                    <option selected hidden value="">Select your note type<type></type>
                                    </option>
                                    <?php
                                    for ($i = 1; $i <= $notetyperows; $i++) {
                                        $notetyperow = mysqli_fetch_array($notetypequery);
                                    ?>
                                        <option value="<?php echo $notetyperow["id"] ?>"><?php echo $notetyperow["name"] ?></option>
                                    <?php
                                    }
                                    ?>
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
                                <?php
                                $getcountryquery = "SELECT * FROM countries WHERE isactive = b'1'";
                                $countryquery = mysqli_query($conn, $getcountryquery);
                                $countryrows = mysqli_num_rows($countryquery);
                                ?>
                                <select id="country" name="country" class="form-control">
                                    <option selected hidden value="">Select your country<type></type>
                                    </option>
                                    <?php
                                    for ($i = 1; $i <= $countryrows; $i++) {
                                        $countryrow = mysqli_fetch_array($countryquery);
                                    ?>
                                        <option value="<?php echo $countryrow["id"] ?>"><?php echo $countryrow["name"] ?></option>
                                    <?php
                                    }
                                    ?>
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
                                    <p id="radio-heading">Sell For *</p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ispaid" id="free"
                                            value="0" checked>
                                        <label class="form-check-label" for="free">Free</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ispaid" id="paid"
                                            value="1" checked>
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
                                    <input type="file" name="note-preview" class="form-control-file image-note-preview" id="note-preview" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="sell-btn">
                                <button type="submit" name="submit" class="btn btn-sell" <?php echo isset($_POST['submit']) ? 'disabled="true"' : '';?> >SAVE</button>
                            </div>
                            <div class="sell-btn">
                                
                                <button type="submit" name="publish" class="btn btn-sell btn-publish" <?php if($isflag == 0) { echo 'disabled';} else {echo 'enabled';} ?> >PUBLISH</button>
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