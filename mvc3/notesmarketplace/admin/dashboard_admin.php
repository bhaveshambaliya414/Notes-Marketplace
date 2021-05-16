

<?php
session_start();
ob_start();
include "../front/connection_db.php";
$page = 'dashboard';
if (!isset($_SESSION['loggedin']) && !((isset($_SESSION['is_admin'])) || (isset($_SESSION['is_superadmin'])))) {
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
    <title>Dashboard Admin</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">


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
                                    <a class="dropdown-item logout logout-action" href="../logout.php">Logout</a>
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


    if (isset($_POST['unpublishnote'])) {
        $remarkcontent = $_POST['remark-content'];
        $noteid = $_POST['noteid'];

        $sellerid = "";
        $selleremail = "";
        $sellername = "";
        $notename = "";

        $getsdetail = "SELECT * FROM sellernotes WHERE id = $noteid";
        $getsdetailquery = mysqli_query($conn, $getsdetail);
        if ($getsdetailquery) {
            $snotedata = mysqli_fetch_assoc($getsdetailquery);

            $sellerid = $snotedata['sellerid'];
            $notename = $snotedata['title'];

            $getseller = "SELECT * FROM users WHERE id = $sellerid AND isactive = b'1'";
            $getsellerquery = mysqli_query($conn, $getseller);
            $sellerdata = mysqli_fetch_assoc($getsellerquery);
            $selleremail = $sellerdata['email'];
            $sellername = $sellerdata['firstname'];
        }


        $remove = "UPDATE `sellernotes` SET `status` = '6', `isactive` = b'0', `adminremarks` = '$remarkcontent', `actionedby` = '$adminid' WHERE id = '$noteid'";
        $removequery = mysqli_query($conn, $remove);
        if ($removequery) {
            $updatedwd = "UPDATE `downloads` SET `isactive` = b'0' WHERE noteid = '$noteid'";
            $updatedwdquery = mysqli_query($conn, $updatedwd);
            if (!($updatedwdquery)) {
                die("QUERY FAILED" . mysqli_error($conn));
            }

            $updateatta = "UPDATE `sellernotesattachements` SET `isactive` = b'0' WHERE noteid = '$noteid'";
            $updateattaquery = mysqli_query($conn, $updateatta);
            if (!($updateattaquery)) {
                die("QUERY FAILED" . mysqli_error($conn));
            }

            $mail->addAddress($selleremail);  // This email is where you want to send the email
            $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address

            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = "Sorry! we need to remove your notes from our portal.";

            $mail->Body = "Hello $sellername, <br><br> We want to inform you that, your note $notename has been removed from the portal. <br> Please find our remarks as below- <br> $remarkcontent <br><br> Regards,<br>Notes Marketplace";

            $mail->send();
        } else {
            die("QUERY FAILED" . mysqli_error($conn));
        }
    }

    ?>


    <!-- Dashboard  -->
    <section id="dashboard">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="basic-heading">
                        <h3>Dashboard</h3>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3><?php 
                                $inreviewdata = "SELECT * FROM sellernotes WHERE status = 3 AND isactive = b'1'";
                                $inreviewquery = mysqli_query($conn,$inreviewdata);
                                $count = mysqli_num_rows($inreviewquery);
                                ?>
                            <a href="notesunderreview.php"><?php echo $count; ?></a> 
                            </h3>
                            <p>Number of Notes in Review for Publish</p>
                        </div>

                    </div>

                    <div class="col-md-4 ">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3><?php
                                $dselect = "SELECT * FROM downloads WHERE issellerhasalloweddownload = 1 AND attachmentpath IS NOT NULL AND seller != downloader AND createddate >= now()-INTERVAL 1 week GROUP BY noteid,downloader,createddate";
                                $downdata = mysqli_query($conn,$dselect);
                                $dcount = mysqli_num_rows($downdata);
                                ?>
                            <a href="downloadsnotes.php"><?php echo $dcount; ?></a>    
                            </h3>
                            <p>Number of New Notes Downloaded<br>(Last 7 days)</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3><?php
                                $userquery = "SELECT * FROM users WHERE roleid = 1 AND isactive = b'1' AND createddate >= now()-INTERVAL 1 week";
                                $userdata = mysqli_query($conn,$userquery);
                                $ucount = mysqli_num_rows($userdata);
                                ?>
                            <a href="members.php"><?php echo $ucount; ?></a>       
                            </h3>
                            <p>Number of New Registrations (Last 7 days)</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Dashboard Ends -->



    <!--  Published Note -->
    <section id="published">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="col-lg-5">
                        <div class="basic-heading-sm col-md-12">
                            <h3>Published Notes</h3>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="search-bar col-lg-6 col-md-7 col-sm-12 col-12">
                                <div class="form-group">
                                    <input type="search" class="form-control" id="search" placeholder="Search">
                                </div>
                            </div>
                            <div class="search-btn col-lg-2 col-md-2 col-sm-8 col-12">
                                <a class="btn btn-search" href="#" title="Search" role="button">Search</a>
                            </div>
                            <div class="form-group select-month col-lg-4 col-md-3 col-sm-4 col-6">
                                <select id="inputstate month" class="form-control">
                                    <?php
                                        $currentMonthName = date('F');
                                            
                                        for ($i = 0; $i < 6; $i++) {
                                            $MonthName = date("F", strtotime(date('Y-m-01') . " -$i months"));
                                            $MonthValue = date("-m-Y", strtotime(date('Y-m-01') . " -$i months"));
                                            if ($MonthName == $currentMonthName) {
                                                echo "<option value='{$MonthValue}' selected>{$MonthName}</option>";
                                            } else {
                                                echo "<option value='{$MonthValue}'>{$MonthName}</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row table-general table-responsive">
                    <table class="table table-hover" id="dashboard_table">
                        <thead>
                        <tr>
                            <th scope="col" class="table-header">SR No.</th>
                            <th scope="col" class="table-header title">Title</th>
                            <th scope="col" class="table-header">Category</th>
                            <th scope="col" class="table-header text-center">Attachment Size</th>
                            <th scope="col" class="table-header">Sell Type</th>
                            <th scope="col" class="table-header">Price</th>
                            <th scope="col" class="table-header">Publisher</th>
                            <th scope="col" class="table-header">Published Date</th>
                            <th scope="col" class="table-header text-center">Number of Downloads</th>
                            <th scope="col" class="table-header blank"></th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        <?php
                        $sizes = array("Bytes", "KB", "MB", "GB");
                        $size = 0;    
                        $select = "SELECT * FROM sellernotes WHERE status=2";
                        $pquery = mysqli_query($conn,$select);
                        $count = mysqli_num_rows($pquery);

                        for ($i = 1; $i <= $count; $i++) {
                            $published_row = mysqli_fetch_assoc($pquery); 
                        ?>    
                         
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td class="color-blue"><a href="notesdetailsadmin.php?id=<?php echo $published_row['id']; ?>"><?php echo $published_row['title']; ?></a></td>
                            <td>
                                <?php
                                    $cateid = $published_row['category'];
                                    $getcate = "SELECT * FROM notecategories WHERE isactive = b'1' AND id = '$cateid'";
                                    $catequery = mysqli_query($conn, $getcate);
                                    $catedata = mysqli_fetch_assoc($catequery);

                                 echo $catedata['name']; 
                                ?>
                            </td>
                            <td class="text-center">
                                <?php
                                $pnoteid = $published_row['id'];
                                $noteatta = "SELECT * FROM sellernotesattachments WHERE noteid = $pnoteid";
                                $noteattaquery = mysqli_query($conn, $noteatta);
                                while ($noteatta_row = mysqli_fetch_assoc($noteattaquery)) {
                                    $filepath = $noteatta_row['filepath'];
                                    $size = $size + filesize($filepath);
                                }
                                $attachment_size = round($size / pow(1024, ($h = floor(log($size, 1024)))), 2) . $sizes[$h];
                                echo $attachment_size;
                                ?></td>
                            <td><?php if ($published_row['ispaid'] == 0){
                                          echo 'Free';
                                      }else{
                                          echo 'Paid';
                                      }
                                 ?></td>
                            <td><?php echo "$" . $published_row['sellingprice']; ?></td>
                            <td><?php
                                    $publisherid = $published_row['actionedby'];
                                    $getpublisher = "SELECT * FROM users WHERE id= '$publisherid' AND isactive = b'1'";
                                    $getpquery = mysqli_query($conn, $getpublisher);
                                    $getpublisherdata = mysqli_fetch_assoc($getpquery);
                                    echo $getpublisherdata['firstname'] . " " . $getpublisherdata['lastname'];
                                ?></td>
                            <td><?php $publisheddate =  $published_row['publisheddate'];
                                        $date = strtotime($publisheddate);
                                        echo date('d-m-Y, H:i', $date); ?></td>
                            <td class="color-blue text-center"><?php echo $published_row['numberofpages']; ?></td>
                            <td><?php 
                                if($published_row["status"] == 2){
                                ?>    
                                <div class="btn-group dropleft">
                                    <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php
                                    echo '<img src="images/Dashboard/dots.png" alt="menu">';
                                    ?>
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <a href="downloadnotes_admin.php?id=<?php echo $published_row['id']; ?>"><button class="dropdown-item" type="button">Download Notes</button></a>
                                        <a href="notesdetailsadmin.php?id=<?php echo $published_row['id']; ?>">View More Details</a>
                                        
                                        <a><button class="dropdown-item" type="button" role="button" data-toggle="modal" data-target="#unpublish<?php echo $i; ?>">Unpublish</button></a>


                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </td>
                            
                        </tr>
                        <div class="modal fade" id="unpublish<?php echo $i; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3>Unpublish a note</h3>
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
                                                            <input type="text" class="form-control" id="remark-title" name="remark-title" value=" <?php echo $published_row['title']; ?>" readonly />
                                                        </div>
                                                        <div class="form-group" id="modal-review-feedback">
                                                            <label for="remark-content">Remarks*</label>
                                                            <textarea class="form-control" id="remark-content" name="remark-content" placeholder="Remarks..." required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row col-md-12">
                                                    <input type="hidden" name="noteid" value="<?php echo $published_row['id']; ?>" />
                                                    <button type="button" class="btn btn-secondary" style="margin: 0px 10px;" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="unpublishnote" class="btn btn-unpublish">Unpublish</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <?php
                        }
                        ?>
                        </tbody>    
                    </table>

                </div>
                
            </div>

        </div>

    </section>
    <!--  Published Note Ends -->
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
    
    <!-- DataTable JS -->
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
    
    <script>
        $(document).ready(function() {
            var table = $('#dashboard_table').DataTable({
                'sDom': '"top"i',
                "iDisplayLength": 10,
                language: {
                    paginate: {
                        next: '<img src="images/admin-images/right-arrow.png" alt="next" class="right-arrow">',
                        previous: '<img src="images/admin-images/left-arrow.png" alt="previous" class="left-arrow">'
                    }
                }
            });

            $('.search-btn').click(function() {
                var x = $('#search').val();
                table.search(x).draw();

            });
            
            $('select').change(function(){
                var x = $(this).val();
                table.columns(3).search(x).draw();
            });
            
            $(document).on('change', '#month', function() {
                shownotes($(this).val());
            });

            function shownotes(month) {
                let monthVal = month;
                table.column(3).search(monthVal).draw();
            }

            var currentMonth = $('#month').val();
            shownotes(currentMonth);


        });
    </script>
    <script>
        $(document).ready(function() {
            $('.btn-unpublish').click(function() {
                if (confirm('Are you sure you want to unpublish this note?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
    
</body>

</html>