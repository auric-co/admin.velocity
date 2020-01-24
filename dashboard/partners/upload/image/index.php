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
if(!isset($_GET['type'])){
    header("location:".$uri."/utm_error=invalid-access");
    exit();
}
if(!isset($_GET['ptn_id'])){
    header("location:".$uri."/utm_error=invalid-access");
    exit();
}

$id = func:: escape_data($dbc,$_GET['ptn_id']);

    $sle = "SELECT * FROM `patners` WHERE  `patners`.`id`='$id'";
    $sqle = mysqli_query($dbc, $sle);

    if(mysqli_num_rows($sqle) == 1){

        $rs=mysqli_fetch_assoc($sqle);

        if(func:: escape_data($dbc,$_POST['typ']) == "sml"){

            if($rs['img'] != "" ){
                echo "<script>alert('Partner already Has Image thumbnail!')</script>";
            }

        }elseif(func:: escape_data($dbc,$_POST['typ']) == "flsz"){
            
            if($rs['bg_img'] != "" ){
                echo "<script>alert('Partner already Has Image Fullsize Logo!')</script>";
            }

        }

        

    }else{
        echo "<script>alert('Partner Not Found!')</script>";
        echo "<script>window.open('".$uri."/dashboard?utm_atc=not-found&partner=".$id."','_self')</script>";
    }
include_once("../../../includes/_hd.php");

?>
<div class="product-status mg-b-30 mg-t-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>Upload Image for <?php echo $rs['nmt'];?></h4>
                            <div class="row">
                                <div class="col-md-5">
                                    <form action="../index.php" method="post" enctype="multipart/form-data">
                                        <span style="color: #fff">Select image to upload:</span>
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                                            <input type="hidden" name="ptn" value="<?php echo $_GET['ptn_id']; ?>"/>
                                            <input type="hidden" name="typ" value="<?php echo $_GET['type']; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-outline-success" name="submit" value="Upload Image">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-5"></div>
                            </div>
                            <ul style="color:orange">
                                <li><i style="font-size:20px;" class="fa fa-info-circle fa-spin"></i> Please take note that if Partner already has an image, the system will overwrite it, if have different names.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
<?php
include_once("../../../includes/_ftr.php");


?>