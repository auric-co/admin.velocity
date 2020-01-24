<?php
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];
require_once("../../inclt/config.php");
require_once("../../inclt/functions.php");
if(!func::checkLoginState($dbh)) {
    
    echo '<script> window.open("'.$uri.'","_self")</script>';
    exit();
}
include_once("../../includes/_hd.php");
if(!isset($_GET['art_id'])){
    header("location:".$uri."/?utm_error=invalid-access");
    exit();
}else
    if (preg_match ('%[[:alnum:]\-\_]{10,}$%', stripslashes(trim($_GET['art_id'])))) {

        $id = func:: escape_data($dbc,$_GET['art_id']);
        $sle = "SELECT * FROM `h_pages` WHERE `h_pages`.`id`='$id'";
        $sqle = mysqli_query($dbc, $sle);
        if(mysqli_num_rows($sqle) == 1){
            $rs=mysqli_fetch_assoc($sqle);
        }else{
            echo "<script>alert('Article was not Found!')</script>";
            echo "<script>window.open('".$uri."/dashboard/articles/details.php?utm_atc=not-found&art_id=".$id."','_self')</script>";
        }
    }else{
        $id = FALSE;
        header("location:".$uri."/?utm_error=invalid-access");
        exit();
    }

    ?>
    <div class="product-status mg-b-30 mg-t-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>Upload Image for <?php echo $rs['nmt'];?></h4>
                            <div class="row">
                                <div class="col-md-5">
                                    <form action="upload.php" method="post" enctype="multipart/form-data">
                                        <span style="color: #fff">Select image to upload:</span>
                                        <div class="form-group">
                                            <input type="file" class="form-control" required name="fileToUpload" id="fileToUpload">
                                            <input type="hidden" name="art_id" value="<?php echo $_GET['art_id']; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-outline-success" name="submit" value="Upload Image">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-5"></div>
                            </div>
                            <ul style="color:orange">
                                <li><i style="font-size:20px;" class="fa fa-info-circle fa-spin"></i> Please take note that if Article already has an image, the system will overwrite it, if they have different names.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php

include_once("../../includes/_ftr.php");


?>