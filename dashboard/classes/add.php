<?php
require_once("../inclt/config.php");
require_once("../inclt/functions.php");

if(!func::checkLoginState($dbh)) {
   echo '<script> window.open("../../../admin.teamvelocity.co.zw","_self")</script>';
   exit();
}
include_once("../includes/_hd.php");

$error = "";
if (preg_match ('%^[0-9]{0,2}$%', stripslashes(trim($_POST['vn'])))) {

    $vn = func:: escape_data($dbc,$_POST['vn']);

} else {

    $vn = FALSE;
    $error = '<div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Error!</strong>Invalid Activity
            </div>';


}
if (preg_match ('%^[0-9]{0,2}$%', stripslashes(trim($_POST['activity'])))) {

        $activity = func:: escape_data($dbc,$_POST['activity']);

    } else {

        $activity = FALSE;
        $error = '<div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Error!</strong>Invalid Activity
                </div>';


    }
    $dt_s = func::dateFormat($_POST['dt_s']);
    $dt_e = func::dateFormat($_POST['dt_e']);
    $tittle = func:: escape_data($dbc,$_POST['c_name']);
    $desc = func:: escape_data($dbc,$_POST['c_data']);
    if($dt_s && $dt_e && $vn && $activity && $tittle && $desc){
        $sql = "INSERT INTO `classes`(`id`, `name`, `location`, `type`, `dt_s`, `dt_e`, `dsc`,`thumbn`, `actv`) VALUES ('','$tittle','$vn','$activity','$dt_s','$dt_e','$desc','','0')";
        $insert = mysqli_query($dbc, $sql);
        if ($insert) {
            echo "<script>alert('Class Successfully Created!')</script>";
            echo "<script>window.open('details.php?class_id=".mysqli_insert_id($dbc)."&utm_atc=crtd_le','_self')</script>";
        }else{
            echo "<script>alert('Class Not Created!')</script>";
            echo "<script>window.open('index.php?utm_atc=failed','_self')</script>";
        }
    }

?>
    <!-- Single pro tab start-->
    <div class="single-product-tab-area mg-b-30">
        <!-- Single pro tab review Start-->
        <div class="single-pro-review-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="review-tab-pro-inner">
                            <ul id="myTab3" class="tab-review-design">
                                <li class="active"><a href="#create_article"><i class="icon nalika-edit" aria-hidden="true"></i> Create New Class</a></li>
                            </ul>
                            <?php
                            if ($error) {
                                echo $error;
                            }//
                             ?>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="create_article">
                                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="add">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section">
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="c_name"><i class="fa fa-user" aria-hidden="true"></i></label>
                                                        <input type="text" name="c_name" id="c_name" <?php if(isset($_POST['c_name'])){ ?>value=" <?php echo $_POST['c_name'];} ?>" required class="form-control" placeholder="Class Tittle">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="activity"><i class="fa fa-buffer" aria-hidden="true"></i></label>
                                                        <select name="activity" id="activity" required class="form-control pro-edt-select form-control-primary">
                                                            <option value="opt1">Select Activitity</option>
                                                            <?php
                                                            $csql = "SELECT * FROM `activitiz` WHERE 1";
                                                            $cqry = mysqli_query($dbc, $csql);
                                                            if(mysqli_num_rows($cqry) != 0){
                                                                $rrs = mysqli_fetch_assoc($cqry);
                                                                do{
                                                                    echo '<option value="'.$rrs['id'].'">'.$rrs['nmt'].'</option>';
                                                                }while($rrs = mysqli_fetch_assoc($cqry));
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="dt_s">From:</label>
                                                        <input type="date" class="form-control" name="dt_s" <?php if(isset($_POST['dt_s'])){ ?>value=" <?php echo $_POST['dt_s'];} ?>" id="dt_s" placeholder="Start Date">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="dt_e">To: </label>
                                                        <input type="date" class="form-control" name="dt_e" <?php if(isset($_POST['dt_e'])){ ?>value=" <?php echo $_POST['dt_e'];} ?>" id="dt_e" placeholder="End Date">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="vn"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                                                        <select name="vn" id="vn" required class="form-control pro-edt-select form-control-primary">
                                                            <option>Select Location</option>
                                                            <?php
                                                            $csql = "SELECT * FROM `venues` WHERE 1";
                                                            $cqry = mysqli_query($dbc, $csql);
                                                            if(mysqli_num_rows($cqry) != 0){
                                                                $rrs = mysqli_fetch_assoc($cqry);
                                                                do{
                                                                    echo '<option value="'.$rrs['id'].'">'.$rrs['name'].'</option>';
                                                                }while($rrs = mysqli_fetch_assoc($cqry));
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="c_data"><i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                        <textarea class="form-control" name="c_data" required id="c_data" rows="8" placeholder="Class Information"><?php if(isset($_POST['c_data'])){  echo $_POST['c_data'];} ?></textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <input type="submit" name="save"  class="btn btn-ctl-bt waves-effect waves-light m-r-10" value="Save"/>
                                                    <button type="button" onclick="formCancel()" class="btn btn-ctl-bt waves-effect waves-light">Discard</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include_once("../includes/_ftr.php");


?>
<script>
CKEDITOR.replace( 'c_data' );
    function formCancel() {
        event.preventDefault();
        if (confirm("Are you sure you want to discard changes?")) {
            document.getElementById("add").reset();
            if (confirm("Return to Classes?")) {
                window.open("../classes/", "_self");
            }
        };
    }
</script>
