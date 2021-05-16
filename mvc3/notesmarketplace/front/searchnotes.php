<?php
session_start();
include "connection_db.php";

$page = 'searchnotes';
?>


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
                            <li class="nav-item"><a class="nav-link" href="../login.php">Login</a></li>
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
                <form>
                <div class="row serach-filter col-xl-12 col-md-12 col-lg-12 col-12 col-sm-12">
                    
                    <div class="form-group col-md-12 col-lg-12 col-12 col-sm-12">
                        <input type="search" class="form-control" id="search" placeholder="Search notes here...">
                    </div>

                    <div class="form-row col-md-12">
                    <div class="form-group col-xl-2 col-lg-2 col-md-2 col-sm-6">
                        <?php
                        $gettypequery = "SELECT * FROM notetypes WHERE isactive = b'1'";
                        $typequery = mysqli_query($conn, $gettypequery);
                        $typerows = mysqli_num_rows($typequery);
                        ?>
                        <select id="type" name="note-type" class="form-control">
                            <option selected value="">Select type</option>
                            <?php
                            for ($i = 1; $i <= $typerows; $i++) {
                            $typerow = mysqli_fetch_array($typequery);
                            ?>
                                <option value="<?php echo $typerow["id"] ?>"><?php echo $typerow["name"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <?php
                        $getcategoryquery = "SELECT * FROM notecategories WHERE isactive = b'1'";
                        $categoryquery = mysqli_query($conn, $getcategoryquery);
                        $categoryrows = mysqli_num_rows($categoryquery);
                        ?>
                        <select id="category" name="note-category" class="form-control">
                            <option selected value="">Select category</option>
                            <?php
                            for ($i = 1; $i <= $categoryrows; $i++) {
                            $categoryrow = mysqli_fetch_array($categoryquery);
                            ?>
                                <option value="<?php echo $categoryrow["id"] ?>"><?php echo $categoryrow["name"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <?php
                        $getuniquery = "SELECT DISTINCT universityname FROM `sellernotes` WHERE isactive = b'1' ORDER BY universityname";
                        $uniquery = mysqli_query($conn, $getuniquery);
                        $unirows = mysqli_num_rows($uniquery);
                        ?>
                        <select id="university" name="university" class="form-control">
                            <option selected value="">Select university</option>
                            <?php
                            for ($i = 1; $i <= $unirows; $i++) {
                            $unirow = mysqli_fetch_array($uniquery);
                            ?>
                                <option value="<?php echo $unirow["universityname"] ?>"><?php echo $unirow["universityname"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <?php
                        $getcoursequery = "SELECT DISTINCT course FROM `sellernotes` WHERE isactive = b'1' ORDER BY course";
                        $coursequery = mysqli_query($conn, $getcoursequery);
                        $courserows = mysqli_num_rows($coursequery);
                        ?>
                        <select id="course" name="course" class="form-control">
                            <option selected value="">Select course</option>
                            <?php
                            for ($i = 1; $i <= $courserows; $i++) {
                            $courserow = mysqli_fetch_array($coursequery);
                            ?>
                                <option value="<?php echo $courserow["course"] ?>"><?php echo $courserow["course"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <?php
                        $getcountryquery = "SELECT * FROM `countries` WHERE isactive = b'1'";
                        $countryquery = mysqli_query($conn, $getcountryquery);
                        $countryrows = mysqli_num_rows($countryquery);
                        ?>
                        <select id="country" name="country" class="form-control">
                            <option selected value="">Select country</option>
                            <?php
                            for ($i = 1; $i <= $countryrows; $i++) {
                            $countryrow = mysqli_fetch_array($countryquery);
                            ?>
                                <option value="<?php echo $countryrow["id"] ?>"><?php echo $countryrow["name"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <select id="rating" name="rating" class="form-control">
                            <option selected value="">Select rating</option>
                            <option value="1">1+</option>
                            <option value="2">2+</option>
                            <option value="3">3+</option>
                            <option value="4">4+</option>
                            <option value="5">5+</option>
                        </select>
                    </div>
                    </div>
                   
                </div>
             </form>
            </div>

        </div>

    </section>
    <!-- Search and filter Ends -->

    <!-- Notes -->
    <section id="note-list">

        
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
    
    <script>
        $(document).ready(function() {
            var page = 1;
            $('#note-list').load('filter_notes.php');
            $('#note-list').on('click', 'a.page-link', function(e) {
                e.preventDefault();
                var type = $('#type').val();
                var category = $('#category').val();
                var university = $('#university').val();
                var course = $('#course').val();
                var country = $('#country').val();
                var rating = $('#rating').val();
                var title = $('input').val();


                if ($(this).find('.left-arrow').attr('class') == $('.left-arrow').attr("class")) {

                    if (parseInt($('.active .page-link').text()) == 1) {
                        var page = parseInt($('.active .page-link').text());

                    } else {
                        var page = parseInt($('.active .page-link').text()) - 1;
                    }
                } else if ($(this).find('.right-arrow').attr('class') == $('.right-arrow').attr("class")) {

                    if (parseInt($('.active .page-link').text()) == parseInt($(this).parent().prev().text())) {
                        var page = parseInt($('.active .page-link').text());
                    } else {
                        var page = parseInt($('.active .page-link').text()) + 1;
                    }
                } else {
                    var page = $(this).text();
                }

                $.ajax({
                    url: "filter_notes.php",
                    type: "POST",
                    data: {
                        'note-type': type,
                        'note-category': category,
                        'university': university,
                        'course': course,
                        'country': country,
                        'rating': rating,
                        'search-notes': title,
                        'dropdown': "dropdown",
                        'page': page
                    },
                    dataType: "text",
                    success: function(res) {
                        $('#note-list').html(res);
                    },
                    error: function(err) {
                        console.log(err.statusText);
                    },
                });
            });

            $('select').change(function() {
                var type = $('#type').val();
                var category = $('#category').val();
                var university = $('#university').val();
                var course = $('#course').val();
                var country = $('#country').val();
                var rating = $('#rating').val();

                $.ajax({
                    url: "filter_notes.php",
                    type: "POST",
                    data: {
                        'note-type': type,
                        'note-category': category,
                        'university': university,
                        'course': course,
                        'country': country,
                        'rating': rating,
                        'dropdown': "dropdown",
                        'page': page
                    },
                    dataType: "text",
                    success: function(response) {
                        $("#note-list").html(response);

                    },
                    error: function(err) {
                        console.log(err.statusText);
                    },
                });
            });


            $("input").keyup(function() {
                var title = $(this).val();
                var type = $('#type').val();
                var category = $('#category').val();
                var university = $('#university').val();
                var course = $('#course').val();
                var country = $('#country').val();
                var rating = $('#rating').val();
                $.ajax({
                    url: "filter_notes.php",
                    type: "POST",
                    data: {
                        'searchnotes': title,
                        'input': "input",
                        'note-type': type,
                        'note-category': category,
                        'university': university,
                        'course': course,
                        'country': country,
                        'rating': rating,
                        'dropdown': "dropdown",
                        'page': page
                    },
                    dataType: "text",
                    success: function(res) {
                        $('#note-list').html(res);
                    },
                    error: function(err) {
                        console.log(err.statusText);
                    },
                });
            });
        });
    </script>
    
</body>

</html>