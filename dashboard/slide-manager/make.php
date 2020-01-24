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

$target_dir = "../../public_html/wpv-content/2018/uploads/imgs/sld/";
$target_file = $target_dir . basename($_FILES["slide-img"]["name"]);
$uploadOk =1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(!isset($_GET["id"])){
	header("Location: ../articles?invalid");
	exit();
}

$id = func::escape_data($dbc, $_GET['id']);
$sql = "SELECT * FROM `h_pages` WHERE `id`='$id'";
$qry = mysqli_query($dbc, $sql);
$s_id = 0;
if(mysqli_num_rows($qry) == 1) {
	$csql = "SELECT * FROM `slide` WHERE `id`='$id'";
	$cql = mysqli_query($dbc, $csql);

	if(mysqli_num_rows($cql) != 0){

		header("Location: index.php?id=".$id."&error=already-on-slide");
		exit();
	}

	$s_id = $id;
}else{
	header("Location: ../articles?error=could not find article");
	exit();
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
                        <div id="myTabContent" class="tab-content custom-product-edit">
                            <div class="product-tab-list tab-pane fade active in" id="create_article">
                                <form action="save.php" method="post" enctype="multipart/form-data">
                                    <div class="input-group mg-b-pro-edt">
                                        <div class="caption pro-sl-hd">
                                            <span class="caption-subject text-uppercase"><b>
                                                <?php
                                                $ql = "SELECT * FROM `h_pages` WHERE `id`='$s_id'";
                                                $qy = mysqli_query($dbc, $ql);
                                                $rs = mysqli_fetch_assoc($qy);
                                                echo $rs['tittle'];
                                            ?>
                                            </b></span>
                                        </div>
                                    </div>
                                    <div class="input-group mg-b-pro-edt">
                                        <label class="input-group-addon" for="p_cat"><i class="icon nalika-favorites-button" aria-hidden="true"></i></label>
                                        <select name="p_cat" id="p_cat" required class="form-control pro-edt-select form-control-primary">
                                            <option value='h_pages'>Articles</option>
                                            <option value='activitiz'>Daily Activitiz</option>
                                            <option value='evnt'>Events</option>
                                        </select>
                                    </div>
                                    <span style="color: #fff">Select image to upload:</span>
                                    <div class="form-group">
                                        <input type="file" class="form-control" required name="fileToUpload" id="fileToUpload">
                                        <input type="hidden" name="art_id" value="<?php echo $s_id; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-outline-success" name="submit" value="Save">
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
    //show popup to confirm clear, then
    //now i have to clear all the fields,
    }
</script>
