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
include_once("../includes/_hd.php");
if(!isset($_GET["art_id"])){
    header('Location: ' . $uri."?error=invalid access detected");
    exit();
}else
    $id = func:: escape_data($dbc,$_GET['art_id']);
    $sql = "SELECT * FROM `h_pages` WHERE `id`='$id' ";
    $qry = mysqli_query($dbc, $sql);
if(mysqli_num_rows($qry) != 0) {

    $rs = mysqli_fetch_assoc($qry);

    $tittle = $rs['tittle'];
    $tpln = $rs['h_intro'];
    $post = $rs['h_post'];
    $ack = $rs['ackn'];
}else{
    echo "<script>alert('Article Not Found!')</script>";
            echo "<script>window.open('index.php?error=article-not-found!','_self')</script>";
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
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="create_article">
                                    <form action="save.php" method="post" id="edit">
                                        <div class="row">

                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section">
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="p_name"><i class="icon nalika-user" aria-hidden="true"></i></label>
                                                        <input type="text" name="p_name" id="p_name" <?php if(isset($tittle)){ ?>value=" <?php echo $tittle;} ?>" required class="form-control" placeholder="Article Tittle">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="tpln"><i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                        <textarea class="form-control" required name="p_intro" id="p_intro" ><?php if(isset($tpln)){  echo $tpln;} ?></textarea>
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
                                                                    ?><option value="<?php echo $rrs['id']?>" <?php if ($rs['h_cat'] == $rrs['id']){ echo 'selected="selected"';} ?>><?php echo $rrs['name'] ?></option><?php
                                                                }while($rrs = mysqli_fetch_assoc($cqry));
                                                            }
                                                            ?>
                                                        </select>
                                                        <input type="hidden" name="art_id" value="<?php echo $_GET['art_id']; ?>"/>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="p_data"><i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                        <textarea class="form-control" name="p_data" required id="p_data" rows="15" placeholder="Write Article Content"><?php if(isset($post)){  echo $post;} ?></textarea>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="ackn"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                                                        <input type="text" class="form-control" required name="ackn" <?php if(isset($ack)){ ?>value=" <?php echo $ack;} ?>"  id="ackn" placeholder="Article Acknowledgements">
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
        if (confirm("Are you sure you want to Cancel Article Editing?")) {
            window.open("../articles/", "_self");
        };
    }
</script>
