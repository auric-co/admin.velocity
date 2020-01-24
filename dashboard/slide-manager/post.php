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
    if(isset($_POST['id'])){

        $q = $_POST['id'];

        $u ="SELECT post, img FROM `slide` WHERE  `sl_tb_id`='$q'";
        $qrry = mysqli_query($dbc, $u);
        if(mysqli_num_rows($qrry) == 0){
            echo "<script>alert('Article Not Found!')</script>";
            echo "<script>window.open('index.php?error=article-not-found','_self')</script>";
        }else{
            $res=mysqli_fetch_assoc($qrry);

            if($res['post'] == 0){

                if (!empty($res['img'])) {
                    $uuu = "UPDATE `slide` SET `actve` = '0' WHERE `sl_tb_id` != '$q'";
                    $qruy = mysqli_query($dbc, $uuu);
                    if ($qruy) {
                        $uu = "UPDATE `slide` SET `post` = '1' WHERE `sl_tb_id` = '$q'";
                        $qry = mysqli_query($dbc, $uu);

                        if($qry){

                            echo "<script>alert('Articles Posted!')</script>";
                            echo "<script>window.open('index.php?utm_atc=slide_posted','_self')</script>";

                        }  
                    }else{
                        echo "<script>alert('Cannot Post Article on slider at this time. Please try again later or contact Admin!')</script>";
                        echo "<script>window.open('index.php?utm_atc=slide_posting_failed','_self')</script>";
                    }
                    
                }else{
                    echo "<script>alert('Slide has got no Slide Image!')</script>";
                    echo "<script>window.open('index.php?utm_atc=slide_not-posted','_self')</script>";
                }
                

            }elseif($res['post'] == 1){

                $uuu = "UPDATE `slide` SET `post` = '0' WHERE `sl_tb_id` = '$q'";
                $qrry = mysqli_query($dbc, $uuu);
                if($qrry){
                    echo "<script>alert('Article De-Posted!')</script>";
                    echo "<script>window.open('index.php?utm_atc=de-post_ed','_self')</script>";
                }

            }
        }       
        mysqli_close($dbc);
    }
}
?>