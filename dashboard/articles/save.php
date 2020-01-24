<?php
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];
    
require_once("../inclt/config.php");
require_once("../inclt/functions.php");
if(!func::checkLoginState($dbh)) {
    header('Location: ' . $uri);
    exit();
}

if(!isset($_POST["art_id"])){
    echo '<script> window.open("'.$uri.'","_self")</script>';
    exit();
}

$id = func:: escape_data($dbc,$_POST['art_id']);
$ssql = "SELECT * FROM `h_pages` WHERE `id`='$id' ";
$qqry = mysqli_query($dbc, $ssql);
if(mysqli_num_rows($qqry) == 1) {

    if (preg_match ('%^[0-9]{0,2}$%', stripslashes(trim($_POST['p_cat'])))) {

        $cat = func:: escape_data($dbc,$_POST['p_cat']);

    } else {

        $cat = FALSE;
        $error = '<div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Error!</strong>Invalid Category
                </div>';


    }

    $tittle = func:: escape_data($dbc,$_POST['p_name']);
    $ackn = func:: escape_data($dbc,$_POST['ackn']);
    $intro = $_POST['p_intro'];
    $h_post = $_POST['p_data'];

    $sql = "UPDATE `h_pages` SET `tittle`='$tittle', `h_intro`='$intro', `h_post`='$h_post', `ackn`='$ackn', `h_cat`='$cat' WHERE `id`='$id'";
    $insert = mysqli_query($dbc, $sql);
    if ($insert) {
        echo "<script>alert('Saved Successfully!')</script>";
            echo "<script>window.open('index.php?utm_atc=article-saved','_self')</script>";
    }else{
        echo "<script>alert('Article Editing Failed!')</script>";
        echo "<script>window.open('details.php?art_id=".$id."&utm_atc=edit-failed','_self')</script>";
    }
}else{
    echo "<script>alert('Article Not Found!')</script>";
            echo "<script>window.open('index.php?utm_atc=article-not-found','_self')</script>";
}
 ?>