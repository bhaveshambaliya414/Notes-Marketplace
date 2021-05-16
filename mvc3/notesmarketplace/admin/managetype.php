<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">


    <!-- Title -->
    <title>Manage Type</title>



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

    <!-- Manage Type  -->
    <section id="manage-type">

        <div class="content-box">

            <div class="container">

                <div class="row">
                    <div class="basic-heading">
                        <h3>Manage Type</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-md-6">
                        <div class="type-btn">
                            <a class="btn btn-type" href="#" title="type" role="button">Add Type</a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-6">
                        <div class="row">
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

                <div class="row table-general table-responsive">
                    <table>
                        <tr>
                            <th>SR No.</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Date Added</th>
                            <th>Added By</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>val 1</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>09/10/2020,10:10</td>
                            <td>Khayati Patel</td>
                            <td>Yes</td>
                            <td>
                                <a href="#"><img src="images/admin-images/edit.png" alt="edit"></a>
                                <a href="#"><img src="images/admin-images/delete.png" alt="delete"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>val2</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>10-10-2020,12:30</td>
                            <td>Rahul Shah</td>
                            <td>Yes</td>
                            <td>
                                <a href="#"><img src="images/admin-images/edit.png" alt="edit"></a>
                                <a href="#"><img src="images/admin-images/delete.png" alt="delete"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>val 3</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>11-10-2020,01:00</td>
                            <td>Suman Trivedi</td>
                            <td>No</td>
                            <td>
                                <a href="#"><img src="images/admin-images/edit.png" alt="edit"></a>
                                <a href="#"><img src="images/admin-images/delete.png" alt="delete"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>val 4</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>13-10-2020,10:10</td>
                            <td>Raj Malhotra</td>
                            <td>Yes</td>
                            <td>
                                <a href="#"><img src="images/admin-images/edit.png" alt="edit"></a>
                                <a href="#"><img src="images/admin-images/delete.png" alt="delete"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>val 5</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>14-10-2020,11:25</td>
                            <td>Niya Patel</td>
                            <td>No</td>
                            <td>
                                <a href="#"><img src="images/admin-images/edit.png" alt="edit"></a>
                                <a href="#"><img src="images/admin-images/delete.png" alt="delete"></a>
                            </td>
                        </tr>
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
    <!-- Manage Type Ends -->
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