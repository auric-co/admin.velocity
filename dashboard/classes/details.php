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
   header('location'.$uri);
   exit();
}
include_once("../includes/_hd.php");
if(isset($_GET['class_id'])) {
    $id = func::escape_data($dbc, $_GET['class_id']);
    $sqll = "SELECT * FROM `classes` WHERE `id`='$id'";
    $query = mysqli_query($dbc, $sqll);
    if (mysqli_num_rows($query) == 0) {
        echo "<script>alert('Class Not Found')</script>";
            echo "<script>window.open('index.php?error=class-not-found','_self')</script>";
    } else
        $rs = mysqli_fetch_assoc($query);
         $desc = $rs['dsc'];

}
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
                                    <?php if(empty($rs['thumbn'])){
                                        ?><a class="btn btn-primary center-block" href="image/?class_id=<?php echo $rs['id']; ?>&utm_source=index4">Upload Article Image</a> <?php
                                    }else{ ?>
                                        <div class="product-tab-list tab-pane fade active in" id="single-tab1">
                                            <img src="http://teamvelocity.co.zw/wpv-content/2018/uploads/imgs/activities/classThumbnails/<?php echo $rs['thumbn'];?>" alt="" />
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                <div class="single-product-details res-pro-tb">
                                    <h1><?php echo $rs['tittle']; ?></h1>
                                    <ul class="list-inline">
                                        <li class="">
                                            <form action="post.php" method="post">
                                                <input type="hidden" value="<?php echo $rs['id']; ?>" name="art_id"/>
                                                <?php
                                                if($rs['post'] == 0){
                                                    echo '<input type="submit" value="POST" class="btn btn-success"/>';
                                                }else{
                                                    echo '<input type="submit" value="DE-POST" class="btn btn-danger"/>';
                                                }
                                                ?>
                                            </form>
                                        </li>
                                        <li class=""><a href="register.php?class_id=<?php echo $rs['id']; ?>" class="btn btn-rounded btn-warning">Mark Register</a></li>
                                        <li class=""><a href="image/?class_id=<?php echo $rs['id']; ?>" class="btn btn-rounded btn-info">Change Image</a></li>
                                        <li class=""><a href="edit.php?class_id=<?php echo $rs['id']; ?>" class="btn btn-rounded btn-success">Edit Class</a></li>
                                        <li class="">
                                            <form action="delete.php" method="post" id="deleteArt">
                                                <!-- should put confirmation on this button -->
                                                <input type="hidden" value="<?php echo $rs['id']; ?>" name="class_id"/>
                                                <input type="submit" value="Delete Class" class="btn btn-danger btn-rounded"/>
                                            </form> 
                                        </li>
                                        <!--<li class=""><a href="../slide-manager/make.php?id=<?php echo $rs['id']; ?>" class="btn btn-rounded btn-success">Add to Slide</a></li> -->
                                    </ul>
                                    <div class="color-quality-pro">
                                        <div class="clear"></div>
                                        <div class="single-social-area">
                                            <h3>Share this on</h3>
                                            <?php ?>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                            <a href="#"><i class="fa fa-feed"></i></a>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <div class="single-pro-cn">
                                        <h3>OVERVIEW</h3>
                                        <p><?php echo nl2br($desc) ?></p>
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
                                    <li class="active"><a href="#description">Sessions</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="product-tab-list product-details-ect tab-pane fade active in" id="description">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section" style="color: white !important;">
                                                    <form action="add_sess.php" method="post" id="add">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="review-content-section row">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="input-group mg-b-pro-edt">
                                                                                <label class="input-group-addon" for="sessionDT">Session Day</label>
                                                                                <select name="sessionDT" id="sessionDT" required class="form-control pro-edt-select form-control-primary">
                                                                                    <option>Select Day</option>
                                                                                    <option value="Sunday">Sunday</option>
                                                                                    <option value="Monday">Monday</option>
                                                                                    <option value="Tuesday">Tuesday</option>
                                                                                    <option value="Wednesday">Wednesday</option>
                                                                                    <option value="Thursday">Thursday</option>
                                                                                    <option value="Friday">Friday</option>
                                                                                    <option value="Saturday">Saturday</option>
                                                                                </select>
                                                                                <input type="hidden" name="class" value="<?php echo $_GET["class_id"]; ?>"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group mg-b-pro-edt">
                                                                                <label class="input-group-addon" for="sess_tm">Time</label>
                                                                                <input type="time" name="sess_tm" id="sess_tm"  class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="input-group mg-b-pro-edt">
                                                                                <label class="input-group-addon" for="sess_dur">Duration (# of hours)</label>
                                                                                <input type="number" name="sess_dur" id="sess_dur"  class="form-control">
                                                                            </div>
                                                                        </div>
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
                </div>
            </div>
        </div>
    </div>
<?php
include_once("../includes/_ftr.php");
?>
<script>
    function deleteArticle() {
        event.preventDefault();
        if (confirm("Are you want to delete this Article?")) {
            // post data to delete.php for deletion
        };
    }
</script>