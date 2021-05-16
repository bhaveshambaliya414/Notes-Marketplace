<?php
session_start();

include "connection_db.php";

if (!empty($_GET['id'])) {
    $noteid = $_GET['id'];
    $attaarray = array();
    $i = 0;
    $updatetask = 0;
    $attanamearray = array();
    $getdetail = "SELECT * FROM sellernotes WHERE id = $noteid";
    $query = mysqli_query($conn, $getdetail);
    if ($query) {
        $detail = mysqli_fetch_assoc($query);
        $sellerid = $detail['sellerid'];
        $buyerid = $_SESSION['userid'];
        $ispaid = $detail['ispaid'];
        $price = $detail['sellingprice'];
        $title = $detail['title'];
        $category = $detail['category'];

        $getcategory = "SELECT * FROM notecategories WHERE id = '$category' AND isactive = b'1'";
        $catquery = mysqli_query($conn, $getcategory);
        $catdeatil = mysqli_fetch_assoc($catquery);
        $catname = $catdeatil['name'];

        $getatta = "SELECT * FROM sellernotesattachments WHERE noteid = $noteid";
        $attachements = mysqli_query($conn, $getatta);
        if ($attachements) {
            $count = mysqli_num_rows($attachements);

            $getid = "SELECT * FROM downloads WHERE noteid = $noteid AND downloader = $buyerid";
            $getidquery = mysqli_query($conn, $getid);
            $iddata = mysqli_fetch_assoc($getidquery);
            $idcount = $iddata['id'];

            while ($atta = mysqli_fetch_assoc($attachements)) {
                $fpath = $atta['filepath'];
                if (file_exists($fpath)) {
                    array_push($attaarray, $atta['filepath']);
                    array_push($attanamearray, $atta['filename']);
                } else {
                    echo "file not found";
                }

                if ($ispaid == 0) {
                    $insertdata1 = "INSERT INTO `downloads` (`noteid`, `seller`, `downloader`, `issellerhasalloweddownload`, `attachmentpath`, `isattachmentdownloaded`, `attachmentdownloadeddate`, `ispaid`, `purchasedprice`, `notetitle`, `notecategory`, `createddate`, `createdby`, `modifieddate`, `modifiedby`) VALUES ('$noteid', '$sellerid', '$buyerid', b'1', '$fpath', b'1', current_timestamp(), b'0', NULL, '$title', '$catname', current_timestamp(), '$buyerid', current_timestamp(), '$buyerid')";
                    $query1 = mysqli_query($conn, $insertdata1);
                    if (!($query1)) {
                        die("QUERY FAILED" . mysqli_error($conn));
                    }
                } else {
                    $checkquery = "SELECT * FROM downloads WHERE noteid = $noteid AND downloader = $buyerid";
                    $check = mysqli_query($conn, $checkquery);
                    $checkdata = mysqli_fetch_assoc($check);

                    $isdownloaded = $checkdata['isattachmentdownloaded'];
                    if ($isdownloaded == 1 && $updatetask == 0) {
                        $insertdata2 = "INSERT INTO `downloads` (`noteid`, `seller`, `downloader`, `issellerhasalloweddownload`, `attachmentpath`, `isattachmentdownloaded`, `attachmentdownloadeddate`, `ispaid`, `purchasedprice`, `notetitle`, `notecategory`, `createddate`, `createdby`, `modifieddate`, `modifiedby`) VALUES ('$noteid', '$sellerid', '$buyerid', b'1', '$fpath', b'1', current_timestamp(), b'1', '$price', '$title', '$catname', current_timestamp(), '$buyerid', current_timestamp(), '$buyerid')";
                        $query2 = mysqli_query($conn, $insertdata2);
                        if (!($query2)) {
                            die("QUERY FAILED" . mysqli_error($conn));
                        }
                    } else {
                        $updatedata = "UPDATE `downloads` SET `isattachmentdownloaded` = b'1', `attachmentdownloadeddate` = current_timestamp() WHERE noteid = '$noteid' AND downloader = '$buyerid' AND id = '$idcount'";
                        $query3 = mysqli_query($conn, $updatedata);
                        if (!($query3)) {
                            die("QUERY FAILED" . mysqli_error($conn));
                        }
                        $updatetask = 1;
                        $idcount++;
                    }
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
            $updatetask = 0;
            unlink($zipname);
        }
    }
}