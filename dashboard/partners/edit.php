<?php
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];
    
require_once("../inclt/config.php");
require_once("../inclt/functions.php");
if(!func::checkLoginState($dbh)) {
    header('Location: ' . $uri);
    exit();
}
if(!isset($_GET["ptn_id"])){
    //
}else

    $id = func:: escape_data($dbc,$_GET['ptn_id']);
    $sql = "SELECT * FROM `patners` WHERE `id`='$id'";
    $qry = mysqli_query($dbc, $sql);
if(mysqli_num_rows($qry) != 0) {

    $rs = mysqli_fetch_assoc($qry);

    $tittle = $rs['nmt'];
    $dsc = $rs['dsc'];
    $ptn_url = $rs['ptn_url'];
    $phn = $rs['ptn_mbl'];

    $emtl = $rs['ptn_emtl'];
    $addr = $rs['ptn_addr'];
}
if (isset($_POST['save'])) {

    $ptnerID = func::escape_data($dbc, $_POST['ptn_id']);
    $csql = "SELECT * FROM `patners` WHERE `id`='$ptnerID'";
    $cqry = mysqli_query($dbc, $csql);

    if(mysqli_num_rows($cqry) != 0) {

        $nmt = func::escape_data($dbc, $_POST['p_name']);
        $addr = func::escape_data($dbc, $_POST['addr']);
        $cat = func::escape_data($dbc, $_POST['p_cat']);
        $desc = func::escape_data($dbc, $_POST['p_data']);
        $phn = func::escape_data($dbc, $_POST['phn']);
        $ptn_emtl = func::escape_data($dbc, $_POST['emtl']);
        $web_url = func::escape_data($dbc, $_POST['url']);
        

        $sql = "UPDATE `patners` SET `cat`='$cat',`class`='0',`nmt`='$nmt',`dsc`='$desc',`ptn_addr`='$addr',`ptn_mbl`='$phn',`ptn_emtl`='$ptn_emtl',`ptn_url`= '$web_url' WHERE `id`= '$ptnerID'";
        $qry = mysqli_query($dbc, $sql);
        if ($qry) {

            echo '<script>alert("Patner updated information successfully saved")</script>';
            echo "<script>window.open('../partners/details.php?ptn_id=".$ptnerID."&utm_atc=information-saved-successfully','_self')</script>";
        }else{

            echo '<script>alert("Partner information saving failed. The patner has not been updated, please try again")</script>';
            echo "<script>window.open('../partners/details.php?ptn_id=".$ptnerID."&msg=failed-to-update-information','_self')</script>";
        
        }
    }else{

        echo '<script>alert("Editting Partner not found, please select a valid partner on the partners pages")</script>';
        echo '<script>window.open("../partners?error=choose-valid-partner","_self")</script>';
    
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
                                <li class="active"><a href="#create_article"><i class="icon nalika-edit" aria-hidden="true"></i> Create New Article</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="create_article">
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="edit">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section">
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="p_name"><i class="icon nalika-user" aria-hidden="true"></i></label>
                                                        <input type="text" name="p_name" id="p_name" <?php if(isset($tittle)){ echo 'value="'.$tittle.'"'; } ?> required class="form-control" placeholder="Partner name">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="tpln"><i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                        <textarea class="form-control"  name="addr" id="addr" ><?php if(isset($addr)){  echo $addr;} ?></textarea>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="p_cat"><i class="icon nalika-favorites-button" aria-hidden="true"></i></label>
                                                        <select name="p_cat" id="p_cat" required class="form-control pro-edt-select form-control-primary">
                                                            <option value="opt1">Select Partner Category</option>
                                                            <?php
                                                            $csql = "SELECT * FROM `partner_cat` WHERE 1";
                                                            $cqry = mysqli_query($dbc, $csql);
                                                            if(mysqli_num_rows($cqry) != 0){
                                                                $rrs = mysqli_fetch_assoc($cqry);
                                                                do{
                                                                    ?><option value="<?php echo $rrs['id']?>" <?php if ($rs['cat'] == $rrs['id']){ echo 'selected="selected"';} ?>><?php echo $rrs['name'] ?></option><?php
                                                                }while($rrs = mysqli_fetch_assoc($cqry));
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="p_data"><i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                        <textarea class="form-control" name="p_data"  id="p_desc" rows="15" placeholder="Write Partner Content"><?php if(isset($dsc)){  echo $dsc;} ?></textarea>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="phn"><i class="fa fa-phone" aria-hidden="true"></i></label>
                                                        <input type="text" class="form-control"  name="phn" <?php if(isset($phn)){ echo 'value="'.$phn.'"'; } ?> id="phn" placeholder="Partner Phone #">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="emtl"><i class="fa fa-mail" aria-hidden="true"></i></label>
                                                        <input type="text" class="form-control"  name="emtl" <?php if(isset($emtl)){ echo 'value="'.$emtl.'"'; } ?> id="emtl" placeholder="Partner Email Address">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="url"><i class="fa fa-website" aria-hidden="true"></i></label>
                                                        <input type="text" class="form-control"  name="url" <?php if(isset($ptn_url)){ echo 'value="'.$ptn_url.'"'; } ?> id="phn" placeholder="Partner Website URL ">
                                                        <input type="hidden" name="ptn_id" required value="<?php echo $_GET['ptn_id']; ?>" />
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <input type="submit" name="save" id="save"  class="btn btn-ctl-bt waves-effect waves-light m-r-10" value="Save"/>
                                                    <button type="button" onClick="formCancel()" class="btn btn-ctl-bt waves-effect waves-light">Discard</button>
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
        if (confirm("Are you sure you want to Cancel Editting this Partner Data")) {
            window.open("../partners/", "_self");
        };
    }
</script>
