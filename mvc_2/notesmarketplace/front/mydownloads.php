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
    <title>My Downloads Page</title>

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
                            <th>SR NO.</th>
                            <th>Note title</th>
                            <th>Category</th>
                            <th>Buyer</th>
                            <th>Sell Type</th>
                            <th>Price</th>
                            <th>Downloaded Date/Time</th>
                            <th class="text-center"></th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Science</td>
                            <td>Draft</td>
                            <td>testting123@gmail.com</td>
                            <td>paid</td>
                            <td>$80</td>
                            <td>26 Nov 2020,11:24:34</td>
                            <td>
                                <a href="#"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                                <div class="btn-group dropleft">
                                    <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="menu">
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <a href="#">Download Note</a>
                                        <a href="#" data-toggle="modal" data-target="#reviewmodal">Add Reviews/Feedback</a>
                                        <a href="#">Report as Inappropriate</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Accounts</td>
                            <td>Commerce</td>
                            <td>testting123@gmail.com</td>
                            <td>free</td>
                            <td>$0</td>
                            <td>26 Nov 2020,11:24:34</td>
                            <td>
                                <a href="#"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                                <div class="btn-group dropleft">
                                    <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="menu">
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <a href="#">Download Note</a>
                                        <a href="#" data-toggle="modal" data-target="#reviewmodal">Add Reviews/Feedback</a>
                                        <a href="#">Report as Inappropriate</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Social Studies</td>
                            <td>Social</td>
                            <td>testting123@gmail.com</td>
                            <td>paid</td>
                            <td>$50</td>
                            <td>26 Nov 2020,11:24:34</td>
                            <td>
                                <a href="#"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                                <div class="btn-group dropleft">
                                    <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="menu">
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <a href="#">Download Note</a>
                                        <a href="#" data-toggle="modal" data-target="#reviewmodal">Add Reviews/Feedback</a>
                                        <a href="#">Report as Inappropriate</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>AI</td>
                            <td>IT</td>
                            <td>testting123@gmail.com</td>
                            <td>paid</td>
                            <td>$30</td>
                            <td>26 Nov 2020,11:24:34</td>
                            <td>
                                <a href="#"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                                <div class="btn-group dropleft">
                                    <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="menu">
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <a href="#">Download Note</a>
                                        <a href="#" data-toggle="modal" data-target="#reviewmodal">Add Reviews/Feedback</a>
                                        <a href="#">Report as Inappropriate</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Physics</td>
                            <td>Science</td>
                            <td>testting123@gmail.com</td>
                            <td>free</td>
                            <td>$0</td>
                            <td>26 Nov 2020,11:24:34</td>
                            <td>
                                <a href="#"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                                <div class="btn-group dropleft">
                                    <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="menu">
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <a href="#">Download Note</a>
                                        <a href="#" data-toggle="modal" data-target="#reviewmodal">Add Reviews/Feedback</a>
                                        <a href="#">Report as Inappropriate</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Data Science</td>
                            <td>Science</td>
                            <td>testting123@gmail.com</td>
                            <td>Paid</td>
                            <td>$35</td>
                            <td>26 Nov 2020,11:24:34</td>
                            <td>
                                <a href="#"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                                <div class="btn-group dropleft">
                                    <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="menu">
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <a href="#">Download Note</a>
                                        <a href="#" data-toggle="modal" data-target="#reviewmodal">Add Reviews/Feedback</a>
                                        <a href="#">Report as Inappropriate</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Accounts</td>
                            <td>Commerce</td>
                            <td>testting123@gmail.com</td>
                            <td>Free</td>
                            <td>$0</td>
                            <td>26 Nov 2020,11:24:34</td>
                            <td>
                                <a href="#"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                                <div class="btn-group dropleft">
                                    <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="menu">
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <a href="#">Download Note</a>
                                        <a href="#" data-toggle="modal" data-target="#reviewmodal">Add Reviews/Feedback</a>
                                        <a href="#">Report as Inappropriate</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Social Studies</td>
                            <td>Social</td>
                            <td>testting123@gmail.com</td>
                            <td>Paid</td>
                            <td>$25</td>
                            <td>26 Nov 2020,11:24:34</td>
                            <td>
                                <a href="#"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                                <div class="btn-group dropleft">
                                    <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="menu">
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <a href="#">Download Note</a>
                                        <a href="#" data-toggle="modal" data-target="#reviewmodal">Add Reviews/Feedback</a>
                                        <a href="#">Report as Inappropriate</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>AI</td>
                            <td>IT</td>
                            <td>testting123@gmail.com</td>
                            <td>Paid</td>
                            <td>$57</td>
                            <td>26 Nov 2020,11:24:34</td>
                            <td>
                                <a href="#"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                                <div class="btn-group dropleft">
                                    <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="menu">
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <a href="#">Download Note</a>
                                        <a href="#" data-toggle="modal" data-target="#reviewmodal">Add Reviews/Feedback</a>
                                        <a href="#">Report as Inappropriate</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Physics</td>
                            <td>Science</td>
                            <td>testting123@gmail.com</td>
                            <td>Free</td>
                            <td>$0</td>
                            <td>26 Nov 2020,11:24:34</td>
                            <td>
                                <a href="#"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                                <div class="btn-group dropleft">
                                    <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/Dashboard/dots.png" alt="menu">
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Dropdown menu links -->
                                        <a href="#">Download Note</a>
                                        <a href="#" data-toggle="modal" data-target="#reviewmodal">Add Reviews/Feedback</a>
                                        <a href="#">Report as Inappropriate</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tbody>
                        <?php
                        $select = "SELECT * FROM downloads WHERE issellerhasalloweddownload = 1";
                        $pquery = mysqli_query($conn,$select);

                        
                       
                        while($published_row = mysqli_fetch_assoc($pquery))  {  
                        ?>    
                         
                        <tr>
                            <td>11</td>
                            <td><?php echo $published_row['notetitle']; ?></td>
                            <td><?php echo $published_row['notecategory']; ?></td>
                            <td>testting123@gmail.com</td>
                            <td><?php if ($published_row['ispaid'] == 1){
                                          echo 'Free';
                                      }else{
                                          echo 'Paid';
                                      }
                                 ?></td>
                            <td><?php echo $published_row['purchasedprice']; ?></td>
                            <td><?php echo $published_row['attachmentdownloadeddate']; ?></td>
                            <td><?php
                                if($published_row["issellerhasalloweddownload"] == 1){
                                echo '<a href="#"><img src="images/Dashboard/eye.png" alt="view" class="eye"></a>
                                    <div class="btn-group dropleft">
                                        <button type="link" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="images/Dashboard/dots.png" alt="menu">
                                        </button>
                                        <div class="dropdown-menu">
                                            <!-- Dropdown menu links -->
                                            <a href="#">Download Note</a>
                                            <a href="#" data-toggle="modal" data-target="#reviewmodal">Add Reviews/Feedback</a>
                                            <a href="#">Report as Inappropriate</a>
                                        </div>
                                    </div>';
                                }?>    
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

    <!-- Modal -->
    <div class="modal fade" id="reviewmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewmodal">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Add Review</h3>
                            </div>
                            <!-- Rating -->
                            <div class="rate">
                                <input type="radio" id="star5" name="rate1" value="5" />
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" name="rate1" value="4" />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" name="rate1" value="3" />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" name="rate1" value="2" />
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" name="rate1" value="1" />
                                <label for="star1" title="text">1 star</label>
                            </div>
                        </div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="modal-review-feedback">
                        <label for="review">Comments *</label>
                        <textarea class="form-control" id="review" placeholder="comments..."></textarea>
                    </div>

                    <div class="submit-btn">
                        <a class="btn btn-submit" href="#" title="submit" role="button">Submit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



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