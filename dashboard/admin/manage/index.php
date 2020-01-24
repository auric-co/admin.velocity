<?php
require_once("../../inclt/config.php");
require_once("../../inclt/functions.php");
require_once("../../inclt/encrt/lib/password.php");

if(!func::checkLoginState($dbh)) {
   echo '<script> window.open("http://admin.teamvelocity.co.zw","_self")</script>';
   exit();
}

use PHPMailer\PHPMailer\PHPMailer;
include_once ("../../inclt/PHPMailer/PHPMailer.php");
include_once ("../../inclt/PHPMailer/Exception.php");
include_once ("../../inclt/PHPMailer/SMTP.php");

$mail = new PHPMailer();
$mail->SMTPAuth = true;
$mail->Username = admnEmt;
$mail->Password = admnPD;
$mail->SMTPSecure = "TLS"; //ssl
$mail->Port = 587; //465


include_once("../../includes/_hd.php");

 ?>
    <div class="container-fluid">
        <div class="row"></div>
    </div>
<hr>
 <?php 

include_once("../../includes/_ftr.php");