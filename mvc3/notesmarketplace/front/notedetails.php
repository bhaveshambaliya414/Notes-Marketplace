
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
    if (isset($_SESSION['loggedin'])) {
        
        $buyerid = $_SESSION['userid'];
        $buyername = $_SESSION['firstname'];
        $user_id = $_SESSION['userid'];
    
    }

    include 'sendmail.php';

    ?>


    <?php
    if (isset($_GET['id'])) {

        $noteid = $_GET['id'];

        $get_details = "SELECT * FROM sellernotes WHERE id='$noteid'";
        $details = mysqli_query($conn, $get_details);
        if (!($details)) {
            die("QUERY FAILED" . mysqli_error($conn));
        }
        $data = mysqli_fetch_assoc($details);
        $notetitle = $data['title'];
        $sellerid = $data['sellerid'];

        $notecategory = $data['category'];
        $notedesc = $data['description'];
        $noteuni = $data['universityname'];
        $unicontry = $data['country'];
        $notecourse = $data['course'];
        $notecoursecode = $data['coursecode'];
        $noteprof = $data['professor'];
        $notepage = $data['numberofpages'];
        $noteapprdate = $data['publisheddate'];
        $sellingtype = $data['ispaid'];
        $price = $data['sellingprice'];
        $notedp = $data['displaypicture'];

        $getcategory = "SELECT * FROM notecategories WHERE id = '$notecategory' AND isactive = b'1'";
        $catquery = mysqli_query($conn, $getcategory);
        $catdeatil = mysqli_fetch_assoc($catquery);
        $catname = $catdeatil['name'];

        $getseller = "SELECT * FROM users WHERE id = $sellerid";
        $seller = mysqli_query($conn, $getseller);
        $fetchseller = mysqli_fetch_assoc($seller);
        $sellername = $fetchseller['firstname'];
        $selleremail = $fetchseller['email'];
    }

    ?>
    <?php
    if (isset($_POST['paidnotes'])) {

        $getattacount = "SELECT * FROM sellernotesattachments WHERE noteid = $noteid";
        $getattacountquery = mysqli_query($conn, $getattacount);
        while ($attacount = mysqli_fetch_assoc($getattacountquery)) {
            $paidnote ="INSERT INTO `downloads`(`noteid`, `seller`, `downloader`, `issellerhasalloweddownload`, `attachmentpath`, `isattachmentdownloaded`, `attachmentdownloadeddate`, `ispaid`, `purchasedprice`, `notetitle`, `notecategory`, `createddate`, `createdby`, `modifieddate`, `modifiedby`) VALUES ('$noteid', '$sellerid', '$buyerid', b'0', NULL, b'0', current_timestamp(), b'1', '$price', '{$notetitle}', '{$catname}', current_timestamp(), '$buyerid', current_timestamp(), '$buyerid')";
            
            $paidresult = mysqli_query($conn, $paidnote);
            if (!($paidresult)) {
                die("QUERY FAILED" . mysqli_error($conn));
            }
        }
        $mail->addAddress($selleremail);  // This email is where you want to send the email
        $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address

        // Setting the email content
        $mail->IsHTML(true);
        $mail->Subject = "$buyername wants to purchase your notes";

        $mail->Body = "Hello $sellername, <br><br> We would like to inform you that, $buyername wants to purchase your notes. Please see Buyer Request tab and allow download access to Buyer if you have received the payment from him. <br><br> Regards,<br>Notes Marketplace";

        $mail->send();
    }
    ?>

    <!-- Notes details -->
    <section id="note-details">
        
        <div class="content-box">

            <div class="container">
            <form action="" method="post">
                <div class="row">
                    <div class="basic-heading-sm">
                        <h3>Note Details</h3>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            
                            <div class="book-image col-lg-5 col-md-5 col-sm-5 col-12 img-fluid">
                            <?php
                                if ($notedp != "") {
                                    echo "<img src='../Members/$sellerid/$noteid/$notedp' class='img-fluid'>";
                                } else {
                                    echo "<img src='images/note-details/note-img.jpeg' class='img-fluid'>";
                                }

                                ?>   
                                
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-12 book-info">
                                <?php
                                    
                                    $getcate = "SELECT * FROM notecategories WHERE isactive = b'1' AND id = '$notecategory'";
                                    $catequery = mysqli_query($conn, $getcate);
                                    $catedata = mysqli_fetch_assoc($catequery);

                                ?>
                                <h3><?php echo $notetitle; ?></h3>
                                <h6><?php echo $catedata['name']; ?></h6>
                                <p><?php echo "$notedesc"; ?></p>
                                <div class="download-btn">
                                    <?php if (isset($_SESSION['loggedin'])) {
                                            if ($sellingtype == 0) {
                                        ?>
                                                <button type="button" class="btn btn-download"><a target="_blank" href="downloadnotes.php?id=<?php echo "$noteid"; ?>">Download</a></button>
                                            <?php
                                            } else {
                                            ?>
                                                <button type="button" class="btn btn-download" id="paid-notes-btn">Download <?php echo "/$" . "$price"; ?></button>
                                            <?php
                                            }
                                            ?>

                                        <?php } else {
                                        ?>
                                            <button type="button" class="btn btn-download" onclick="login()">Download <?php echo "/$" . "$price"; ?></button>
                                        <?php
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="note-detail-right">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                    <p>Institution:</p>
                                </div>
                                <div class="col-md-6  col-sm-6 col-6 right-side text-right">
                                    <p><?php echo "$noteuni"; ?></p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                    <p>Country:</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 right-side text-right">
                                    <?php
                                    
                                    $getcoun = "SELECT * FROM countries WHERE isactive = b'1' AND id = '$unicontry'";
                                    $getcquery = mysqli_query($conn, $getcoun);
                                    $cdata = mysqli_fetch_assoc($getcquery);

                                    ?>
                                    <p><?php echo $cdata['name']; ?></p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                    <p>Course Name:</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 right-side text-right">
                                    <p><?php echo "$notecourse"; ?></p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                    <p>Course Code:</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 right-side text-right">
                                    <p><?php echo "$notecoursecode"; ?></p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                    <p>Professor:</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 right-side text-right">
                                    <p><?php echo "$noteprof"; ?></p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                    <p>Number of Pages:</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 right-side text-right">
                                    <p><?php echo "$notepage"; ?></p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                    <p>Approved Date:</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 right-side text-right">
                                    <p><?php
                                        $apprdate = $noteapprdate;
                                        $date = strtotime($apprdate);
                                        echo date('F j Y', $date);

                                        ?>
                                    </p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                    <p>Rating:</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 review right-side text-right">
                                    <div class="stars">
                                        <?php
                                        $getrating = "SELECT AVG(ratings) AS averagerating, COUNT(ratings) AS counts FROM sellernotesreviews WHERE noteid = $noteid";
                                        $ratingquery = mysqli_query($conn, $getrating);
                                        $avgrating = mysqli_fetch_assoc($ratingquery);
                                        $rating = $avgrating['averagerating'];
                                        $roundratings = round($rating);
                                        $countrating = $avgrating['counts'];
                                        for ($j = 1; $j <= $roundratings; $j++) {
                                        ?>
                                            <img src="images/Search/star.png">
                                        <?php
                                        }
                                        for ($k = 1; $k <= 5 - $roundratings; $k++) {
                                        ?>
                                            <img src="images/Search/star-white.png">
                                        <?php
                                        }
                                        ?><br>
                                        <span><?php echo $countrating; ?> Reviews</span>
                                        <!--<li>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            
                                        </li>-->
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12 instruction left-side text-left">
                                    <p><?php
                                        $issue = "SELECT * FROM sellernotesreportedissues WHERE noteid = $noteid";
                                        $issuequery = mysqli_query($conn, $issue);
                                        $countissue = mysqli_num_rows($issuequery);
                                        echo "$countissue Users marked this note as inappropriate";
                                        ?>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <hr>
            </form>    
            </div>
            
        </div>
       
    </section>
    <!-- Notes Details Ends-->

    <!-- Notes content and Reviews-->
    <section id="note-content">
        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12 col-12 note-preview">
                        <div class="basic-heading-sm">
                            <h3>Note Preview</h3>
                        </div>

                        <div class="note-detail-preview">
                            <?php
                            $getpreview = "SELECT * FROM sellernotes WHERE id = $noteid";
                            $previewquery = mysqli_query($conn, $getpreview);
                            if ($previewquery) {
                                $previewdata = mysqli_fetch_assoc($previewquery);
                                $previewpdf = $previewdata['notespreview'];
                                if ($previewpdf != "") {

                                    $notesellerid = $previewdata['sellerid'];

                                    echo  "<iframe src='../Members/$notesellerid/$noteid/$previewpdf' scrolling='no'></iframe>";
                                } else {
                            ?>
                                    <iframe src="http://www.africau.edu/images/default/sample.pdf" scrolling="no"></iframe>
                                <?php
                                }
                            } else {
                                ?>
                                <iframe src="http://www.africau.edu/images/default/sample.pdf" scrolling="no"></iframe>
                            <?php
                                }
                            ?>
                            
                        </div>
                    </div>


                    <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                        <div class="row">
                            <div class="basic-heading-sm col-md-12 col-sm-12 col-12">
                                <h3>Customer Reviews</h3>
                            </div>
                            <div class="customer-reviews">
                                <?php
                                $getreviews = "SELECT * FROM sellernotesreviews WHERE noteid = $noteid ORDER BY ratings DESC,createddate DESC";
                                $reviewquery = mysqli_query($conn, $getreviews);
                                if (mysqli_num_rows($reviewquery) == 0) {
                                    echo '<h3 style="color:#6255a5;text-align: center;">No Reviews</h3>';
                                } else {
                                    while ($reviewdata = mysqli_fetch_assoc($reviewquery)) {
                                        $reviewerid = $reviewdata['reviewedbyid'];
                                        $reviewratingcount = $reviewdata['ratings'];
                                        $reviewdesc = $reviewdata['comments'];
                                        $reviewratingcount = round($reviewratingcount);

                                        $getuserdata = "SELECT * FROM users WHERE id = $reviewerid";
                                        $userdataquery = mysqli_query($conn, $getuserdata);
                                        $reviewerdata = mysqli_fetch_assoc($userdataquery);
                                        $rfirstname = $reviewerdata['firstname'];
                                        $rlastname = $reviewerdata['lastname'];

                                ?>
                                <!-- review 1 -->
                                <div class="row">
                                    <div class="customer-image col-lg-2 col-md-3 col-sm-2 col-3">
                                    <?php

                                    $userdp = "SELECT * FROM userprofile WHERE userid = $reviewerid";
                                    $userdpquery = mysqli_query($conn, $userdp);
                                    if (!($userdpquery)) {
                                        die("QUERY FAILED" . mysqli_error($conn));
                                    } else {
                                        $rowdata = mysqli_fetch_assoc($userdpquery);
                                        $dpname = $rowdata['profilepicture'];
                                        if ($dpname != "") {
                                            echo "<img src='../Members/$reviewerid/$dpname' alt='user' class='img-responsive img-circle'>";
                                        } else {
                                            echo "<img src='images/note-details/reviewer-1.png' class='img-fluid img-circle'>";
                                        }
                                    }

                                    ?>    
                                        
                                    </div>
                                    <div class="col-lg-10 col-md-9 col-sm-10 col-9">
                                        <div class="review">
                                            <h5><?php echo $rfirstname . " " . $rlastname; ?></h5>
                                            <div class="stars text-left">
                                                <?php
                                                for ($j = 1; $j <= $reviewratingcount; $j++) { ?>
                                                    <img src="images/Search/star.png" style="height: 25px; width:30px;">
                                                <?php
                                                }
                                                for ($k = 1; $k <= 5 - $reviewratingcount; $k++) {
                                                ?>
                                                    <img src="images/Search/star-white.png" style="height: 25px; width:30px;">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <p><?php echo $reviewdesc; ?></p>
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <?php
                                    }
                                }
                                ?>
                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Notes Details Ends-->
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

    <!-- Modal -->
    <div class="modal" id="exampleModalLong" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="datamodel">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img src="images/note-details/SUCCESS.png" alt="success">
                            </div>
                            <div class="col-md-12 text-center">
                                <h3>Thank you for purchasing!</h3>
                            </div>
                        </div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Dear Smith,</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id tempora ab tenetur, a libero voluptatum vero officiis similique iste amet, quam, in autem culpa qui quisquam, maiores omnis minima recusandae?</p>

                    <p>In case, you have urgency,<br>Please contact us on +919589634556</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque aliquam dolor excepturi porro, </p>

                    <p>Have a good day</p>
                </div>
            </div>
        </div>
    </div>


    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
    
    <script>
        function login() {
            alert("please login first to download note.");
            window.location.href = "../login.php";
        }

        $('#paid-notes-btn').click(function() {
            if (confirm('Are you sure you want to download this paid note. Please confirm')) {
                $(this).attr('data-toggle', 'modal').attr('data-target', '#exampleModalLong');
                $.ajax({
                    type: "POST",
                    url: "notedetails.php?id=<?php echo $noteid; ?>",
                    data: {
                        'paidnotes': 'paidnotes'
                    },
                    dataType: "text",
                    success: function(res) {},
                    error: function(res) {
                        alert("error in ajax call");
                    }
                });
                return true;

            } else {
                return false;
            }
        });
    </script>
    
</body>

</html>