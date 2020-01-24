<?php
include_once("../includes/_hd.php");
require_once("../inclt/config.php");
require_once("../inclt/functions.php");
if(!func::checkLoginState($dbh)) {
    header('Location: ' . $uri);
    exit();
}
if(isset($_GET['evnt'])) {
    $id = func::escape_data($dbc, $_GET['evnt']);
    $sqll = "SELECT * FROM evnt WHERE ev_id='$id'";
    $query = mysqli_query($dbc, $sqll);
    if (mysqli_num_rows($query) == 0) {
//use ajax in saving edited data
    } else {
        $rs = mysqli_fetch_assoc($query);
        $ddln = strtotime($rs['dt_ln']);
        $dt = strtotime($rs['dt_st']);
        $desc = $rs['dsc'];
    }
}else{
    header('location:../events?utm_err=no-event-id-found');
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
                                    <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i> Product Edit</a></li>
                                    <li><a href="#reviews"><i class="icon nalika-picture" aria-hidden="true"></i> Pictures</a></li>
                                    <li><a href="#INFORMATION"><i class="icon nalika-chat" aria-hidden="true"></i> Review</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="description">
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="review-content-section">
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="evnt_name"><i class="icon nalika-user" aria-hidden="true"></i></label>
                                                            <input type="text" name="evnt_name" id="evnt_name" <?php if(isset($rs['nmt'])){ ?>value=" <?php echo $rs['nmt'];} ?>" required class="form-control" placeholder="Event Name">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="dt_st"><i class="fa fa-calendar" aria-hidden="true"></i> Event Date</label>
                                                            <input type="text" class="form-control" id="dt_st" name="dt-st" <?php if(isset($rs['dt_st'])){ ?>value=" <?php echo $rs['dt_st'];} ?>" required title="Event Date">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="ddln"><i class="fa fa-calendar" aria-hidden="true"></i> Registration Deadline</label>
                                                            <input type="text"  class="form-control" id="ddln" name="ddln" <?php if(isset($rs['dt_ln'])){ ?>value=" <?php echo $rs['dt_ln'];} ?>" required placeholder="Deadline for Registration">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="tm_st"><i class="fa fa-clock-o" aria-hidden="true"></i> Start Time</label>
                                                            <input type="text" class="form-control" id="tm_st" required name="tm-st" <?php if(isset($rs['tm_st'])){ ?>value=" <?php echo $rs['tm_st'];} ?>" placeholder="Start Time">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i> End Time</label>
                                                            <input type="text" class="form-control" id="tm_end" name="tm-end" <?php if(isset($rs['tm_end'])){ ?>value=" <?php echo $rs['tm_end'];} ?>" required placeholder="Closing Time">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i> Registration Price</label>
                                                            <input type="text" class="form-control" name="sub_f" <?php if(isset($rs['sub_fee'])){ ?>value=" <?php echo $rs['sub_fee'];} ?>" required placeholder="Registration Price">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="tpln"><i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                            <textarea class="form-control" required name="tpln" id="tpln"  placeholder="Event Topline"> <?php if(isset($rs['tpline'])){  echo $rs['tpline'];} ?></textarea>
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="review-content-section">
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="evnt_cat"><i class="icon nalika-favorites-button" aria-hidden="true"></i></label>
                                                            <select name="evnt_cat" id="evnt_cat" required class="form-control pro-edt-select form-control-primary">
                                                                <option>Select Event Category</option>
                                                                <?php
                                                                $csql = "SELECT * FROM `evnt_cat` WHERE 1";
                                                                $cqry = mysqli_query($dbc, $csql);
                                                                if(mysqli_num_rows($cqry) != 0){
                                                                    $rrs = mysqli_fetch_assoc($cqry);
                                                                    do{
                                                                        ?><option value="<?php echo $rrs['evnt_cat_id']?>" <?php if ($rs['cat'] == $rrs['evnt_cat_id']){ echo 'selected="selected"';} ?>><?php echo $rrs['evnt_name'] ?></option><?php
                                                                    }while($rrs = mysqli_fetch_assoc($cqry));
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="event_dsc"><i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                            <textarea class="form-control" name="evnt_desc" required id="event_dsc" rows="8" placeholder="Event Description"><?php if(isset($rs['dsc'])){  echo $rs['dsc'];} ?></textarea>
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="vn"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                                                            <input type="text" class="form-control" required name="vn" <?php if(isset($rs['vn'])){ ?>value=" <?php echo $rs['vn'];} ?>" id="vn" placeholder="Venue">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="spons"><i class="icon nalika-like" aria-hidden="true"></i></label>
                                                            <input type="text" class="form-control" name="spons" id="spons" <?php if(isset($rs['spons'])){ ?>value=" <?php echo $rs['spons'];} ?>" placeholder="Primary Sponsor Partner">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="pnts"><i class="fa fa-diamond"></i></label>
                                                            <input type="text" class="form-control" required id="pnts" name="pnts" <?php if(isset($rs['pnt'])){ ?>value=" <?php echo $rs['pnt'];} ?>" placeholder="Event Points">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="text-center custom-pro-edt-ds">
                                                        <input type="submit" name="create" id="save"  class="btn btn-ctl-bt waves-effect waves-light m-r-10" value="Save"/>
                                                        <button type="button" class="btn btn-ctl-bt waves-effect waves-light">Discard</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="product-tab-list tab-pane fade" id="reviews">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="pro-edt-img">
                                                                <img src="img/new-product/5-small.jpg" alt="" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="product-edt-pix-wrap">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">TT</span>
                                                                            <input type="text" class="form-control" placeholder="Label Name">
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <div class="form-radio">
                                                                                    <form>
                                                                                        <div class="radio radiofill">
                                                                                            <label>
																									<input type="radio" name="radio"><i class="helper"></i>Largest Image
																								</label>
                                                                                        </div>
                                                                                        <div class="radio radiofill">
                                                                                            <label>
																									<input type="radio" name="radio"><i class="helper"></i>Medium Image
																								</label>
                                                                                        </div>
                                                                                        <div class="radio radiofill">
                                                                                            <label>
																									<input type="radio" name="radio"><i class="helper"></i>Small Image
																								</label>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="product-edt-remove">
                                                                                    <button type="button" class="btn btn-ctl-bt waves-effect waves-light">Remove
																							<i class="fa fa-times" aria-hidden="true"></i>
																						</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="pro-edt-img">
                                                                <img src="img/new-product/6-small.jpg" alt="" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="product-edt-pix-wrap">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">TT</span>
                                                                            <input type="text" class="form-control" placeholder="Label Name">
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <div class="form-radio">
                                                                                    <form>
                                                                                        <div class="radio radiofill">
                                                                                            <label>
																									<input type="radio" name="radio"><i class="helper"></i>Largest Image
																								</label>
                                                                                        </div>
                                                                                        <div class="radio radiofill">
                                                                                            <label>
																									<input type="radio" name="radio"><i class="helper"></i>Medium Image
																								</label>
                                                                                        </div>
                                                                                        <div class="radio radiofill">
                                                                                            <label>
																									<input type="radio" name="radio"><i class="helper"></i>Small Image
																								</label>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="product-edt-remove">
                                                                                    <button type="button" class="btn btn-ctl-bt waves-effect waves-light">Remove
																							<i class="fa fa-times" aria-hidden="true"></i>
																						</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="pro-edt-img mg-b-0">
                                                                <img src="img/new-product/7-small.jpg" alt="" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="product-edt-pix-wrap">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">TT</span>
                                                                            <input type="text" class="form-control" placeholder="Label Name">
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <div class="form-radio">
                                                                                    <form>
                                                                                        <div class="radio radiofill">
                                                                                            <label>
																									<input type="radio" name="radio"><i class="helper"></i>Largest Image
																								</label>
                                                                                        </div>
                                                                                        <div class="radio radiofill">
                                                                                            <label>
																									<input type="radio" name="radio"><i class="helper"></i>Medium Image
																								</label>
                                                                                        </div>
                                                                                        <div class="radio radiofill">
                                                                                            <label>
																									<input type="radio" name="radio"><i class="helper"></i>Small Image
																								</label>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="product-edt-remove">
                                                                                    <button type="button" class="btn btn-ctl-bt waves-effect waves-light">Remove
																							<i class="fa fa-times" aria-hidden="true"></i>
																						</button>
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
                                    <div class="product-tab-list tab-pane fade" id="INFORMATION">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section">
                                                    <div class="card-block">
                                                        <div class="text-muted f-w-400">
                                                            <p>No reviews yet.</p>
                                                        </div>
                                                        <div class="m-t-10">
                                                            <div class="txt-primary f-18 f-w-600">
                                                                <p>Your Rating</p>
                                                            </div>
                                                            <div class="stars stars-example-css detail-stars">
                                                                <div class="review-rating">
                                                                    <fieldset class="rating">
                                                                        <input type="radio" id="star5" name="rating" value="5">
                                                                        <label class="full" for="star5"></label>
                                                                        <input type="radio" id="star4half" name="rating" value="4 and a half">
                                                                        <label class="half" for="star4half"></label>
                                                                        <input type="radio" id="star4" name="rating" value="4">
                                                                        <label class="full" for="star4"></label>
                                                                        <input type="radio" id="star3half" name="rating" value="3 and a half">
                                                                        <label class="half" for="star3half"></label>
                                                                        <input type="radio" id="star3" name="rating" value="3">
                                                                        <label class="full" for="star3"></label>
                                                                        <input type="radio" id="star2half" name="rating" value="2 and a half">
                                                                        <label class="half" for="star2half"></label>
                                                                        <input type="radio" id="star2" name="rating" value="2">
                                                                        <label class="full" for="star2"></label>
                                                                        <input type="radio" id="star1half" name="rating" value="1 and a half">
                                                                        <label class="half" for="star1half"></label>
                                                                        <input type="radio" id="star1" name="rating" value="1">
                                                                        <label class="full" for="star1"></label>
                                                                        <input type="radio" id="starhalf" name="rating" value="half">
                                                                        <label class="half" for="starhalf"></label>
                                                                    </fieldset>
                                                                </div>
                                                                <div class="clear"></div>
                                                            </div>
                                                        </div>
                                                        <div class="input-group mg-b-15 mg-t-15">
                                                            <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                            <input type="text" class="form-control" placeholder="User Name">
                                                        </div>
                                                        <div class="input-group mg-b-15">
                                                            <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                                            <input type="text" class="form-control" placeholder="Last Name">
                                                        </div>
                                                        <div class="input-group mg-b-15">
                                                            <span class="input-group-addon"><i class="icon nalika-mail" aria-hidden="true"></i></span>
                                                            <input type="text" class="form-control" placeholder="Email">
                                                        </div>
                                                        <div class="form-group review-pro-edt mg-b-0-pt">
                                                            <button type="submit" class="btn btn-ctl-bt waves-effect waves-light">Submit</button>
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
        </div>
<?php
include_once("../includes/_ftr.php");


?>
<script>

</script>
