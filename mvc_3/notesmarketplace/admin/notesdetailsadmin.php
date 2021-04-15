<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">

    <!-- Title -->
    <title>Notes Details</title>

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
                                    <a class="dropdown-item" href="#">Update Profile</a>
                                    <a class="dropdown-item" href="changepassword.php">Change Password</a>
                                    <a class="dropdown-item logout" href="login_admin.php">Logout</a>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="login_admin.php">Logout</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </nav>

    </header>
    <!-- Navigation  Ends -->

    <!-- Notes details -->
    <section id="note-details">
        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="basic-heading-sm">
                        <h3>Note Details</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="book-image col-lg-5 col-md-5 col-sm-5 col-12">
                                <img src="images/admin-images/computer-science.png" class="img-fluid">
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-12 book-info">
                                <h3>Computer Science</h3>
                                <h6>Sciences</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis omnis non fugiat et dolorem molestias consequatur numquam aut, optio tempora, iste labore porro.</p>
                                <div class="download-btn">
                                    <a class="btn btn-download" href="#" title="download" role="button" data-toggle="modal" data-target="#datamodel">Download/$15</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="note-detail-right">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                    <p>Institution:</p>
                                </div>
                                <div class="col-md-6  col-sm-6 col-6 right-side text-right">
                                    <p>University of California</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                    <p>Country:</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 right-side text-right">
                                    <p>United States</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                    <p>Course Name:</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 right-side text-right">
                                    <p>Computer Engineering</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                    <p>Course Code:</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 right-side text-right">
                                    <p>248705</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                    <p>Professor:</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 right-side text-right">
                                    <p>Mr. Richard Brown</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                    <p>Number of Pages:</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 right-side text-right">
                                    <p>277</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                    <p>Approved Date:</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 right-side text-right">
                                    <p>November 25 2020</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 left-side text-left">
                                    <p>Rating:</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 review right-side text-right">
                                    <div class="stars">
                                        <li>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <span>100 reviews</span>
                                        </li>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12 instruction left-side text-left">
                                    <p>5 Users marked this note as inappropriat</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Notes Details Ends-->
    <hr>
    <!-- Notes content and Reviews-->
    <section id="note-content">
        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12 col-12 note-preview">
                        <div class="basic-heading-sm">
                            <h3>Note Preview</h3>
                        </div>

                        <div class="note-detail-preview">
                            <iframe src="http://www.africau.edu/images/default/sample.pdf" type="application/pdf"></iframe>
                        </div>
                    </div>


                    <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                        <div class="row">
                            <div class="basic-heading-sm col-md-12 col-sm-12 col-12">
                                <h3>Customer Reviews</h3>
                            </div>
                            <div class="customer-reviews">
                                <!-- review 1 -->
                                <div class="row">
                                    <div class="customer-image col-lg-2 col-md-3 col-sm-2 col-3">
                                        <img src="images/admin-images/reviewer-1.png" class="img-fluid img-circle">
                                    </div>
                                    <div class="col-lg-10 col-md-9 col-sm-10 col-9">
                                        <div class="review">
                                            <h5>Richard Brown</h5>
                                            <a href="#"><img src="images/admin-images/delete.png"></a>
                                            <div class="stars text-left">
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </li>
                                            </div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fugiat, veroPariatur totam provident veritatis, eveniet dolorem.</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!-- review 2 -->
                                <div class="row">
                                    <div class="customer-image col-lg-2 col-md-3 col-sm-2 col-3">
                                        <img src="images/admin-images/reviewer-2.png" class="img-fluid img-circle">
                                    </div>
                                    <div class="col-lg-10 col-md-9 col-sm-10 col-9">
                                        <div class="review">
                                            <h5>Alice Ortiaz</h5>
                                            <a href="#"><img src="images/admin-images/delete.png"></a>
                                            <div class="stars text-left">
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </li>
                                            </div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fugiat, expedita! Pariatur provident veritatis, eveniet dolorem.</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!-- review 3 -->
                                <div class="row">
                                    <div class="customer-image col-lg-2 col-md-3 col-sm-2 col-3">
                                        <img src="images/admin-images/reviewer-3.png" class="img-fluid img-circle">
                                    </div>
                                    <div class="col-lg-10 col-md-9 col-sm-10 col-9">
                                        <div class="review">
                                            <h5>Sara Passmore</h5>
                                            <a href="#"><img src="images/admin-images/delete.png"></a>
                                            <div class="stars text-left">
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </li>
                                            </div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde fugiat, expedita! totam provident veritatis, eveniet dolorem.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Notes Details Ends-->
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

    <!-- Modal -->
    <div class="modal" id="datamodel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="datamodel">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img src="images/note-details/SUCCESS.png" alt="success">
                            </div>
                            <div class="col-md-12 text-center">
                                <h3>Thank you for purchasing!</h3>
                            </div>
                        </div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Dear Smith,</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id tempora ab tenetur, a libero voluptatum vero officiis similique iste amet, quam, in autem culpa qui quisquam, maiores omnis minima recusandae?</p>

                    <p>In case, you have urgency,<br>Please contact us on +919589634556</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque aliquam dolor excepturi porro, </p>

                    <p>Have a good day</p>
                </div>
            </div>
        </div>
    </div>




    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>