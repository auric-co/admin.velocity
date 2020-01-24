<?php
session_start();
require_once("../inclt/config.php");
require_once("../inclt/functions.php");
if(!func::checkLoginState($dbh)){
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];
    echo '<script> window.open("'.$uri.'","_self")</script>';
    exit();
}else{
    if(isset($_POST['art_id'])){

        $q = $_POST['art_id'];
        $u ="SELECT post, img, h_cat FROM `h_pages` WHERE  `h_pages`.`id`='$q'";
        $qrry = mysqli_query($dbc, $u);
        if(mysqli_num_rows($qrry) == 0){
            echo "<script>alert('Article Not Found!')</script>";
            echo "<script>window.open('index.php?error=article-not-found','_self')</script>";
        }else{
            $res=mysqli_fetch_assoc($qrry);

            if($res['post'] == 0){

                if(!empty($res['img'])){

                    $uu ="UPDATE `h_pages` SET `post` = '1' WHERE `id` = '$q'";
                    $qry = mysqli_query($dbc, $uu);

                    if($qry){

                        echo "<script>alert('Articles Posted!')</script>";
                        echo "<script>window.open('details.php?utm_atc=post_ed&art_id=".$q."','_self')</script>";

                    }

                }else{

                    echo "<script>alert('Article has no Image. Please upload image first for posting to be possible!')</script>";
                    echo "<script>window.open('image?art_id=".$q."&utm_atc=failed-post-img-missing','_self')</script>";

                }

            }elseif($res['post'] == 1){

                $uuu ="UPDATE `h_pages` SET `post` = '0' WHERE `id` = '$q'";
                $qrry = mysqli_query($dbc, $uuu);
                if($qrry){
                    echo "<script>alert('Event De-Posted!')</script>";
                    echo "<script>window.open('details.php?utm_atc=post_ed&artic=".$q."','_self')</script>";
                }

            }
        }       
        mysqli_close($dbc);
    }
}
?>