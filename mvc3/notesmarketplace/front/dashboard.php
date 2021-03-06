<?php
session_start();
ob_start();

include "connection_db.php"; 
$userid = $_SESSION['userid'];
if (!isset($_SESSION['loggedin'])) {
    header('location:../login.php');
}

?>
<?php
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $delete_row = "DELETE FROM sellernotes WHERE id='delete'";
    $delete_row_query = mysqli_query($conn, $delete_row);
    if (!($delete_row_query)) {
        die("QUERY FAILED" . mysqli_error($conn));
    }
    header("location:dashboard.php");
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
    <title>Dashboard</title>



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

    <!-- Dashboard  -->
    <section id="dashboard">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="col-md-10 col-sm-8 col-6 basic-heading">
                        <h3>Dashboard</h3>
                    </div>
                    <div id="addnote-btn" class="col-md-2 col-sm-4 col-6">
                        <a class="btn btn-addnote" href="addnotes.php" title="add-note" role="button">ADD NOTE</a>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-2 col-sm-4 col-12 e-box">
                        <div class="dashboard-e-box text-center" id="my-earning">
                            <img src="images/Dashboard/my-earning.png">
                            <h5>My earning</h5>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-8 col-12 box-lg">
                        <div class="dashboard-box dashboard-box-lg">
                            <div class="row">
                                <div class="col-md-6 notes-earning-info text-center">
                                    <h3>
                                    <?php
                                        $sselect = "SELECT * FROM downloads WHERE issellerhasalloweddownload = 1 AND seller = $userid AND downloader != $userid GROUP BY noteid,downloader";
                                        $sdata = mysqli_query($conn,$sselect);
                                        $scount = mysqli_num_rows($sdata);
                                        $totalearning = 0;
                                        if ($scount != 0) {
                                            while ($solddata = mysqli_fetch_assoc($sdata)) {
                                                $pprice = $solddata['purchasedprice'];
                                                if ($pprice == NULL) {
                                                    $pprice = 0;
                                                }
                                                $totalearning = $totalearning + (int)$pprice;
                                            }
                                        }
                                    ?>
                                    <?php echo $scount; ?> </h3>
                                    <p>Number of Notes Sold</p>
                                </div>
                                <div class="col-md-6 notes-earning-info text-center">
                                    <h3><?php echo "$" . $totalearning; ?></h3>
                                    <p>Money Earned</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-4">
                        <div class="dashboard-box notes-earning-info text-center">
                            
                            <?php
                                $dselect = "SELECT * FROM downloads WHERE issellerhasalloweddownload = 1 AND attachmentpath IS NOT NULL AND seller != $userid AND downloader = $userid GROUP BY noteid,downloader";
                                $downdata = mysqli_query($conn,$dselect);
                                $dcount = mysqli_num_rows($downdata);
                            ?>
                            <h3><?php echo $dcount; ?></h3>
                            
                            <p>My Downloads</p>
                        </div>

                    </div>

                    <div class="col-md-2 col-sm-4">
                        <div class="dashboard-box notes-earning-info text-center">
                            <?php
                                $rejected = "SELECT * FROM sellernotes WHERE status=4 AND sellerid = '$userid'";
                                $rejecteddata = mysqli_query($conn,$rejected);
                                $rcount = mysqli_num_rows($rejecteddata);
                            ?>
                            <h3><?php echo $rcount; ?></h3>
                            <p>My Rejected Notes</p>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-4">
                        <div class="dashboard-box notes-earning-info text-center">
                            <?php
                                $select = "SELECT * FROM downloads WHERE issellerhasalloweddownload = 0 AND ispaid = 1 AND downloader != $userid AND seller = $userid GROUP BY noteid,downloader";
                                $requestdata = mysqli_query($conn,$select);
                                $bcount = mysqli_num_rows($requestdata);
                            ?>
                            <h3><?php echo $bcount; ?></h3>
                            <p>Buyer Request</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Dashboard Ends -->

    <!-- In Progress Notes -->
    <section id="progress-notes">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <div class="basic-heading-sm">
                            <h3>In Progress Notes</h3>
                        </div>
                    </div>
                    <div class=" col-lg-5 col-md-6">
                        <div class="row">
                            <div class="search-bar col-md-9 col-sm-9">
                                <div class="form-group">
                                    <input type="search" class="form-control" id="search" placeholder="Search">
                                </div>
                            </div>
                            <div class="search-btn col-md-3 col-sm-3">
                                <a class="btn btn-search" href="#" title="Search" role="button">Search</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row table-general table-responsive">
                    <table class="table table-hover" id="progress_table">
                        <thead>
                        <tr>
                            <th scope="col" class="table-header">Added Date</th>
                            <th scope="col" class="table-header title">Title</th>
                            <th scope="col" class="table-header">Category</th>
                            <th scope="col" class="table-header">Status</th>
                            <th scope="col" class="table-header">Actions</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        <?php
                        $select = "SELECT * FROM sellernotes WHERE status IN (1,3,5)"; 
                        $pquery = mysqli_query($conn,$select);
                        
                        while ($progress_row = mysqli_fetch_array($pquery)) {
                        ?>
                            <tr>
                                <td><?php $adddate = $progress_row["createddate"];
                                    $date = strtotime($adddate);
                                    echo date('j-m-Y', $date); ?></td>
                                <td><?php echo $progress_row["title"]; ?></td>
                                <td><?php
                                        $cateid = $progress_row['category'];
                                        $categoryquery = "SELECT * FROM notecategories WHERE id = '$cateid' AND isactive = b'1'";
                                        $categorydata = mysqli_query($conn, $categoryquery);
                                        $category = mysqli_fetch_assoc($categorydata);
                                        echo $category['name']; ?></td>
                                <td><?php 
                                        $statusid = $progress_row['status'];
                                        $statusquery = "SELECT * FROM referencedata WHERE id = '$statusid' AND isactive = b'1'";
                                        $statusdata = mysqli_query($conn, $statusquery);
                                        $status = mysqli_fetch_assoc($statusdata);
                                        echo $status['datavalue']; 
                                    ?></td>
                                <?php
                                $id = $progress_row["id"];
                                if ($progress_row["status"] == 1) {
                                    echo "<td><a href='editnotes.php?edit=$id'><img src='images/Dashboard/edit.png' alt='edit'><a href='?delete=$id' id='dlt-link' onclick='return chk()'><img src='images/Dashboard/delete.png' name='delete' alt='delete'></td>";
                                } else {
                                    echo "<td><a href='notedetails.php?id=$id'><img src='images/Dashboard/eye.png' alt='view'></td>";
                                } ?>
                            </tr>
                        <?php
                        };
                        ?>    
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </section>
    <!-- In Progress Notes Ends -->

    <!--  Published Note -->
    <section id="published-notes">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <div class="basic-heading-sm">
                            <h3>Published Notes</h3>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="row">
                            <div class="search-bar col-md-9 col-sm-9">
                                <div class="form-group">
                                    <input type="search" class="form-control" id="search" placeholder="Search">
                                </div>
                            </div>
                            <div class="search-btn col-md-3 col-sm-3">
                                <a class="btn btn-search" href="#" title="Search" role="button">Search</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row table-general table-responsive">
                    <table class="table table-hover" id="published_table">
                        <thead>
                        <tr>
                            <th scope="col" class="table-header">Added Date</th>
                            <th scope="col" class="table-header title">Title</th>
                            <th scope="col" class="table-header">Category</th>
                            <th scope="col" class="table-header">Sell Type</th>
                            <th scope="col" class="table-header">Price</th>
                            <th scope="col" class="table-header">Actions</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        <?php
                        $published_query = "SELECT * FROM sellernotes WHERE status=2";
                        
                        $published_notes = mysqli_query($conn, $published_query);
                        while ($published_row = mysqli_fetch_array($published_notes)) {
                        ?>
                            <tr>
                                <td><?php $adddate = $published_row["createddate"];
                                    $date = strtotime($adddate);
                                    echo date('j-m-Y', $date); ?></td>
                                <td><?php echo $published_row["title"]; ?></td>
                                <td><?php echo $published_row["category"]; ?></td>
                                <td><?php if ($published_row["ispaid"] == 0) {
                                        echo 'Free';
                                    } else {
                                        echo "Paid";
                                    } ?></td>
                                <td><?php echo "$" . $published_row["sellingprice"]; ?></td>
                                <td><?php
                                    if ($published_row["status"] == 2) {
                                        $nid = $published_row["id"];
                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href='notedetails.php?id=$nid'><img src='images/dashboard/eye.png' alt='view'></a>";
                                    } ?></td>
                            </tr>
                        <?php
                        };
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
            var table = $('#progress_table').DataTable({
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
            var table = $('#published_table').DataTable({
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

    
</body>

</html>