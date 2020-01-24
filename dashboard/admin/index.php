<?php
if(!func::checkLoginState($dbh)) {
   echo '<script> window.open("../../../admin.teamvelocity.co.zw","_self")</script>';
   exit();
}
require_once("../inclt/config.php");
require_once("../inclt/functions.php");
require_once("../inclt/encrt/lib/password.php");
include_once("../includes/_hd.php");

include_once("../includes/top_bar.php");

print_r($_POST);
 ?>





 <?php 

include_once("../includes/_ftr.php");

 ?>