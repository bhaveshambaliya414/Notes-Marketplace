<?php
session_start();

include "../front/connection_db.php";

if (!empty($_GET['id'])) {
    $noteid = $_GET['id'];
    $attaarray = array();
    $attanamearray = array();

    $notedetail = "SELECT * FROM sellernotes WHERE id = $noteid";
    $query = mysqli_query($conn, $notedetail);
    if ($query) {
        $detail = mysqli_fetch_assoc($query);
        $sellerid = $detail['sellerid'];
        $ispaid = $detail['ispaid'];
        $price = $detail['sellingprice'];
        $title = $detail['title'];
        $category = $detail['category'];

        $noteattach = "SELECT * FROM sellernotesattachments WHERE noteid = $noteid";
        $attachements = mysqli_query($conn, $noteattach);
        if ($attachements) {
            $count = mysqli_num_rows($attachements);

            while ($attach = mysqli_fetch_assoc($attachements)) {
                $fpath = $attach['filepath'];
                if (file_exists($fpath)) {
                    array_push($attaarray, $attach['filepath']);
                    array_push($attanamearray, $attach['filename']);
                } else {
                    echo "file not found";
                }
            }
            $zipname = time() . ".zip";
            $zip = new ZipArchive;
            $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
            foreach ($attaarray as $file) {
                $zip->addFile($file, basename($file));
            }
            $zip->close();
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename=' . $zipname);
            readfile($zipname);
            unlink($zipname);
        }
    }
}
?>