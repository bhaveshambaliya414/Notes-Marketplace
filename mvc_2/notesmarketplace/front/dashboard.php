<?php
session_start();
ob_start();

include "connection_db.php"; 
$userid = $_SESSION['userid'];

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
                                    <h3>100</h3>
                                    <p>Number of Notes Sold</p>
                                </div>
                                <div class="col-md-6 notes-earning-info text-center">
                                    <h3>$10,000</h3>
                                    <p>Money Earned</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-4">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3>100</h3>
                            <p>My Downloads</p>
                        </div>

                    </div>

                    <div class="col-md-2 col-sm-4">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3>12</h3>
                            <p>My Rejected Notes</p>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-4">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3>100</h3>
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
                    <table>
                        <tr>
                            <th>Added Date</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        <tr>
                            <td>09-10-2020</td>
                            <td>Data Science</td>
                            <td>Science</td>
                            <td>Draft</td>
                            <td>
                                <a href="addnotes.php"><img src="images/Dashboard/edit.png" alt="edit" class="action"></a>
                                <a href="#"><img src="images/Dashboard/delete.png" alt="delete" class="#"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>10-10-2020</td>
                            <td>Accounts</td>
                            <td>Commerce</td>
                            <td>In Review</td>
                            <td>
                                <a href="notedetails.php"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>11-10-2020</td>
                            <td>Social Studies</td>
                            <td>Social</td>
                            <td>Submitted</td>
                            <td>
                                <a href="notedetails.php"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>12-10-2020</td>
                            <td>AI</td>
                            <td>IT</td>
                            <td>Submitted</td>
                            <td>
                                <a href="notedetails.php"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>13-10-2020</td>
                            <td>Physics</td>
                            <td>Science</td>
                            <td>Draft</td>
                            <td>
                                <a href="addnotes.php"><img src="images/Dashboard/edit.png" alt="edit" class="action"></a>
                                <a href="#"><img src="images/Dashboard/delete.png" alt="delete" class="#"></a>
                            </td>
                        </tr>
                        <tbody>
                        <?php
                        $select = "SELECT * FROM sellernotes WHERE status IN (1,3)";
                        $pquery = mysqli_query($conn,$select);


                       
                        while($published_row = mysqli_fetch_assoc($pquery))  {  
                        ?>    
                         
                        <tr>
                            <td><?php echo $published_row['publisheddate']; ?></td>
                            <td><?php echo $published_row['title']; ?></td>
                            <td><?php echo $published_row['category']; ?></td>
                            
                            <td><?php echo $published_row['status']; ?></td>
                            <td><?php 
                                if($published_row["status"] == 1){
                                echo '<a href="addnotes.php"><img src="images/Dashboard/edit.png" alt="edit" class="action"></a>
                                <a href="#"><img src="images/Dashboard/delete.png" alt="delete" class="#"></a>';
                                }else{
                                    echo '<a href="notedetails.php"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>    
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="row justify-content-center">
                    <div class="content-box">
                        <ul class="pagination justify-content-center align-items-center">

                            <li class="page-item"><a class="page-link" href="#">&lt;</a></li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">1<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><a class="page-link" href="#">&gt;</a></li>

                        </ul>
                    </div>
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
                    <table>
                        <tr>
                            <th>Added Date</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Sell Type</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                        <tr>
                            <td>09-10-2020</td>
                            <td>Data Science</td>
                            <td>Science</td>
                            <td>Paid</td>
                            <td>$35</td>
                            <td>
                                <a href="notedetails.php"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>10-10-2020</td>
                            <td>Accounts</td>
                            <td>Commerce</td>
                            <td>Free</td>
                            <td>$0</td>
                            <td>
                                <a href="notedetails.php"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>11-10-2020</td>
                            <td>Social Studies</td>
                            <td>Social</td>
                            <td>Paid</td>
                            <td>$25</td>
                            <td>
                                <a href="notedetails.php"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>12-10-2020</td>
                            <td>AI</td>
                            <td>IT</td>
                            <td>Paid</td>
                            <td>$57</td>
                            <td>
                                <a href="notedetails.php"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>13-10-2020</td>
                            <td>Physics</td>
                            <td>Science</td>
                            <td>Free</td>
                            <td>$0</td>
                            <td>
                                <a href="notedetails.php"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                            </td>
                        </tr>
                        <tbody>
                        <?php
                        $select = "SELECT * FROM sellernotes WHERE status=2";
                        $pquery = mysqli_query($conn,$select);


                       
                        while($published_row = mysqli_fetch_assoc($pquery))  {  
                        ?>    
                         
                        <tr>
                            <td><?php echo $published_row['publisheddate']; ?></td>
                            <td><?php echo $published_row['title']; ?></td>
                            <td><?php echo $published_row['category']; ?></td>
                            <td><?php if ($published_row['ispaid'] == 1){
                                          echo 'Free';
                                      }else{
                                          echo 'Paid';
                                      }
                                 ?></td>
                            <td><?php echo $published_row['sellingprice']; ?></td>
                            <td><?php 
                                if($published_row["status"] == 2){
                                
                                echo '<a href="notedetails.php"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>    
                        </tbody>
                    </table>

                </div>

                <!-- Pagination -->
                <div class="row justify-content-center">
                    <div class="content-box">
                        <ul class="pagination justify-content-center align-items-center">

                            <li class="page-item"><a class="page-link" href="#">&lt;</a></li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">1<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><a class="page-link" href="#">&gt;</a></li>

                        </ul>
                    </div>
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

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>