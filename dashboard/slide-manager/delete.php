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
}
if (isset($_GET['id'])) {
	$id = func::escape_data($dbc, $_GET['id']);
	$sql = "SELECT * FROM `slide` WHERE `sl_tb_id`='$id'";
	$qry = mysqli_query($dbc, $sql);
	if(mysqli_num_rows($qry) == 1) {
		echo "found it";
	}else{
		echo "Not Found";
	}

}else{
	echo "<script>alert('Invalid Access')</script>";
    echo "<script>window.open('index.php?utm_error=ID Not set. Invalid Access detected','_self')</script>";
}




 ?>