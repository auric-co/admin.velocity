<?php
require_once("../inclt/config.php");
require_once("../inclt/functions.php");

if(!func::checkLoginState($dbh)) {
   echo '<script> window.open("../../../admin.teamvelocity.co.zw","_self")</script>';
   exit();
}
include_once("../includes/_hd.php");

$error = "";
if (preg_match ('%^[0-9]{0,2}$%', stripslashes(trim($_POST['p_cat'])))) {

        $cat = func:: escape_data($dbc,$_POST['p_cat']);

    } else {

        $cat = FALSE;
        $error = '<div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Error!</strong>Invalid Category
                </div>';


    }
    $tittle = func:: escape_data($dbc,$_POST['p_name']);
    $ackn = func:: escape_data($dbc,$_POST['ackn']);
    $intro = $_POST['p_intro'];
    $h_post = $_POST['p_data'];
    $id = "v_article_".func::createString(6);
    $f = strtolower($tittle);
    $k = str_replace(" ", "_",$f);
    $m = str_replace(")", "",$k);
    $lnk = str_replace("(", "",$m);
    if($lnk && $id && $cat && $tittle && $intro && $h_post){
        $sql = "INSERT INTO `h_pages`(`id`, `lnk`, `post`, `main`, `tittle`, `h_intro`, `h_post`, `ackn`, `h_cat`, `img`, `dt`) VALUES ('$id', '$lnk', '0', '0', '$tittle', '$intro', '$h_post', '$ackn', '$cat', '', now())";
        $insert = mysqli_query($dbc, $sql);
        if ($insert) {
            echo "<script>alert('Article Successfully Created!')</script>";
            echo "<script>window.open('details.php?art_id=".$id."&utm_atc=crtd_le','_self')</script>";
        }else{
            echo "<script>alert('Article Not Created!')</script>";
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
                                <li class="active"><a href="#create_article"><i class="icon nalika-edit" aria-hidden="true"></i> Create New Article</a></li>
                            </ul>
                            <?php
                            if ($error) {
                                echo $error;
                            }//
                             ?>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="create_article">
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="add">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section">
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="p_name"><i class="icon nalika-user" aria-hidden="true"></i></label>
                                                        <input type="text" name="p_name" id="p_name" <?php if(isset($_POST['p_name'])){ ?>value=" <?php echo $_POST['p_name'];} ?>" required class="form-control" placeholder="Article Tittle">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="tpln"><i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                        <textarea class="form-control" required name="p_intro" id="p_intro" placeholder="Article Overview or Topline"><?php if(isset($_POST['h_post'])){  $_POST['h_post'];} ?></textarea>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="p_cat"><i class="icon nalika-favorites-button" aria-hidden="true"></i></label>
                                                        <select name="p_cat" id="p_cat" required class="form-control pro-edt-select form-control-primary">
                                                            <option value="opt1">Select Article Page</option>
                                                            <?php
                                                            $csql = "SELECT * FROM `h-pg_cat` WHERE 1";
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
                                                        <label class="input-group-addon" for="p_data"><i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                        <textarea class="form-control" name="p_data" required id="p_data" rows="8" placeholder="Write Article Content"><?php if(isset($_POST['p_data'])){  echo $_POST['p_data'];} ?></textarea>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="ackn"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                                                        <input type="text" class="form-control" name="ackn" <?php if(isset($_POST['ackn'])){ ?>value=" <?php echo $_POST['ackn'];} ?>" id="ackn" placeholder="Article Acknowledgements">
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
CKEDITOR.replace( 'p_data' );
    function formCancel() {
        event.preventDefault();
        if (confirm("Are you sure you want to discard changes?")) {
            document.getElementById("add").reset();
            if (confirm("Return to Articles?")) {
                window.open("../articles/", "_self");
            }
        };
    }
</script>
