<?php
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];


require_once("../inclt/config.php");
require_once("../inclt/functions.php");
require_once("../inclt/encrt/lib/password.php");
if(!func::checkLoginState($dbh)) {
    header('Location: ' . $uri);
    exit();
}

if(isset($_POST['create'])){

    $ptn_name = func::escape_data($dbc, $_POST['name']);
    $ptnr_cat = func::escape_data($dbc, $_POST['ptnr_cat']);
    $ptn_web = func::escape_data($dbc, $_POST['web']); 
    $ptn_add = func::escape_data($dbc, $_POST['address']);
    $ptn_num = func::escape_data($dbc, $_POST['phone']);
    $ptn_desc = func::escape_data($dbc, $_POST['desc']);
    $ptn_emtl = func::escape_data($dbc, $_POST['emtl']);        
    $ptn_id = "ptn-00".rand(10,90);
    $lnk = str_replace(" ","_",strtolower($ptn_name));

    $insert = "INSERT INTO `patners`(`id`, `cat`, `class`, `nmt`, `img`, `bg_img`, `dsc`, `ptn_addr`, `ptn_mbl`, `ptn_emtl`, `ptn_url`, `lnk`) VALUES ('$ptn_id','$ptnr_cat','0','$ptn_name','','','$ptn_desc','$ptn_add','$ptn_num','$ptn_emtl','$ptn_web','$lnk')";
    

    $qry = mysqli_query($dbc, $insert);
    
    if($qry){

        echo "<script>alert('Partner Added successful!')</script>";
        echo "<script>window.open('../partners/?notif=partner-addedd','_self')</script>"; 
        
    }else{
        echo "<script>alert('Partner could not be added')</script>";
        echo "<script>window.open('../partners?notif=failed to add'_self')</script>";
    }  

}
include_once("../includes/_hd.php");

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
                            <li class="active"><a href="#create_event"><i class="icon nalika-edit" aria-hidden="true"></i>Register New Partner</a></li>
                        </ul>
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                if(!empty($error))
                                    echo $error; ?>
                            </div>
                        </div>
                        <div id="myTabContent" class="tab-content custom-product-edit">
                            <div class="product-tab-list tab-pane fade active in" id="create_event">
                                <form action="" method="post" id="add_p">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="input-group mg-b-pro-edt">
                                                    <label class="input-group-addon" for="name"><i class="icon nalika-user" aria-hidden="true"></i></label>
                                                    <input type="text" name="name" id="name" <?php if(isset($_POST['name'])){ ?>value=" <?php echo $_POST['name'];} ?>" required class="form-control" placeholder="Partner Name">
                                                </div>
                                                <div class="input-group mg-b-pro-edt">
                                                    <label class="input-group-addon" for="ptnr_cat"><i class="icon nalika-favorites-button" aria-hidden="true"></i></label>
                                                    <select name="ptnr_cat" id="ptnr_cat" required class="form-control pro-edt-select form-control-primary">
                                                        <option value="null">Select Partner Category</option>
                                                        <?php

                                                        $cat_sql = "SELECT * FROM partner_cat WHERE 1";
                                                        $cat_qry = mysqli_query($dbc, $cat_sql);
                                                        if (mysqli_num_rows($cat_qry) != 1) {
                                                            $cat_rw = mysqli_fetch_assoc($cat_qry);
                                                            do {
                                                                ?>
                                                                <option value="<?php echo $cat_rw['id'] ?>"><?php echo $cat_rw['name']; ?></option>
                                                                <?php
                                                            }while ( $cat_rw = mysqli_fetch_assoc($cat_qry));
                                                        }else{
                                                            echo '<option value="0">No Partner Category</option>';
                                                        }


                                                         ?>
                                                    </select>
                                                </div>
                                                <div class="input-group mg-b-pro-edt">
                                                    <label class="input-group-addon" for="web"><i class="fa fa-globe" aria-hidden="true"></i></label>
                                                    <input type="text" class="form-control" id="web" name="web" <?php if(isset($_POST['web'])){ ?>value=" <?php echo $_POST['web'];} ?>"  title="Web Url" placeholder="Partner Website URL">
                                                </div>
                                                <div class="input-group mg-b-pro-edt">
                                                    <label class="input-group-addon" for="address"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                                                    <textarea class="form-control"   name="address" id="address" placeholder="Partner Address"><?php if(isset($_POST['address'])){ echo $_POST['address'];} ?></textarea>
                                                </div>
                                                <div class="input-group mg-b-pro-edt">
                                                    <label class="input-group-addon" for="phone"><i class="icon nalika-like" aria-hidden="true"></i></label>
                                                    <input type="text" class="form-control" name="phone" id="phone" <?php if(isset($_POST['phone'])){ ?>value=" <?php echo $_POST['phone'];} ?>" placeholder="Partner Contact Phone Number">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="input-group mg-b-pro-edt">
                                                    <label class="input-group-addon" for="event_dsc"><i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                    <textarea class="form-control" name="desc"  id="dsc" rows="8" placeholder="Partner Description or Marketing Text"><?php if(isset($_POST['dsc'])){  echo $_POST['dsc'];} ?></textarea>
                                                </div>
                                                <div class="input-group mg-b-pro-edt">
                                                    <label class="input-group-addon" for="emtl"><i class="fa fa-envelope" aria-hidden="true"></i></label>
                                                    <input type="text" class="form-control"  name="emtl" <?php if(isset($_POST['emtl'])){ ?>value=" <?php echo $_POST['emtl'];} ?>" id="vn" placeholder="Partner Contact Person Email Address">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="text-center custom-pro-edt-ds">
                                                <input type="submit" name="create"  class="btn btn-ctl-bt waves-effect waves-light m-r-10" value="Create"/>
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
    function formCancel() {
        event.preventDefault();
        if (confirm("Are you sure you want to discard changes?")) {
            document.getElementById("add_p").reset();
            if (confirm("Return to Partners?")) {
                window.open("../partners/", "_self");
            }
        };
    }
</script>
