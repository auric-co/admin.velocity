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
        <div class="single-product-tab-area mg-t-0 mg-b-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
						<div class="single-product-pr">
							<div class="row">
								<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
									<div id="myTabContent1" class="tab-content">
                                        <?php if(empty($rs['img'])){
                                            ?><a class="btn btn-primary center-block" href="<?php echo $uri;?>/dashboard/upload/image?evt=<?php echo $rs['ev_id']; ?>&utm_source=index4">Upload Event Image</a> <?php
                                        }else{ ?>
										<div class="product-tab-list tab-pane fade active in" id="single-tab1">
											<img src="http://teamvelocity.co.zw/wpv-content/2018/uploads/events/<?php echo $rs['img'];?>" alt="" />
										</div>
                                        <?php } ?>
									</div>
								</div>
								<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
									<div class="single-product-details res-pro-tb">
										<h1><?php echo $rs['nmt']; ?></h1>
										<ul class="list-inline">
											<li class="">
                                                <form action="post.php" method="post">
                                                    <input type="hidden" value="<?php echo $rs['ev_id']; ?>" name="evnt"/>
                                                    <?php
                                                    if($rs['post'] == 0){
                                                        echo '<input type="submit" value="POST" class="btn btn-success"/>';
                                                    }else{
                                                        echo '<input type="submit" value="DE-POST" class="btn btn-danger"/>';
                                                    }
                                                    ?>
                                                </form>
                                            </li>
											<li class=""><a href="<?php echo $uri;?>/dashboard/upload/image/update?evt=<?php echo $rs['ev_id']; ?>" class="btn btn-rounded btn-info">Change Image</a></li>
											<li class=""><a href="edit.php?evnt=<?php echo $rs['ev_id']; ?>" class="btn btn-rounded btn-success">Edit Event</a></li>
										</ul>
										<div class="single-pro-price">
											<span class="single-regular">$ <?php echo $rs['sub_fee']; ?></span>
										</div>
										<div class="single-pro-size">
											<h6>Date</h6>
											<p style="color: #fff"><?php echo date("M j,  Y", $dt); ?></p>
										</div>
                                        <div class="single-pro-size">
                                            <h6>Date</h6>
                                            <p style="color: #fff">Points: <?php echo $rs['pnt']; ?></p>
                                        </div>
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
										<div class="single-pro-cn">
											<h3>OVERVIEW</h3>
											<p><?php echo $rs['tpline']; ?></p>
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
										<li class="active"><a href="#description">description</a></li>
										<li><a href="#INFORMATION">INFORMATION</a></li>
									</ul>
									<div id="myTabContent" class="tab-content">
										<div class="product-tab-list product-details-ect tab-pane fade active in" id="description">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="review-content-section">
														<p> <?php echo nl2br($desc); ?></p>
													</div>
												</div>
											</div>
										</div>
										<div class="product-tab-list tab-pane fade" id="INFORMATION">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="review-content-section">
														<p>Info like venues, time and points etc, how much have registered get here</p>
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