<?php

session_start();
ob_start();
include "connection_db.php";


if (!isset($_SESSION['loggedin'])) {
    header('location:../login.php');
} else {
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $email = $_SESSION['email'];
    $userid = $_SESSION['userid'];
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
    <title>My Downloads Page</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

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

    if (isset($_POST['submit'])) {
        $rating = $_POST['rate1'];
        $comment = $_POST['note-comment'];
        $noteid = $_POST['noteid'];

        $getid = "SELECT * FROM downloads WHERE noteid = $noteid AND downloader = $userid";
        $getidquery = mysqli_query($conn, $getid);
        $iddata = mysqli_fetch_assoc($getidquery);
        $againstdwdid = $iddata['id'];

        $check = "SELECT * FROM sellernotesreviews WHERE noteid = '$noteid' AND reviewedbyid = '$userid'";
        $checkquery = mysqli_query($conn, $check);
        $checkcount = mysqli_num_rows($checkquery);

        if ($checkcount == 0) {
            $insertrating = "INSERT INTO `sellernotesreviews` (`noteid`, `reviewedbyid`, `againstdownloadsid`, `ratings`, `comments`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES ('$noteid', '$userid', '$againstdwdid', '$rating', '$comment', current_timestamp(), '$userid', current_timestamp(), '$userid', b'1')";
            $insratingquery = mysqli_query($conn, $insertrating);
            if (!($insratingquery)) {
                echo "first";
                die("QUERY FAILED" . mysqli_error($conn));
            }
        } else {
            $updaterating = "UPDATE `sellernotesreviews` SET `ratings` = '$rating', `comments` = '$comment', `isactive` = b'1' WHERE noteid = '$noteid' AND reviewedbyid = '$userid'";
            $update = mysqli_query($conn, $updaterating);
            if (!($update)) {
                echo "second";
                die("QUERY FAILED" . mysqli_error($conn));
            }
        }
    }
    
    if (isset($_POST['reportissue'])) {
        $remarkcontent = $_POST['remark-content'];
        $noteid = $_POST['noteid'];

        $getid = "SELECT * FROM downloads WHERE noteid = $noteid AND downloader = $userid";
        $getidquery = mysqli_query($conn, $getid);
        $iddata = mysqli_fetch_assoc($getidquery);
        $againstdwdid = $iddata['id'];

        $check = "SELECT * FROM sellernotesreportedissues WHERE noteid = '$noteid' AND reportedbyid = '$userid'";
        $checkquery = mysqli_query($conn, $check);
        $checkcount = mysqli_num_rows($checkquery);

        if ($checkcount == 0) {
            $insertremark = "INSERT INTO `sellernotesreportedissues` (`noteid`, `reportedbyid`, `againstdownloadid`, `remarks`, `createddate`, `createdby`, `modifieddate`, `modifiedby`) VALUES ('$noteid', '$userid', '$againstdwdid', '$remarkcontent', current_timestamp(), '$userid', current_timestamp(), '$userid')";
            $insremarkquery = mysqli_query($conn, $insertremark);
            if (!($insremarkquery)) {
                echo "first";
                die("QUERY FAILED" . mysqli_error($conn));
            }
        } else {
            $updateremark = "UPDATE `sellernotesreportedissues` SET `remarks` = '$remarkcontent', `modifieddate` = current_timestamp(), `modifiedby` = '$userid' WHERE noteid = '$noteid' AND reportedbyid = '$userid'";
            $update = mysqli_query($conn, $updateremark);
            if (!($update)) {
                echo "second";
                die("QUERY FAILED" . mysqli_error($conn));
            }
        }
    }
    
    ?>
    <!--  My Download  -->
    <section id="download-notes">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <div class="basic-heading-sm">
                            <h3>My Download</h3>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="row">
                            <div class="search-bar col-md-9 col-sm-9">
                                <div class="form-group">
                                    <input type="search" class="form-control" name="valueToSearch" id="search" placeholder="Search">
                                </div>
                            </div>
                            <div class="search-btn col-md-3 col-sm-3">
                                <a class="btn btn-search search-btn" name="btn-search" title="Search" role="button">Search</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row table-general table-responsive">
                    <table class="table table-hover" id="downloads_table">
                        <thead>
                            <tr>
                                <th scope="col" class="table-header">SR NO.</th>
                                <th scope="col" class="table-header title">Note title</th>
                                <th scope="col" class="table-header">Category</th>
                                <th scope="col" class="table-header">Buyer</th>
                                <th scope="col" class="table-header">Sell Type</th>
                                <th scope="col" class="table-header">Price</th>
                                <th scope="col" class="table-header date">Downloaded Date/Time</th>
                                <th scope="col" class="table-header text-center blank"></th>
                            </tr>
                        </thead>
                        
                        
                        
                        <tbody>
                        <?php
                        $select = "SELECT * FROM downloads WHERE issellerhasalloweddownload = 1 AND attachmentpath IS NOT NULL AND seller != $userid AND downloader = $userid GROUP BY noteid,downloader ORDER BY attachmentdownloadeddate DESC";
                        $downdata = mysqli_query($conn,$select);
                        $count = mysqli_num_rows($downdata);
                            
                        for ($i = 1; $i <= $count; $i++) {
                       
                            $downloads_row = mysqli_fetch_assoc($downdata);
                            $noteid = $downloads_row['noteid'];
                            $selectquery = "SELECT * FROM sellernotes WHERE id = '$noteid'";
                            $notedetail = mysqli_query($conn, $selectquery);
                            $notedata = mysqli_fetch_assoc($notedetail);    
                            ?>    

                            <tr class="text-center">
                                <td><?php echo $i; ?></td>
                                <td><a class="mydownload" name="mydownload" href="notedetails.php?id=<?php echo $noteid; ?>" role="button"><?php echo $notedata['title']; ?></a></td>
                                <td><?php
                                    $cateid = $notedata['category'];
                                    $categoryquery = "SELECT * FROM notecategories WHERE id = '$cateid' AND isactive = b'1'";
                                    $categorydata = mysqli_query($conn, $categoryquery);
                                    $category = mysqli_fetch_assoc($categorydata);
                                    echo $category['name']; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php if ($notedata['ispaid'] == 0){
                                              echo 'Free';
                                          }else{
                                              echo 'Paid';
                                          }
                                     ?></td>
                                <td><?php echo "$" . $notedata['sellingprice']; ?></td>
                                <td><?php
                                    $ddate = $downloads_row['attachmentdownloadeddate'];
                                    $date = strtotime($ddate);
                                    echo date('d-m-Y, H:i:s', $date); ?></td>
                                
                                <td>
                                    <a href="notedetails.php?id=<?php echo $noteid; ?>"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                                    <div class="btn-group dropleft">
                                        <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="images/Dashboard/dots.png" alt="menu">
                                        </button>
                                        <div class="dropdown-menu">
                                            <!-- Dropdown menu links -->
                                            <a target="_blank" href="downloadnotes.php?id=<?php echo $noteid; ?>">Download Note</a>
                                            <a href="#" data-toggle="modal" data-target="#reviewmodal<?php echo $i; ?>">Add Reviews/Feedback</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#inappropriate<?php echo $i; ?>">Report as Inappropriate</a>
                                            
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="reviewmodal<?php echo $i; ?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="" method="post">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reviewmodal">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h3>Add Review</h3>
                                                    </div>
                                                    <!-- Rating -->
                                                    
                                                    <fieldset class="rate">
                                                        <input type="radio" id="star<?php echo $i; ?>5" name="rate1" value="5" /><label class="full" for="star<?php echo $i; ?>5" title="5 stars"></label>
                                                        
                                                        <input type="radio" id="star<?php echo $i; ?>4" name="rate1" value="4" /><label class="full" for="star<?php echo $i; ?>4" title="4 stars"></label>
                                                        
                                                        <input type="radio" id="star<?php echo $i; ?>3" name="rate1" value="3" /><label class="full" for="star<?php echo $i; ?>3" title="3 stars"></label>
                                                        
                                                        <input type="radio" id="star<?php echo $i; ?>2" name="rate1" value="2" /><label class="full" for="star<?php echo $i; ?>2" title="2 stars"></label>
                                                        
                                                        <input type="radio" id="star<?php echo $i; ?>1" name="rate1" value="1" /><label class="full" for="star<?php echo $i; ?>1" title="1 star"></label>
                                                        
                                                    </fieldset>
                                                </div>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group" id="modal-review-feedback">
                                                <label for="review">Comments *</label>
                                                <textarea class="form-control" id="review" name="note-comment" placeholder="comments..."></textarea>
                                            </div>
                                            <input type="hidden" name="noteid" value="<?php echo $noteid; ?>" />
                                            <div class="submit-btn">
                                                <button type="submit" name="submit" class="btn btn-submit" href="#" title="submit" role="button">Submit</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="modal fade" id="inappropriate<?php echo $i; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3>Report as an inappropriate</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <form action="" method="POST">
                                                <div class="form-row col-md-12">
                                                    <div class="comment-area col-md-12">
                                                        <div class="form-group">
                                                            <label for="remark-title">Title</label>
                                                            <input type="text" class="form-control" id="remark-title" name="remark-title" value=" <?php echo $notedata['title']; ?>" readonly />
                                                        </div>
                                                        <div class="form-group" id="modal-review-feedback">
                                                            <label for="remark-content">Remarks</label>
                                                            <textarea class="form-control" id="remark-content" name="remark-content" placeholder="Remarks..."></textarea>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row col-md-12">
                                                    <input type="hidden" name="noteid" value="<?php echo $noteid; ?>" />

                                                    <button type="button" class="btn btn-secondary" style="margin: 0px 10px;" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="reportissue" class="btn btn-danger btn-issue">Report an issue</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            </div>
                        <?php
                        };
                        ?>    
                        </tbody>
                    </table>

                </div>

                
            </div>

        </div>

    </section>
    <!--  My Download Ends -->
    <hr>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <!-- Copyright -->
                <div class="col-md-6 col-sm-8 footer-text text-left">
                    <p>Copyright &copy; TatvaSoft All rights reserved.</p>
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

    <!-- Popper JS -->
    <script src="js/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    
    <!-- DataTable JS -->
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
    
    <script>
        $(document).ready(function() {
            var table = $('#downloads_table').DataTable({
                'sDom': '"top"i',
                "iDisplayLength": 10,
                language: {
                    paginate: {
                        next: '<img src="images/Search/right-arrow.png" alt="next" class="right-arrow">',
                        previous: '<img src="images/Search/left-arrow.png" alt="previous" class="left-arrow">'
                    }
                }
            });

            $('.search-btn').click(function() {
                var x = $('#search').val();
                table.search(x).draw();

            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('.btn-issue').click(function() {
                if (confirm('Are you sure you want to mark this report as spam, you cannot update it later?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
</body>

</html>