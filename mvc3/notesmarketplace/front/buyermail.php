<?php
session_start();
ob_start();

if (!isset($_SESSION['loggedin'])) {
    header('location:../login.php');
} else {
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $email_id = $_SESSION['email'];
    $user_id = $_SESSION['userid'];
}



include 'connection_db.php';
include 'sendmail.php';

if (isset($_GET['id'])) {
    $noteid = $_GET['id'];

    $getattach = "SELECT * FROM sellernotesattachments WHERE noteid = $noteid";
    $attachements = mysqli_query($conn, $getattach);
    if ($attachements) {
        $getid = "SELECT * FROM downloads WHERE `downloads`.`noteid` = $noteid AND downloader != $user_id";
        $getidquery = mysqli_query($conn, $getid);
        $iddata = mysqli_fetch_assoc($getidquery);
        $idcount = $iddata['id'];
        $buyerid = $iddata['downloader'];

        while ($atta = mysqli_fetch_assoc($attachements)) {
            $filepath = $atta['filepath'];

            $updatedetail = "UPDATE `downloads` SET `issellerhasalloweddownload` = b'1', `attachmentpath` = '$filepath'  WHERE noteid = '$noteid' AND downloader = '$buyerid' AND id = '$idcount'";
            $updatequery = mysqli_query($conn, $updatedetail);
            if (!($updatequery)) {
                die("QUERY FAILED" . mysqli_error($conn));
            }
            $idcount++;
        }
    } else {
        die("QUERY FAILED" . mysqli_error($conn));
    }

    $getbuyerdetail = "SELECT * FROM users WHERE id = $buyerid";
    $buyerquery = mysqli_query($conn, $getbuyerdetail);
    $buyerdata = mysqli_fetch_assoc($buyerquery);


    $buyeremail = $buyerdata['email'];
    $buyername = $buyerdata['firstname'];



    $mail->addAddress($buyeremail);  // This email is where you want to send the email
    $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "$firstname, Allows you to download a note";

    $mail->Body = "Hello $buyername,<br><br> We would to inform you that, $firstname Allows you to download a note. <br>  Please login and see my Download tabs to download particular note. <br><br> Regards,<br>Notes Marketplace";

    if (!$mail->send()) {


?>
        <script>
            alert('error to sent mail');
            window.location.href = "buyerrequests.php";
        </script>
<?php
    } else {
        header('location:buyerrequests.php');
    }
}


?>