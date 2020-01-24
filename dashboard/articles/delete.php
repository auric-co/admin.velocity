<?php
require_once("../inclt/config.php");
require_once("../inclt/functions.php");

if(!func::checkLoginState($dbh)) {
   echo '<script> window.open("../../../admin.teamvelocity.co.zw","_self")</script>';
   exit();
}
include_once("../includes/_hd.php");
if(!isset($_POST["art_id"])){
    header('Location: ' . $uri."?error=invalid access detected");
    exit();
}

$id = func:: escape_data($dbc,$_POST['art_id']);
$sql = "SELECT * FROM `h_pages` WHERE `id`='$id' ";
$qry = mysqli_query($dbc, $sql);
if(mysqli_num_rows($qry) == 1) {

	$dsql = "DELETE FROM `h_pages` WHERE `id`='$id'";
	$delete = mysqli_query($dbc, $dsql);
	if ($delete) {
		echo "<script>alert('Article Successfully Deleted!')</script>";
            echo "<script>window.open('index.php?utm_atc=article-deleted','_self')</script>";
	}else{
		echo "<script>alert('Article Successfully Deletion Failed!')</script>";
        echo "<script>window.open('details.php?art_id=".$id."&utm_atc=dlete-failed','_self')</script>";
	}
}else{
	echo "<script>alert('Article Not Found!')</script>";
            echo "<script>window.open('index.php?utm_atc=article-not-found','_self')</script>";
}
 ?>