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
if(isset($_GET['ptn_id'])) {

    $id = func::escape_data($dbc, $_GET['ptn_id']);
    $sqll = "SELECT * FROM `patners` WHERE  `id`='$id'";
    $query = mysqli_query($dbc, $sqll);

    if (mysqli_num_rows($query) == 0) {
        echo "<script>alert('System error. Partner Not Found.')</script>";
        echo "<script>window.open('../partners?error=partner-not-found', '_self')</script>";
    }

    $rs = mysqli_fetch_assoc($query);
    $desc = $rs['dsc'];
    $overview = $rs['h_intro'];

}
include_once("../includes/_hd.php");
?>
    <!-- Single pro tab start-->
    <div class="single-product-tab-area mg-t-0 mg-b-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-product-pr">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                <div id="myTabContent1" class="tab-content">
                                    <?php if(empty($rs['img'])){
                                        ?><a class="btn btn-primary center-block" href="upload/image?type=sml&ptn_id=<?php echo $rs['id']; ?>">Upload Partner Logo Thumbnail</a> <?php
                                    }elseif(empty($rs['bg_img'])){
                                        ?>
                                        <a class="btn btn-primary center-block" href="upload/image?type=flsz&ptn_id=<?php echo $rs['id']; ?>">Upload Partner Full Size Logo</a>
                                        <?php
                                    }else{ ?>
                                        <div class="product-tab-list tab-pane fade active in" id="single-tab1">
                                            <img src="http://teamvelocity.co.zw/wpv-content/2018/uploads/imgs/partners/<?php echo $rs['bg_img'];?>" alt="" height="200px" />
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                <div class="single-product-details res-pro-tb">
                                    <h1><?php echo $rs['nmt']; ?></h1>
                                    <ul class="list-inline">
                                        <li class=""><a href="upload/image/?type=flsz&ptn_id=<?php echo $rs['id']; ?>" class="btn btn-rounded btn-info">Change Fullsize Logo</a></li>
                                        <li class=""><a href="upload/image/?type=sml&ptn_id=<?php echo $rs['id']; ?>" class="btn btn-rounded btn-info">Change Logo Thumbnail</a></li>
                                        <li class=""><a href="edit.php?ptn_id=<?php echo $rs['id']; ?>" class="btn btn-rounded btn-success">Edit Partner</a></li>
                                    </ul>
                                    <div class="color-quality-pro">
                                        <div class="clear"></div>
                                        <div class="single-social-area">
                                            <h3>Share this on</h3>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                            <a href="#"><i class="fa fa-feed"></i></a>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single pro tab End-->
    <!-- Single pro tab review Start-->
    <div class="single-pro-review-area mt-t-30 mg-b-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-tb-pr">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <ul id="myTab" class="tab-review-design">
                                    <li style="margin:5px;" class="active"><a href="#description">Description</a></li>
                                    <li style="margin:5px;"><a href="#INFORMATION">Contact Information</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="product-tab-list product-details-ect tab-pane fade active in" id="description">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section" style="color: white !important;">
                                                    <?php echo nl2br($desc); ?>
                                                </div>
                                                <hr>
                                                <div class="review-content-section" style="color: white !important;">
                                                    <div class="row">

                                                        <div class="col-md-12">
address here and telephone
                                                        </div>
                                                        <div class="col-md-12"> Website, email and </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-tab-list tab-pane fade" id="INFORMATION">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section">
                                                    <p>Info like when was it posted, has it ever been edited, when was it edited, who made it etc</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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