<?php
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
$uri .= $_SERVER['HTTP_HOST'];

require_once("../inclt/config.php");
require_once("../inclt/functions.php");
if(func::checkLoginState($dbh)){
    func:: deleteCookie();
	
	header('Location: '.$uri);
	exit();
}else{
    header('Location: '.$uri);
	exit();
	}

?>