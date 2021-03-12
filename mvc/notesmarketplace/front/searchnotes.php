<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">

    <!-- Title -->
    <title>Search Notes</title>

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
                            <li class="nav-item"><a class="nav-link" href="FAQ.php">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link" href="contactus.php">Contact Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </nav>

    </header>
    <!-- Navigation  Ends -->

    <!-- Search Notes Home -->
    <section id="search-notes">

        <div id="search-content">

            <div class="container">

                <div id="search-content-inner">

                    <div class="basic-heading-lg">
                        <h3>Search Notes</h3>
                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- Search Notes Home Ends -->

    <!-- Search and Filter -->
    <section id="search-filter">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="basic-heading-sm">
                        <h3>Search and Filter Notes</h3>
                    </div>
                </div>
                <div class="row serach-filter">
                    <div class="form-group col-md-12">
                        <input type="search" class="form-control" id="search" placeholder="Search notes here...">
                    </div>

                    <div class="form-group col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <select id="inputstate" class="form-control">
                            <option value="hide">Select type</option>
                            <option>A</option>
                            <option>B</option>
                        </select>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <select id="inputstate" class="form-control">
                            <option value="hide">Select category</option>
                            <option>A</option>
                            <option>C</option>
                        </select>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <select id="inputstate" class="form-control">
                            <option value="hide">Select university</option>
                            <option>A</option>
                            <option>C</option>
                        </select>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <select id="inputstate" class="form-control">
                            <option value="hide">Select course</option>
                            <option>A</option>
                            <option>B</option>
                        </select>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <select id="inputstate" class="form-control">
                            <option value="hide">Select country</option>
                            <option>A</option>
                            <option>B</option>
                        </select>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <select id="inputstate" class="form-control">
                            <option value="hide">Select rating</option>
                            <option>A</option>
                            <option>B</option>
                        </select>
                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- Search and filter Ends -->

    <!-- Notes -->
    <section id="notes">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="basic-heading-sm">
                        <h3>Total 18 notes</h3>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="note-image">
                            <img src="images/Search/1.jpg" class="img-fluid">
                        </div>
                        <div class="note-info">
                            <a href="note%20details.php"><h3>Computer Operating System - Final Exam Book With Paper Solution</h3></a>
                            <ul class="note-details">
                                <li><img src="images/Search/university.png"><span>University of California, US</span></li>
                                <li><img src="images/Search/pages.png"><span>204 Pages</span></li>
                                <li><img src="images/Search/date.png"><span>Thu, Nov 26 2020</span></li>
                                <li><img src="images/Search/flag.png"><span>5 Users marked this note as inappropriate</span></li>
                            </ul>
                            <div class="stars">
                                <li>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span>100 reviews</span>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="note-image">
                            <img src="images/Search/2.jpg" class="img-fluid">
                        </div>
                        <div class="note-info">
                            <a href="note%20details.php"><h3>Computer Science</h3></a>
                            <ul class="note-details">
                                <li><img src="images/Search/university.png"><span>University of California, US</span></li>
                                <li><img src="images/Search/pages.png"><span>204 Pages</span></li>
                                <li><img src="images/Search/date.png"><span>Thu, Nov 26 2020</span></li>
                                <li><img src="images/Search/flag.png"><span>5 Users marked this note as inappropriate</span></li>
                            </ul>
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
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="note-image">
                            <img src="images/Search/3.jpg" class="img-fluid">
                        </div>
                        <div class="note-info">
                            <a href="note%20details.php"><h3>Basic Computer Engineering Tech India Publication Series</h3></a>
                            <ul class="note-details">
                                <li><img src="images/Search/university.png"><span>University of California, US</span></li>
                                <li><img src="images/Search/pages.png"><span>204 Pages</span></li>
                                <li><img src="images/Search/date.png"><span>Thu, Nov 26 2020</span></li>
                                <li><img src="images/Search/flag.png"><span>5 Users marked this note as inappropriate</span></li>
                            </ul>
                            <div class="stars">
                                <li>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <span>100 reviews</span>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="note-image">
                            <img src="images/Search/4.jpg" class="img-fluid">
                        </div>
                        <div class="note-info">
                            <a href="note%20details.php"><h3>Computer Science Illuminted - Seventh Edition</h3></a>
                            <ul class="note-details">
                                <li><img src="images/Search/university.png"><span>University of California, US</span></li>
                                <li><img src="images/Search/pages.png"><span>204 Pages</span></li>
                                <li><img src="images/Search/date.png"><span>Thu, Nov 26 2020</span></li>
                                <li><img src="images/Search/flag.png"><span>5 Users marked this note as inappropriate</span></li>
                            </ul>
                            <div class="stars">
                                <li>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span>100 reviews</span>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="note-image">
                            <img src="images/Search/5.jpg" class="img-fluid">
                        </div>
                        <div class="note-info">
                            <a href="note%20details.php"><h3>The Principles of Computer Hardware - Oxford</h3></a>
                            <ul class="note-details">
                                <li><img src="images/Search/university.png"><span>University of California, US</span></li>
                                <li><img src="images/Search/pages.png"><span>204 Pages</span></li>
                                <li><img src="images/Search/date.png"><span>Thu, Nov 26 2020</span></li>
                                <li><img src="images/Search/flag.png"><span>5 Users marked this note as inappropriate</span></li>
                            </ul>
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
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="note-image">
                            <img src="images/Search/6.jpg" class="img-fluid">
                        </div>
                        <div class="note-info">
                            <a href="note%20details.php"><h3>The Computer Book</h3></a>
                            <ul class="note-details">
                                <li><img src="images/Search/university.png"><span>University of California, US</span></li>
                                <li><img src="images/Search/pages.png"><span>204 Pages</span></li>
                                <li><img src="images/Search/date.png"><span>Thu, Nov 26 2020</span></li>
                                <li><img src="images/Search/flag.png"><span>5 Users marked this note as inappropriate</span></li>
                            </ul>
                            <div class="stars">
                                <li>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <span>100 reviews</span>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="note-image">
                            <img src="images/Search/1.jpg" class="img-fluid">
                        </div>
                        <div class="note-info">
                            <a href="note%20details.php"><h3>Computer Operating System - Final Exam Book With Paper Solution</h3></a>
                            <ul class="note-details">
                                <li><img src="images/Search/university.png"><span>University of California, US</span></li>
                                <li><img src="images/Search/pages.png"><span>204 Pages</span></li>
                                <li><img src="images/Search/date.png"><span>Thu, Nov 26 2020</span></li>
                                <li><img src="images/Search/flag.png"><span>5 Users marked this note as inappropriate</span></li>
                            </ul>
                            <div class="stars">
                                <li>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span>100 reviews</span>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="note-image">
                            <img src="images/Search/2.jpg" class="img-fluid">
                        </div>
                        <div class="note-info">
                            <a href="note%20details.php"><h3>Computer Science</h3></a>
                            <ul class="note-details">
                                <li><img src="images/Search/university.png"><span>University of California, US</span></li>
                                <li><img src="images/Search/pages.png"><span>204 Pages</span></li>
                                <li><img src="images/Search/date.png"><span>Thu, Nov 26 2020</span></li>
                                <li><img src="images/Search/flag.png"><span>5 Users marked this note as inappropriate</span></li>
                            </ul>
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
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="note-image">
                            <img src="images/Search/3.jpg" class="img-fluid">
                        </div>
                        <div class="note-info">
                            <a href="note%20details.php"><h3>Basic Computer Engineering Tech India Publication Series</h3></a>
                            <ul class="note-details">
                                <li><img src="images/Search/university.png"><span>University of California, US</span></li>
                                <li><img src="images/Search/pages.png"><span>204 Pages</span></li>
                                <li><img src="images/Search/date.png"><span>Thu, Nov 26 2020</span></li>
                                <li><img src="images/Search/flag.png"><span>5 Users marked this note as inappropriate</span></li>
                            </ul>
                            <div class="stars">
                                <li>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <span>100 reviews</span>
                                </li>
                            </div>
                        </div>
                    </div>
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
    <!-- notes Ends -->
    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <!-- Copyright -->
                <div class="col-md-6 col-sm-8 footer-text text-left">
                    <p>Copyright &copy; TatvaSoft All Rights Reserved By</p>
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

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>