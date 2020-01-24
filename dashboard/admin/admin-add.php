<?php
require_once("../inclt/config.php");
require_once("../inclt/functions.php");
require_once("../inclt/encrt/lib/password.php");

if(!func::checkLoginState($dbh)) {
   echo '<script> window.open("http://admin.teamvelocity.co.zw","_self")</script>';
   exit();
}

use PHPMailer\PHPMailer\PHPMailer;
include_once ("../inclt/PHPMailer/PHPMailer.php");
include_once ("../inclt/PHPMailer/Exception.php");
include_once ("../inclt/PHPMailer/SMTP.php");

$mail = new PHPMailer();
$mail->SMTPAuth = true;
$mail->Username = admnEmt;
$mail->Password = admnPD;
$mail->SMTPSecure = "TLS"; //ssl
$mail->Port = 587; //465

if(isset($_POST['register'])){
    $preg_error = "";
    if (preg_match ('%^[A-Za-z\." \-]{2,15}$%', stripslashes(trim($_POST['nmt'])))) {

        $nmt = func::escape_data($dbc, $_POST['nmt']);

    } else {

        $nmt = FALSE;
        $preg_error = '<div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Error!</strong> Please enter your first name!
                          </div>';


    }



    if (preg_match ('%^[A-Za-z\." \-]{2,30}$%', stripslashes(trim($_POST['snm'])))) {

        $snm = func::escape_data($dbc, $_POST['snm']);

    } else {
        $snm = FALSE;

        $preg_error .= '<div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Error!</strong> Please enter a valid Surname
                          </div>';
    }

    if (preg_match ('%^[A-Z]{1,1}$%', stripslashes(trim($_POST['gnder'])))) {

        $gender = func::escape_data($dbc, $_POST['gnder']);

    } else {
        $gender = FALSE;

        $preg_error .= '<div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Error!</strong> Invalid Gender Value.
                          </div>';
    }


    if (preg_match ('%^[A-Za-z0-9._\%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$%', stripslashes(trim($_POST['username'])))) {
        if (preg_match('/@teamvelocity\.co\.zw$/i', $_POST['username']))
        {
           $emtl = func:: escape_data($dbc, $_POST['username']);
        }else{
            $emtl = FALSE;

        $preg_error .= '<div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Error!</strong> Please enter a valid Velocity Health Email
                          </div>';
        }
        

    } else {

        $emtl = FALSE;

        $preg_error .= '<div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Error!</strong> Please enter a valid email Address
                          </div>';

    }
    $martSt = func::escape_data($dbc, $_POST['martStatus']);
    if (preg_match ('%^[a-z]{2,3}$%', stripslashes(trim($_POST['dept'])))) {

        $dep = func::escape_data($dbc, $_POST['dept']);

    } else {

        $dep = FALSE;
        $preg_error = '<div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Error!</strong> Please Select a valid Department!
                          </div>';


    }
    
     
     
     
     
     $addre = func::escape_data($dbc, $_POST['addr']);
     $pwd = func::createString(6);
     $id = "empl".func::createString(6);
    if($id && $pwd && $martSt && $addre && $emtl && $dep && $gender && $snm && $nmt){
        //email the login credentials to the created accounts username here
        $cpd = password_hash($pwd, PASSWORD_BCRYPT, array("cost" => 10));
        $sql = "INSERT INTO `admn_tb`(`id`, `nmt`, `snm`, `pro_pic`, `emtl`, `pwd`, `gender`, `dob`, `mar_status`, `dept`, `address`, `mbile`, `perm_lvl`) VALUES ('$id','$nmt','$snm','','$emtl','$cpd','$gender','','$martSt','$dep','$addre','','')";
        $insert = mysqli_query($dbc, $sql);
        if ($insert) {
            $subject = "Velocity Health Online System Account";
            $mail->addAddress($emtl);
            $mail->setFrom(admnEmt);
            $mail->Subject = $subject;
            $mail->isHTML(true);
            $body = "
            <h2 align='center'>Account Created</h2>
            <p>Your Velocity Health Portal Account has been created. Here are your login credentials</p>
            <p>Username/ Email: ".$emtl." <br/> Password: ".$pwd."</p>
            <p>Welcome to Velocity Health!</p>
            <hr/>
            <p>Regards <br/> <span style='color: lime; font-style: italics; font-size: 16px; font-weight: 300;'>Admin</span>
            <hr/>
            <p style='margin: 0 auto; color: limegreen;'>Copyright © Velocity Health ".date('Y')." </p>
            ";
            $mail->Body = $body;

            if ($mail->send()) {
               echo "<script>alert(' Successfully Created. Email Sent to Recipient!')</script>";
                echo "<script>window.open('/manage?action=account-created&acc=".$id."&emtl=1', '_self')</script>";
            }else{
                 echo "<script>alert(' Successfully Created! Email Failed to sent')</script>";
                echo "<script>window.open('manage?action=account-created&acc=".$id."&emtl=0', '_self')</script>";
            }
            
        }else{
            echo "<script>alert('Not Created!')</script>";
            echo "<script>window.open('/manage?action=account-not-created', '_self')</script>";
        }
    }

}
include_once("../includes/_hd.php");

 ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
            <div class="col-md-6 col-md-6 col-sm-6 col-xs-12">
                <div class="text-center custom-login" style="color:#fff;">
                    <h3>Registration</h3>
                    <p>Add New Velocity Admin Portal User.</p>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <?php if (isset($preg_error)) {
                            echo $preg_error;
                        } ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="addAdmin" method="post">
                            <div class="row">

                                <div class="form-group col-lg-6">
                                    <label>First Name</label>
                                    <input type="text" id="nmt" name="nmt" class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Surname</label>
                                    <input type="text" id="snm" name="snm" class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Gender</label>
                                    <select id="gnder" name="gnder" class="form-control">
                                        <option>Select Gender</option>
                                        <option value="F">Female</option>
                                        <option value="M">Male</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Marital Status</label>
                                    <select id="martStatus" name="martStatus" class="form-control">
                                        <option>Select Status</option>
                                        <option value="1">Married</option>
                                        <option value="0">Not Married</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Department</label>
                                    <select id="dept" name="dept" class="form-control">
                                    	<option>Select Department</option>
                                    	<option value="it">IT</option>
                                    	<option value="bd">Bussiness Development</option>
                                    	<option value="ad">Administration</option>
                                    	<option value="acc">Accounts</option>
                                    	<option value="sl">Sales</option>
                                    	<option value="mkt">Marketing</option>
                                    	<option value="pr">Public Relations</option>
                                    	<option value="hr">Human Resources</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Username <small>(username@teamvelocity.co.zw)</small></label>
                                    <input type="email" id="username" name="username" class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Mobile Number</label>
                                    <input type="text" id="phn" name="phn" class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Address</label>
                                    <textarea name="addr" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit" name="register" class="btn btn-success loginbtn" value="Register"/>
                                <input type="submit" onClick="formCancel()" class="btn btn-default" value="Cancel"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
        </div>
    </div>
<hr>
 <?php 

include_once("../includes/_ftr.php");

 ?>
 <script>
 function addUser(){
    event.preventDefault();
    $.ajax({
            type: 'post',
            url: 'post.php',
            data: $('addAdmin').serialize(),
            success: function () {
              alert('form was submitted');
            }
          });

 }
    function formCancel() {
        event.preventDefault();
        if (confirm("Are you sure you want to discard changes?")) {
            document.getElementById("addAdmin").reset();
            if (confirm("Return to Home?")) {
                window.open("../admin/", "_self");
            }
        };
    }
</script>