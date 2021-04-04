<?php
include 'connection_db.php';

?>

<section>
    <?php
    if (isset($_POST['page'])) {
        $page = (int)$_POST['page'];
    } else {
        $page = "";
    }

    if ($page == "" || $page == 1) {
        $page1 = 0;
    } else {
        $page1 = ($page * 9) - 9;
    }
    ?>

    <?php
    $sql = "SELECT * FROM sellernotes WHERE status = 2";
    if (isset($_POST['dropdown'])) {
        $type = $_POST['note-type'];
        $category = $_POST['note-category'];
        $university = $_POST['university'];
        $course = $_POST['course'];
        $country = $_POST['country'];
        $ratings = $_POST['rating'];

        if ($type != "") {

            $sql .= " AND notetype=$type";
        }

        if ($category != "") {

            $sql .= " AND category=$category";
        }
        if ($university != "") {

            $sql .= " AND universityname='{$university}'";
        }
        if ($course != "") {

            $sql .= " AND course='{$course}'";
        }
        if ($country != "") {

            $sql .= " AND country=$country";
        }
    }
    if (isset($_POST['input'])) {
        $title = $_POST['searchnotes'];

        if ($title != "") {
            $sql .= " AND title LIKE '%$title%'";
        }
    }
    $sql .= " GROUP BY sellernotes.id";
    if (isset($ratings)) {
        if ($ratings != "") {
            $sql .= " HAVING avgratings >= $ratings";
        }
    }

    $result = mysqli_query($conn, $sql);
    if (!($result)) {
        die("QUERY FAILED" . mysqli_error($conn));
    }
    $count = mysqli_num_rows($result);

    ?>
    <div class="content-box">
        <div class="container">
            <div class="row">
                <div class="search-title basic-heading-sm col-md-12 col-lg-12 col-12 col-sm-12">
                    <h3><?php
                        if ($count == 0) {
                            echo "No Notes Availiable";
                        } else {
                            echo "Total $count Notes";
                        }
                        ?>
                    </h3>
                </div>
            </div>

            <div class="row note-results">

                <?php

                $sql .= " LIMIT $page1,9";
                $select_query = mysqli_query($conn, $sql);
                if (!($select_query)) {
                    die("QUERY FAILED" . mysqli_error($conn));
                }

                while ($data = mysqli_fetch_assoc($select_query)) {
                    $noteid = $data['id'];
                    $userid = $data['sellerid'];
                    $dpname = $data['displaypicture'];
                    if (isset($data['avgratings'])) {
                        $ratings = round($data['avgratings']);
                    } else {
                        $ratings = 0;
                    }
                ?>
                    <div class="col-md-6 col-lg-4 col-12 col-sm-12 notess">
                        <!-- note Table 01 -->
                        <div class="note-table">
                            <div class="note-image">
                                <!--<img src="images/Search/1.jpg" alt="notecoverimage" class="img-responsive">-->
                                <?php
                                if ($dpname != "") {
                                    //echo "<img src='../Members/$userid/$noteid/$dpname' alt='notecoverimage' class='img-responsive'>";
                                //} else {
                                    echo "<img src='images/Search/1.jpg' alt='notecoverimage' class='img-responsive img-fluid'>";
                                }
                                ?>
                            </div>
                            <div class="note-info">
                                
                                <a href="notedetails.php?id=<?php echo "$noteid"; ?>">
                                    <h3><?php echo $data['title']; ?></h3>
                                </a>
                                        
                                
                                <ul class="note-details">
                                    <?php
                                    $cid = $data['country'];
                                    $getcoun = "SELECT * FROM countries WHERE isactive = b'1' AND id = '$cid'";
                                    $getcquery = mysqli_query($conn, $getcoun);
                                    $cdata = mysqli_fetch_assoc($getcquery);

                                    ?>
                                    <li><img src="images/Search/university.png" alt="university"><?php echo $data['universityname'] . ", " . $cdata['name']; ?></li>
                                    <li><img src="images/Search/pages.png" alt="notebook"><?php echo $data['numberofpages'] . " Pages"; ?></li>
                                    <li><img src="images/Search/date.png" alt="date"><?php $pdate = $data['publisheddate'];
                                                                                        $date = strtotime($pdate);
                                                                                        echo date('D, M j Y', $date); ?></li>
                                    <li><img src="images/Search/flag.png" alt="flag"><span>
                                        <?php
                                        $issue = "SELECT * FROM sellernotesreportedissues WHERE noteid = $noteid";
                                        $issuequery = mysqli_query($conn, $issue);
                                        $countissue = mysqli_num_rows($issuequery);
                                        echo "$countissue Users marked this note as inappropriate";
                                        ?></span></li>
                                </ul>
                                <div class="stars">
                                    <?php
                                    $getrating = "SELECT AVG(ratings) AS Averagerating, COUNT(ratings) AS counts FROM sellernotesreviews WHERE noteid = $noteid";
                                    $ratingquery = mysqli_query($conn, $getrating);
                                    $avgrating = mysqli_fetch_assoc($ratingquery);
                                    $rating = $avgrating['Averagerating'];
                                    $countrating = $avgrating['counts'];

                                    for ($j = 1; $j <= $ratings; $j++) {
                                    ?>
                                        <img src="images/Search/star.png">
                                    <?php
                                    }
                                    for ($k = 1; $k <= 5 - $ratings; $k++) {
                                    ?>
                                        <img src="images/Search/star-white.png" class="img-fluid">
                                    <?php
                                    }
                                    ?>
                                
                                
                                    <span><?php echo $countrating; ?> reviews</span>
                                </div>
                            </div>


                        </div>
                    </div>
                <?php
                }
                ?>


            </div>
            <?php
            $count1 = ceil($count / 9);
            ?>

            <div class="row justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href='#'>
                                <img src="images/Search/left-arrow.png" alt="previous" class="left-arrow">
                            </a>
                        </li>
                        <?php

                        for ($i = 1; $i <= $count1; $i++) {
                            if ($i == $page || ($page == "" && $i == 1)) {
                                echo "<li class='active page-item'><a class='page-link' href=''>$i</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href=''>$i</a></li>";
                            }
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link" href='#'>
                                <img src="images/Search/right-arrow.png" alt="next" class="right-arrow">

                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>


</section>
