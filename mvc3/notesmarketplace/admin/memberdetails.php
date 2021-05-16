
<?php
session_start();
ob_start();
include "../front/connection_db.php";

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
    <title>Member Details</title>

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

        $userid = $_GET['id'];

        $get_user_detail = "SELECT * FROM users WHERE id='$userid' AND isactive = b'1'";
        $details_query = mysqli_query($conn, $get_user_detail);

        $user_bdata = mysqli_fetch_assoc($details_query);

        $fname = $user_bdata['firstname'];
        $lname = $user_bdata['lastname'];
        $email = $user_bdata['email'];

        $get_details = "SELECT * FROM userprofile WHERE userid='$userid'";
        $details = mysqli_query($conn, $get_details);
        if (!($details)) {
            die("QUERY FAILED" . mysqli_error($conn));
        }
        $data = mysqli_fetch_assoc($details);
        $dpname = $data['profilepicture'];
        $dob = $data['dob'];
        $phonenumber = $data['phonenumber'];
        $university = $data['university'];
        $address1 = $data['addressline1'];
        $address2 = $data['addressline2'];
        $city = $data['city'];
        $state = $data['state'];
        $country = $data['country'];
        $zipcode = $data['zipcode'];
    }

    ?>

    <!--  Member-Details -->
    <section id="member-details">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="basic-heading">
                        <h3>Member Details</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="member-image col-md-3 col-sm-12 col-12">
                                <?php
                                    if ($dpname != "") {
                                        
                                        echo "<img src='../Members/$userid/$dpname' alt='memberpic' class='img-fluid'>";
                                    } else {
                                        echo "<img src='images/admin-images/member.png' class='img-fluid' alt='memberpic'>";
                                    }

                                    ?>
                                
                            </div>
                            <div class="col-md-9 col-sm-12 col-12 member-info">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                        <p>First Name:</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6 right-side text-left">
                                        <p><?php echo $fname; ?></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                        <p>Last Name:</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6 right-side text-left">
                                        <p><?php echo $lname; ?></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                        <p>Email:</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6 right-side text-left">
                                        <p><?php echo $email; ?></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                        <p>DOB:</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6 right-side text-left">
                                        <p><?php
                                            $date = strtotime($dob);
                                            echo date('d-m-Y', $date); ?></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                        <p>Phone Number:</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6 right-side text-left">
                                        <p><?php echo $phonenumber; ?></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                        <p>College/University:</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6 right-side text-left">
                                        <p><?php echo $university; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                        <div class="row right-info">
                            <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                <p>Address1:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6 right-side text-left">
                                <p><?php echo $address1; ?></p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                <p>Address2:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6 right-side text-left">
                                <p><?php echo $address2; ?></p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                <p>city:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6 right-side text-left">
                                <p><?php echo $city; ?></p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                <p>State:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6 right-side text-left">
                                <p><?php echo $state; ?></p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                <p>Country:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6 right-side text-left">
                                <p><?php echo $country; ?></p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                <p>zipcode:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6 right-side text-left">
                                <p><?php echo $zipcode; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>

        </div>

    </section>
    <!--  My Profile Ends -->

    <!--  Notes -->
    <section id="notes">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="basic-heading-sm">
                        <h3>Notes</h3>
                    </div>
                </div>
                <div class="row table-general table-responsive">
                    <table class="table table-hover" id="memberdetail_table">
                        <thead>
                        <tr>
                            <th scope="col" class="table-header">SR No.</th>
                            <th scope="col" class="table-header title">Note Title</th>
                            <th scope="col" class="table-header">Category</th>
                            <th scope="col" class="table-header">Status</th>
                            <th scope="col" class="table-header text-center">Downloaded Notes</th>
                            <th scope="col" class="table-header">Total Earnings</th>
                            <th scope="col" class="table-header date">Date Added</th>
                            <th scope="col" class="table-header date">Published Date</th>
                            <th scope="col" class="table-header"></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getnotes = "SELECT * FROM sellernotes WHERE sellerid = $userid AND status IN(2,3,4,5) ORDER BY createddate ASC";
                            $getnotesquery = mysqli_query($conn, $getnotes);
                            $getnotescount = mysqli_num_rows($getnotesquery);
                            for ($i = 1; $i <= $getnotescount; $i++) {
                                $notesdata = mysqli_fetch_assoc($getnotesquery);
                                $noteid = $notesdata['id'];

                            ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td class="color-blue"><a href="notesdetailsadmin.php?id=<?php echo $notesdata['id']; ?>"><?php echo $notesdata['title'] ?></a></td>
                            <td><?php
                                $catid = $notesdata['category'];
                                $getcategoryquery = "SELECT * FROM notecategories WHERE id = '$catid' AND isActive = b'1'";
                                $categoryquery = mysqli_query($conn, $getcategoryquery);
                                $category = mysqli_fetch_assoc($categoryquery);
                                echo $category['name']; ?></td>
                            <td><?php
                                $statusid = $notesdata['status'];
                                $getstatusquery = "SELECT * FROM referencedata WHERE id = '$statusid' AND isactive = b'1'";
                                $statusquery = mysqli_query($conn, $getstatusquery);
                                $status = mysqli_fetch_assoc($statusquery);
                                echo $status['value']; ?></td>
                            <td class="color-blue text-center">
                            <?php
                            $soldnote = "SELECT * FROM downloads WHERE issellerhasalloweddownload = 1 AND noteid = $noteid AND seller = $userid AND downloader != $userid GROUP BY noteid,downloader";
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
                            ?>
                            <a href="downloadsnotes.php?id=<?php echo $notesdata['id']; ?>"><?php echo $soldnotecount; ?></a></td>
                            <td><?php
                                if ($notesdata['status'] == 2) {
                                    echo '$' . $totalearn;
                                } else {
                                    echo '$0';
                                }
                                ?></td>
                            <td><?php $addeddate =  $notesdata['createddate'];
                                        $date = strtotime($addeddate);
                                        echo date('d-m-Y, H:i', $date); ?></td>
                            <td><?php
                                if ($notesdata['status'] == 2) {
                                    $publisheddate =  $notesdata['publisheddate'];
                                    $date = strtotime($publisheddate);
                                    echo date('d-m-Y, H:i', $date);
                                } else {
                                    echo 'NA';
                                }
                                ?></td>
                            <td>
                                <div class="btn-group dropleft">
                                    <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/admin-images/dots.png" alt="menu">
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <a href="downloadnotes_admin.php?id=<?php echo $notesdata['id']; ?>"><button class="dropdown-item" type="button">Download Note</button></a>
                                        
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
    <!--  Notes Ends -->
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
            var table = $('#memberdetail_table').DataTable({
                'sDom': '"top"i',
                "iDisplayLength": 5,
                language: {
                    paginate: {
                        next: '<img src="images/admin-images/right-arrow.png" alt="next" class="right-arrow">',
                        previous: '<img src="images/admin-images/left-arrow.png" alt="previous" class="left-arrow">'
                    }
                }
            });

        });
    </script>

</body>

</html>