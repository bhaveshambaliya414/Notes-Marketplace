
<?php

session_start();
ob_start();
include "../front/connection_db.php";
$page = 'notes';

if (!isset($_SESSION['loggedin']) && !((isset($_SESSION['is_admin'])) || (isset($_SESSION['is_superadmin'])))) {
    header('location:../login.php');
} else {
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $email = $_SESSION['email'];
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
    <title>Rejected Notes</title>



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


    if (isset($_GET['approve'])) {
        $noteid = $_GET['approve'];

        $approve = "UPDATE `sellernotes` SET `status` = '2', `isactive` = b'1', `actionedby` = '$adminid', `publisheddate` = current_timestamp() WHERE id = '$noteid'";
        $approvequery = mysqli_query($conn, $approve);
        if (!($approvequery)) {
            die("QUERY FAILED" . mysqli_error($conn));
        } else {
            header('location:rejectednotes.php');
        }
    }
    ?>



    <!--  Rejected Notes -->
    <section id="rejected-notes">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="basic-heading">
                        <h3>Rejected Notes</h3>
                    </div>
                </div>
                <form>
                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-md-6">
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
                            <select id="inputstate" class="form-control">
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
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-6">
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
                    <table class="table table-hover" id="rejected_table">
                        <thead>
                        <tr>
                            <th scope="col" class="table-header">SR No.</th>
                            <th scope="col" class="table-header title">Note Title</th>
                            <th scope="col" class="table-header">Category</th>
                            <th scope="col" class="table-header">Seller</th>
                            <th scope="col" class="table-header blank"></th>
                            <th scope="col" class="table-header">Date Added</th>
                            <th scope="col" class="table-header">Rejected By</th>
                            <th scope="col" class="table-header">Remark</th>
                            <th scope="col" class="table-header blank"></th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        <?php
                        $select = "SELECT * FROM sellernotes WHERE status IN(4) AND isactive = b'1'";
                            if (isset($_GET['id'])) {
                                $selectedid = $_GET['id'];
                                $select .= " AND sellerid = '$selectedid' ORDER BY createddate ASC";
                            } else {
                                $select .= " ORDER BY createddate ASC";
                            }
                        $pquery = mysqli_query($conn,$select);
                        $count = mysqli_num_rows($pquery);

                        for ($i = 1; $i <= $count; $i++) {
                            $rejected_row = mysqli_fetch_assoc($pquery);
                            $noteid = $rejected_row['id'];
                        ?> 
                         
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td class="color-blue"><a href="notesdetailsadmin.php?id=<?php echo $rejected_row['id']; ?>"><?php echo $rejected_row['title']; ?></a></td>
                            <td>
                                <?php
                                $cateid = $rejected_row['category'];
                                $getcate = "SELECT * FROM notecategories WHERE isactive = b'1' AND id = '$cateid'";
                                $catequery = mysqli_query($conn, $getcate);
                                $catedata = mysqli_fetch_assoc($catequery);

                                echo $catedata['name']; 
                                ?>
                            </td>
                            <td>
                                <?php
                                $sellerid = $rejected_row['sellerid'];
                                $getseller = "SELECT * FROM users WHERE isactive = b'1' AND id = '$sellerid'";
                                $sellerquery = mysqli_query($conn, $getseller);
                                $seller = mysqli_fetch_assoc($sellerquery);
                                echo $seller['firstname'] ." ". $seller['lastname'];
                                ?>
                            </td>
                            <td>
                                <a href="memberdetails.php?id=<?php echo $sellerid; ?>"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                            </td>
                            <td><?php echo $rejected_row['modifieddate']; ?></td>
                            <td><?php
                                $aid = $rejected_row['actionedby'];
                                $getpublisher = "SELECT * FROM users WHERE id = '$aid' AND isactive = b'1'";
                                $getpquery = mysqli_query($conn, $getpublisher);
                                $getpublisherdata = mysqli_fetch_assoc($getpquery);
                                echo $getpublisherdata['firstname'] . " " . $getpublisherdata['lastname'];
                                ?></td>
                            <td><?php echo $rejected_row['adminremarks']; ?></td>
                            <td>
                                <div class="btn-group dropleft">
                                    <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php
                                    echo '<img src="images/Dashboard/dots.png" alt="menu">';
                                    ?>
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <a class="approve-note" name="approve" href="rejectednotes.php?approve=<?php echo $rejected_row['id']; ?>">Approve</a><br>
                                        <a href="downloadnotes_admin.php?id=<?php echo $rejected_row['id']; ?>">Download Notes</a>
                                        <a href="notesdetailsadmin.php?id=<?php echo $rejected_row['id']; ?>">View More Details</a>
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
    <!--  Rejected Notes Ends -->
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
            var table = $('#rejected_table').DataTable({
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

        });
    </script>
    <script>
        $(document).ready(function() {
            $('.approve-note').click(function() {
                if (confirm('If you approve the notes - System will publish the notes over portal. Please press yes to continue.')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>

    
</body>

</html>