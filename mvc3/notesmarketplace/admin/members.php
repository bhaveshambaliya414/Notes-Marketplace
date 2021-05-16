<?php

session_start();
ob_start();
include "../front/connection_db.php";
$page = 'members';
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
    <title>Members</title>

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
    if (isset($_GET['id'])) {
        $editmemberid = $_GET['id'];

        $updatemember = "UPDATE users SET `isactive` = b'0', `modifieddate` = current_timestamp(), `modifiedby` = '$adminid' WHERE id = '$editmemberid'";
        $updatequery = mysqli_query($conn, $updatemember);
        if (!($updatequery)) {
            die("QUERY FAILED" . mysqli_error($conn));
        } else {
            header('location:members.php');
        }
    }
    ?>

    <!-- Members  -->
    <section id="members">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-md-6">
                        <div class="basic-heading">
                            <h3>Members</h3>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-6">
                        <div class="row">
                            <div class="search-bar col-lg-9 col-md-8 col-sm-9 col-12">
                                <div class="form-group">
                                    <input type="search" class="form-control" id="search" placeholder="Search">
                                </div>
                            </div>
                            <div class="search-btn col-lg-3 col-md-4 col-sm-3 col-12">
                                <a class="btn btn-search" href="#" title="Search" role="button">Search</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row table-general table-responsive">
                    <table class="table table-hover" id="member_table">
                        <thead>
                        <tr>
                            <th scope="col" class="table-header">SR No.</th>
                            <th scope="col" class="table-header">First Name</th>
                            <th scope="col" class="table-header">Last Name</th>
                            <th scope="col" class="table-header">Email</th>
                            <th scope="col" class="table-header text-center">Joining Date</th>
                            <th scope="col" class="table-header text-center">Under Review Notes</th>
                            <th scope="col" class="table-header text-center">Published Notes</th>
                            <th scope="col" class="table-header text-center">Downloaded Notes</th>
                            <th scope="col" class="table-header text-center">Total expenses</th>
                            <th scope="col" class="table-header text-center">Total Earnings</th>
                            <th scope="col" class="table-header blank"> </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $userdata = "SELECT * FROM users WHERE roleid = 1 AND isactive = b'1' ORDER BY createddate DESC";
                        $userdataquery = mysqli_query($conn, $userdata);
                        $count = mysqli_num_rows($userdataquery);
                        for ($i = 1; $i <= $count; $i++) {
                            $udata = mysqli_fetch_assoc($userdataquery);

                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $udata['firstname']; ?></td>
                            <td><?php echo $udata['lastname']; ?></td>
                            <td><?php echo $udata['email']; ?></td>
                            <td><?php $addeddate =  $udata['createddate'];
                                      $date = strtotime($addeddate);
                                      echo date('d-m-Y, H:i', $date); ?></td>
                            <td class="color-blue text-center">
                            <?php
                                $uid = $udata['id'];
                                $urnotes = "SELECT * FROM sellernotes WHERE sellerid = '$uid' AND status IN(3,5) AND isactive = b'1'";
                                $urnotesquery = mysqli_query($conn, $urnotes);
                                $urnotescount = mysqli_num_rows($urnotesquery);
                            ?>
                            <a href="notesunderreview.php?id=<?php echo $udata['id']; ?>"><?php echo $urnotescount;?></a>
                            </td>
                            <td class="color-blue text-center">
                            <?php
                                $pnotes = "SELECT * FROM sellernotes WHERE sellerid = '$uid' AND status = 2 AND isactive = b'1'";
                                $pnotesquery = mysqli_query($conn, $pnotes);
                                $pnotescount = mysqli_num_rows($pnotesquery);
                            ?>
                            <a href="publishednotes.php?id=<?php echo $udata['id']; ?>"><?php echo $pnotescount; ?></a>
                            </td>
                            <td class="color-blue text-center">
                            <?php
                                $mydownload = "SELECT * FROM downloads WHERE issellerhasalloweddownload = 1 AND 	attachmentpath IS NOT NULL AND seller != $uid AND downloader = $uid GROUP BY noteid,downloader";
                                $getdwddata = mysqli_query($conn, $mydownload);
                                $dwdcount = mysqli_num_rows($getdwddata);
                            ?>
                            <a href="downloadsnotes.php?mid=<?php echo $udata['id']; ?>">
                                    <?php echo $dwdcount;
                                    $totalexpenses = 0;
                                    if ($dwdcount != 0) {
                                        while ($dwdnotedata1 = mysqli_fetch_assoc($getdwddata)) {
                                            $eprice = $dwdnotedata1['purchasedprice'];
                                            if ($eprice == NULL) {
                                                $eprice = 0;
                                            }
                                            $totalexpenses = $totalexpenses + (int)$eprice;
                                        }
                                    }
                                ?></a>
                            </td>
                            
                            <td style="color: #6255a5;" class="text-center"><a href="downloadsnotes.php?mid=<?php echo $udata['id']; ?>"><?php echo '$' . $totalexpenses; ?></a></td>
                            <td class="text-center">
                            <?php

                                $soldnote = "SELECT * FROM downloads WHERE issellerhasAlloweddownload = 1 AND seller = $uid AND downloader != $uid GROUP BY noteid,downloader";
                                $soldnotequery = mysqli_query($conn, $soldnote);
                                $soldnotecount = mysqli_num_rows($soldnotequery);
                                $totalearn = 0;
                                if ($soldnotecount != 0) {
                                    while ($soldnotedata1 = mysqli_fetch_assoc($soldnotequery)) {
                                        $pprice = $soldnotedata1['purchasedprice'];
                                        if ($pprice == NULL) {
                                            $pprice = 0;
                                        }
                                        $totalearn = $totalearn + (int)$pprice;
                                    }
                                }
                                echo '$' . $totalearn;
                            ?></td>
                            <td>
                                <div class="btn-group dropleft">
                                    <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/admin-images/dots.png" alt="menu">
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <a href="memberdetails.php?id=<?php echo $udata['id']; ?>">View More Details</a>
                                        <a class="deactivate-member" href="members.php?id=<?php echo $udata['id']; ?>">Deactivate</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>

                        </tbody>
                        
                    </table>

                </div>

            </div>

        </div>

    </section>
    <!--  Members Ends -->
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
            var table = $('#member_table').DataTable({
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

        });
    </script>
    <script>
        $(document).ready(function() {
            $('.deactivate-member').click(function() {
                if (confirm('Are you sure you want to make this member inactive?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
    
</body>

</html>