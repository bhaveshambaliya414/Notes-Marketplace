<?php

session_start();
ob_start();
include "../front/connection_db.php";
$page = 'notes';

if (!isset($_SESSION['loggedin']) && !((isset($_SESSION['is_admin'])) || (isset($_SESSION['is_superadmin'])))) {
    header('location:../login.php');
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
    <title>Downloads Notes</title>

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





    <!--  Downloaded Notes -->
    <section id="downloaded-notes">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="basic-heading">
                        <h3>Downloaded Notes</h3>
                    </div>
                </div>
                <form>
                <div class="row">
                    <div class="col-xl-7 col-lg-6">
                        <div class="row">
                            <div class="form-group sellers">
                                <label for="note">Note</label>
                                <?php
                                    $dwldnote = "SELECT DISTINCT(noteid) AS 'nid' FROM downloads WHERE issellerhasalloweddownload = 1 AND attachmentpath IS NOT NULL AND seller != downloader";
                                    if (isset($_GET['id'])) {
                                        $selectedid = $_GET['id'];
                                        $dwldnote .= " AND noteid = '$selectedid'";
                                    
                                    }
                                    $getdwdname = mysqli_query($conn, $dwldnote);
                                    $dwdncount = mysqli_num_rows($getdwdname);

                                    ?>
                                <select id="note" name="note" class="form-control">
                                    <option selected value="">Select note</option>
                                    <?php
                                        for ($j = 1; $j <= $dwdncount; $j++) {
                                            $notenamedata = mysqli_fetch_assoc($getdwdname);

                                            $nid = $notenamedata['nid'];

                                            $notedetail = "SELECT * FROM sellernotes WHERE id = $nid AND isactive = b'1'";
                                            $notedetailquery = mysqli_query($conn, $notedetail);
                                            $ndetail = mysqli_fetch_assoc($notedetailquery);
                                        ?>
                                            <option value="<?php echo $ndetail['title'] ?>"><?php echo $ndetail['title'] ?></option>
                                        <?php
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="form-group sellers">
                                <label for="seller">Seller</label>
                                <?php
                                    $getseller  = "SELECT DISTINCT(sellerid) AS 'sid' FROM sellernotes";
                                    if (isset($_GET['id'])) {
                                        $selectedid = $_GET['id'];
                                        $getseller .= " WHERE sellerid = '$selectedid'";
                                    }
                                    $getsellerquery = mysqli_query($conn, $getseller);
                                    $sellercount = mysqli_num_rows($getsellerquery);
                                ?>
                                <select id="seller" name="seller" class="form-control">
                                    <option selected value="">Select Seller</option>
                                    <?php
                                        for ($j = 1; $j <= $sellercount; $j++) {
                                            $sellerid1 = mysqli_fetch_assoc($getsellerquery);

                                            $sid = $sellerid1['sid'];

                                            $sellerdetail = "SELECT * FROM users WHERE id = $sid AND isactive = b'1'";
                                            $sellerdetailquery = mysqli_query($conn, $sellerdetail);
                                            $sdetail = mysqli_fetch_assoc($sellerdetailquery);
                                        ?>
                                            <option value="<?php echo $sdetail['firstname'] . " " . $sdetail['lastname'] ?>"><?php echo $sdetail['firstname'] . " " . $sdetail['lastname'] ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="form-group sellers">
                                <label for="buyer">Buyer</label>
                                <?php
                                    $getbuyer  = "SELECT DISTINCT(downloader) AS 'buyerid' FROM downloads";
                                    if (isset($_GET['id'])) {
                                        $selectedid = $_GET['id'];
                                        $getbuyer .= " WHERE downloader = '$selectedid'";
                                    }
                                    $getbuyerquery = mysqli_query($conn, $getbuyer);
                                    $buyercount = mysqli_num_rows($getbuyerquery);
                                ?>
                                <select id="buyer" name="buyer" class="form-control">
                                    <option selected value="">Select buyer</option>
                                    <?php
                                        for ($j = 1; $j <= $buyercount; $j++) {
                                            $buyerid1 = mysqli_fetch_assoc($getbuyerquery);

                                            $bid = $buyerid1['buyerid'];

                                            $buyerdetail = "SELECT * FROM users WHERE id = $bid AND isactive = b'1'";
                                            $buyerdetailquery = mysqli_query($conn, $buyerdetail);
                                            $bdetail = mysqli_fetch_assoc($buyerdetailquery);
                                        ?>
                                            <option value="<?php echo $bdetail['firstname'] . " " . $bdetail['lastname'] ?>"><?php echo $bdetail['firstname'] . " " . $bdetail['lastname'] ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="row search-section">
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
                </form>
                <div class="row table-general table-responsive">
                    <table class="table table-hover" id="downloads_table">
                        <thead>
                        <tr>
                            <th scope="col" class="table-header">SR No.</th>
                            <th scope="col" class="table-header title">Note Title</th>
                            <th scope="col" class="table-header">Category</th>
                            <th scope="col" class="table-header">Buyer</th>
                            <th scope="col" class="table-header blank"></th>
                            <th scope="col" class="table-header">Seller</th>
                            <th scope="col" class="table-header blank"></th>
                            <th scope="col" class="table-header">Sell Type</th>
                            <th scope="col" class="table-header">Price</th>
                            <th scope="col" class="table-header date">Downloaded Date/Time</th>
                            <th scope="col" class="table-header blank"></th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        <?php
                        $select = "SELECT * FROM downloads WHERE issellerhasalloweddownload=1 AND attachmentpath IS NOT NULL AND seller != downloader";
                        $pquery = mysqli_query($conn,$select);
                        $count = mysqli_num_rows($pquery);
                        for ($i = 1; $i <= $count; $i++) {
                            $downloads_row = mysqli_fetch_assoc($pquery); 
                            $noteid = $downloads_row['noteid'];
                            $selectquery = "SELECT * FROM sellernotes WHERE id = '$noteid'";
                            $notedetail = mysqli_query($conn, $selectquery);
                            $notedata = mysqli_fetch_assoc($notedetail);
                        ?>    
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><a class="mydownload" name="mydownload" href="notesdetailsadmin.php?id=<?php echo $noteid; ?>" role="button"><?php echo $notedata['title']; ?></a></td>
                            <td><?php
                                    $cateid = $notedata['category'];
                                    $categoryquery = "SELECT * FROM notecategories WHERE id = '$cateid' AND isactive = b'1'";
                                    $categorydata = mysqli_query($conn, $categoryquery);
                                    $category = mysqli_fetch_assoc($categorydata);
                                    echo $category['name']; ?>
                            </td>
                            <td><?php
                                $bid = $downloads_row['downloader'];
                                $buyerdata = "SELECT * FROM users WHERE id = $bid AND isactive = b'1'";
                                $buyerquery = mysqli_query($conn, $buyerdata);
                                $bdata = mysqli_fetch_assoc($buyerquery);
                                echo $bdata['firstname'] . " " . $bdata['lastname']; 
                                ?></td>
                            <td>
                                <a href="memberdetails.php?id=<?php echo $bid; ?>"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                            </td>
                            <td>
                                <?php
                                $sellerid = $downloads_row['seller'];
                                $getseller = "SELECT * FROM users WHERE isactive = b'1' AND id = '$sellerid'";
                                $sellerquery = mysqli_query($conn, $getseller);
                                $seller = mysqli_fetch_assoc($sellerquery);

                                echo $seller['firstname'];
                                echo " ";
                                echo $seller['lastname'];
                                ?>
                            </td>
                            <td>
                                
                                <a href="memberdetails.php?id=<?php echo $sellerid; ?>"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                                
                            </td>
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
                                    echo date('d M Y, H:i:s', $date); ?></td>
                            <td>   
                                <div class="btn-group dropleft">
                                    <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php
                                    echo '<img src="images/Dashboard/dots.png" alt="menu">';
                                    ?>
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <a href="downloadnotes_admin.php?id=<?php echo $noteid;?>">Download Notes</a>
                                        
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
    <!--  Downloaded Notes Ends -->
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
            var table = $('#downloads_table').DataTable({
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
            
            $('select').change(function() {
                var x = $('#seller').val();
                table.columns(4).search(x).draw();
            });

            $('select').change(function() {
                var y = $('#buyer').val();
                table.columns(3).search(y).draw();
            });

            $('select').change(function() {
                var z = $('#note').val();
                table.columns(1).search(z).draw();
            });

        });
    </script>
    
</body>

</html>