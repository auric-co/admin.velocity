<?php
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];
    

require_once("../../../inclt/config.php");
require_once("../../../inclt/functions.php");

if(!func::checkLoginState($dbh)) {
    header('Location: ' . $uri);
    exit();
}
if(!isset($_GET['evt'])){
    header("location:".$uri."/?utm_error=invalid-access");
    exit();
}else
    $id = func:: escape_data($dbc,$_POST['evt']);
        $ev = func:: escape_data($dbc,$_GET['evt']);
        $sle = "SELECT * FROM `evnt` WHERE  `evnt`.`ev_id`='$ev'";
        $sqle = mysqli_query($dbc, $sle);
        if(mysqli_num_rows($sqle) == 1){
            $rs=mysqli_fetch_assoc($sqle);
            if($rs['img'] != "" ){
                echo "<script>alert('Event Has Image!')</script>";
            }

        }else{
            echo "<script>alert('Event Not Found!')</script>";
            echo "<script>window.open('".$uri."/dashboard?utm_atc=not-found&evnt=".$ev."','_self')</script>";
        }
include_once("../../../includes/_hd.php");
    ?>

    <div class="row bg-white m-l-0 m-r-0 box-shadow ">
        <div class="col-md-12 container">
            <h4 class="card-title" style="padding:20px;">Upload Image for <?php echo $rs['nmt'];?></h4>
            <div class="row">
                <div class="col-md-5">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        Select image to upload:
                        <div class="form-group">
                            <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                            <input type="hidden" name="evt" value="<?php echo $_GET['evt']; ?>"/>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-outline-success" name="submit" value="Upload Image">
                        </div>
                    </form>
                </div>
                <div class="col-md-5"></div>
            </div>
        </div>

    </div>
    <?php

include_once("../../../includes/_ftr.php");


?>