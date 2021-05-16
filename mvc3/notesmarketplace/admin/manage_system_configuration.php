<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">

    <!-- Title -->
    <title>Manage System Configuration</title>

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
                                    <a class="dropdown-item" href="my-profile.php">Update Profile</a>
                                    <a class="dropdown-item" href="../front/changepassword.php">Change Password</a>
                                    <a class="dropdown-item logout" href="../logout.php">Logout</a>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </nav>

    </header>
    <!-- Navigation  Ends -->

    <!--  Manage System Configuration -->
    <section id="system-configuration">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="basic-heading">
                        <h3>Manage System Configuration</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Support emails address *</label>
                            <input type="text" class="form-control" id="support-emails" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="phone no">Support phone number *</label>
                            <input type="text" class="form-control" id="phone-no" placeholder="Enter phone number">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address(es)(for various events system will send notifications to these users) *</label>
                            <input type="text" class="form-control" id="email" placeholder="Enter email address">
                        </div>
                        <div class="form-group">
                            <label for="facebook url">Facebook URL</label>
                            <input type="text" class="form-control" id="facebook-url" placeholder="Enter facebook url">
                        </div>
                        <div class="form-group">
                            <label for="twitter url">Twitter URL</label>
                            <input type="text" class="form-control" id="twitter-url" placeholder="Enter twitter url">
                        </div>
                        <div class="form-group">
                            <label for="linkedin url">Linkedin URL</label>
                            <input type="text" class="form-control" id="linkedin-url" placeholder="Enter linkedin url">
                        </div>
                        <div class="form-group">
                            <label for="image">Default image for notes (if seller do not upload)</label>
                            <input type="file" class="form-control-file image-upload-file" id="default-image" required>
                        </div>
                        <div class="form-group">
                            <label for="profile-picture">Default Profile Picture (if seller do not upload)</label>
                            <input type="file" class="form-control-file image-upload-file" id="profile-picture" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="submit-btn">
                        <a class="btn btn-submit" href="#" title="submit" role="button">Submit</a>
                    </div>
                </div>

            </div>

        </div>

    </section>
    <!--  Manage System Configuration Ends -->
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

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>