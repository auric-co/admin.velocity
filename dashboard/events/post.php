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
	if(isset($_POST['evnt'])){
	$q = $_POST['evnt'];
	$u ="SELECT post, img FROM `evnt` WHERE  `evnt`.`ev_id`='$q'";
	$qrry = mysqli_query($dbc, $u);
	$res=mysqli_fetch_assoc($qrry);

		if($res['post'] == 0){
			
			if(!empty($res['img'])){	
				$uu ="UPDATE `evnt` SET `post` = '1' WHERE `evnt`.`ev_id` = '$q'";
				$qry = mysqli_query($dbc, $uu);
				if($qry){
					echo "<script>alert('Event Posted!')</script>";
					echo "<script>window.open('details-events.php?evnt=$q&utm_atc=post_ed','_self')</script>";
				}
			}else{
			   echo "<script>alert('Event has no Image. Please upload image first for posting to be possible!')</script>";
					echo "<script>window.open('../upload/image?evt=".$q."&utm_atc=failed-post-img-missing','_self')</script>";
			}
		}elseif($res['post'] == 1){
			$uuu ="UPDATE `evnt` SET `post` = '0' WHERE `evnt`.`ev_id` = '$q'";
			$qrry = mysqli_query($dbc, $uuu);
			if($qrry){
				echo "<script>alert('Event De-Posted!')</script>";
					echo "<script>window.open('../events?utm_atc=de_post_ed','_self')</script>";
			}

		}

		mysqli_close($dbc);
	}
}
?>