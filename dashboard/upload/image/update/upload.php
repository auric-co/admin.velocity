<?php
session_start();
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
$uri .= $_SERVER['HTTP_HOST'];

require_once("../../../inclt/config.php");
require_once("../../../inclt/functions.php");


if(!func::checkLoginState($dbh)){
    header('Location: '.$uri);
    exit();
}else{

    $target_dir = "../../../../../public_html/wpv-content/2018/uploads/events/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk =1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(isset($_POST["submit"])){

        $ev = func:: escape_data($dbc,$_POST['ev']);

        $u ="SELECT * FROM `evnt` WHERE  `evnt`.`ev_id`='$ev'";
        $qrry = mysqli_query($dbc, $u);
        if(mysqli_num_rows($qrry) == 1){

            // Check if image file is a actual image or fake image

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                ;
                $uploadOk = 1;
                // Check if file already exists
                if (file_exists($target_file)) {

                    echo "<script>alert('Sorry, file already exists!')</script>";
                    echo "<script>window.open('index.php?evt=".$ev."&utm_atc=failed-upload-img-exist','_self')</script>";
                    $uploadOk = 0;
                }
                // Check file size
                // Should also check if image dimensions fit for our display, template dimensions should be like this 486 width 648.
                if ($_FILES["fileToUpload"]["size"] > 500000) {

                    echo "<script>alert('Sorry, your file is too large!')</script>";
                    echo "<script>window.open('index.php?evt=".$ev."&utm_atc=failed-file-large','_self')</script>";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {

                    echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed!')</script>";
                    echo "<script>window.open('index.php?evt=".$ev."&utm_atc=failed-file-not-supported','_self')</script>";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "<script>alert('Sorry, your file was not uploaded!')</script>";
                    echo "<script>window.open('index.php?evt=".$ev."&utm_atc=error!Failed-upload','_self')</script>";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                        $img = basename( $_FILES["fileToUpload"]["name"]);
                        $uu ="UPDATE `evnt` SET `img` = '$img' WHERE `evnt`.`ev_id` = '$ev'";
                        $qry = mysqli_query($dbc, $uu);
                        if($qry){
                            echo "<script>alert('Upload successful!')</script>";
                            echo "<script>window.open('".$uri."/dashboard/events/details-events.php?evnt=".$ev."&utm_atc=upload_ed&file=".basename( $_FILES["fileToUpload"]["name"])."','_self')</script>";
                        }else{
                            // db insert needs to be retryd
                        }

                    } else {
                        echo "<script>alert('Sorry, there was an error uploading your file!')</script>";
                        echo "<script>window.open('index.php?evt=".$ev."&utm_atc=error!Failed-upload','_self')</script>";
                    }
                }
            } else {
                echo "<script>alert('File is not an image!')</script>";
                echo "<script>window.open('index.php?evt=".$ev."&utm_atc=error!File-not-image','_self')</script>";
                $uploadOk = 0;
            }

        }else{
            echo "<script>alert('Event Not Found to upload image!')</script>";
            echo "<script>window.open('index.php?evt=".$ev."&utm_atc=error!event-not-found','_self')</script>";

        }
    }else{
        header("location:".$uri."/dashboard?utm_error=invalid-access");
        exit();
    }
}
?>