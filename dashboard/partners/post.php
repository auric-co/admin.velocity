<?php
session_start();
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];

require_once("../inclt/config.php");
require_once("../inclt/functions.php");
if(!func::checkLoginState($dbh)){
    header('Location: '.$uri);
    exit();
}else{
    if(isset($_POST['ptn_id'])){

        $q = func::escape_data($dbc,$_POST['ptn_id']);
        $u ="SELECT `post`, `bg_img`, `img` FROM `patners` WHERE  `patners`.`id`='$q'";
        $qrry = mysqli_query($dbc, $u);
        $res=mysqli_fetch_assoc($qrry);

        if($res['post'] == 0){

            if($res['img'] == "" && $res['bg_img'] == ""){

                $uu ="UPDATE `patners` SET `post` = '1' WHERE `id` = '$q'";
                $qry = mysqli_query($dbc, $uu);

                if($qry){

                    echo "<script>alert('Partner Posted!')</script>";
                    echo "<script>window.open('details.php?utm_atc=post_ed&ptn_id=".$q."','_self')</script>";

                }

            }else{

                echo "<script>alert('Article has no Image. Please upload image first for posting to be possible!')</script>";
                echo "<script>window.open('upload/image?type=sml&ptn_id=".$q."&utm_atc=failed-post-img-missing','_self')</script>";

            }

        }elseif($res['post'] == 1){

            $uuu ="UPDATE `patners` SET `post` = '0' WHERE `id` = '$q'";
            $qrry = mysqli_query($dbc, $uuu);
            if($qrry){
                echo "<script>alert('Partner De-Posted!')</script>";
                echo "<script>window.open('details.php?utm_atc=post_ed&ptn_id=".$q."','_self')</script>";
            }

        }

        mysqli_close($dbc);
    }
}
?>