
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
    <title>My Rejected Notes</title>



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
                                    <a class="dropdown-item logout" href="login.php">Logout</a>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="login.php">Logout</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </nav>

    </header>
    <!-- Navigation  Ends -->

    <!--  My Rejected Notes  -->
    <section id="rejected-notes">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <div class="basic-heading-sm">
                            <h3>My Rejected Notes</h3>
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
                    <table class="table table-hover" id="rejected_table">
                        <thead>
                        <tr>
                            <th scope="col" class="table-header">SR NO.</th>
                            <th scope="col" class="table-header title">Note title</th>
                            <th scope="col" class="table-header">Category</th>
                            <th scope="col" class="table-header">Remarks</th>
                            <th scope="col" class="table-header">Clone</th>
                            <th scope="col" class="table-header blank"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $select = "SELECT * FROM sellernotes WHERE status IN (4)";
                        $pquery = mysqli_query($conn,$select);
                        $count = mysqli_num_rows($pquery);
                        for ($i = 1; $i <= $count; $i++) { 
                            $rejected_row = mysqli_fetch_assoc($pquery);
                            $noteid = $rejected_row['id'];

                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><a class="mydownload" name="mydownload" href="notedetails.php?id=<?php echo $noteid; ?>" role="button"><?php echo $rejected_row['title']; ?></a></td>
                                <td><?php
                                    $cateid = $rejected_row['category'];
                                    $categoryquery = "SELECT * FROM notecategories WHERE id = '$cateid' AND isactive = b'1'";
                                    $categorydata = mysqli_query($conn, $categoryquery);
                                    $category = mysqli_fetch_assoc($categorydata);
                                    echo $category['name']; ?></td>
                                <td><?php echo $rejected_row['adminremarks']; ?></td>
                                <td>clone</td>
                                <td>
                                    <div class="btn-group dropleft">
                                        <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="images/Dashboard/dots.png" alt="menu">
                                        </button>
                                        <div class="dropdown-menu">
                                            <!-- Dropdown menu links -->
                                            <a href="notedetails.php?id=<?php echo $noteid; ?>">Download Note</a>
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
    <!--  My Rejected Notes Ends -->
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
            var table = $('#rejected_table').DataTable({
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