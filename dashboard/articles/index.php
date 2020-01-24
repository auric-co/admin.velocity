<?php
require_once("../inclt/config.php");
require_once("../inclt/functions.php");

if(!func::checkLoginState($dbh)) {
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];
   header("location:".$uri);
   exit();
}
include_once("../includes/_hd.php");
require_once("../inclt/encrt/lib/password.php");

include_once("../includes/top_bar.php");
 ?>
        <div class="product-sales-area mg-tb-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <div class="product-sales-chart">
                            <div class="portlet-title">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="caption pro-sl-hd">
                                            <span class="caption-subject text-uppercase"><b>Velocity Articles</b></span>
                                        </div>
                                        <div class="add-product">
                                            <a href="add.php">Add New Article</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mg-t-30">
                                        <ul id="myTab3" class="tab-review-design">
                                            <li class="active"><a href="#nutrition"><i class="icon nalika-edit" aria-hidden="true"></i>Nutrition and Diet</a></li>
                                            <li><a href="#exercise"><i class="icon nalika-picture" aria-hidden="true"></i>Exercise/Fitness</a></li>
                                            <li><a href="#mentalwelbeing"><i class="icon nalika-chat" aria-hidden="true"></i> Mental Welbeing</a></li>
                                        </ul>
                                        <div id="myTabContent" class="tab-content custom-product-edit">
                                            <div class="product-tab-list tab-pane fade active in" id="nutrition">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="review-content-section">
                                                            <div class="card-block">
                                                                <ul class="list-group">
                                                                <?php
                                                                $id = 1;
                                                                $sle = "SELECT * FROM `h_pages` WHERE `h_cat` = '$id'";

                                                                $sqle = mysqli_query($dbc, $sle);
                                                                if(mysqli_num_rows($sqle) == 0){

                                                                    echo "<script>alert('No Articles for current Category , ".$_POST['pg']."!')</script>";


                                                                }else{
                                                                    $rse = mysqli_fetch_assoc($sqle);
                                                                    do{
                                                                       ?>
                                                                        <li class="list-group-item" style="margin: 10px !important; border-radius: 0; color: white; background-color: #1d2938; opacity: .8;">
                                                                            <div class="row">
                                                                                <div class="col-md-8">
                                                                                    <h4><?php echo $rse['tittle']; ?></h4>
                                                                                    <p><?php echo $rse['h_intro']; ?></p>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <p><img src="http://teamvelocity.co.zw/wpv-content/2018/uploads/imgs/articwBf5HC/<?php echo $rse['img']; ?>" height="50px"/></p>
                                                                                    <p><a  href="details.php?art_id=<?php echo $rse['id'];?>">Read More <i class="fa fa-arrow-circle-right"></i></a> </p>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <?php
                                                                    }while($rse = mysqli_fetch_assoc($sqle));
                                                                }
                                                                ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-tab-list tab-pane fade" id="exercise">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="review-content-section">
                                                            <div class="card-block">
                                                                <ul class="list-group">
                                                                    <?php
                                                                    $id = 2;
                                                                    $sle = "SELECT * FROM `h_pages` WHERE `h_cat` = '$id'";

                                                                    $sqle = mysqli_query($dbc, $sle);
                                                                    if(mysqli_num_rows($sqle) == 0){

                                                                        echo "<script>alert('No Articles for current Category , ".$_POST['pg']."!')</script>";


                                                                    }else{
                                                                        $rse = mysqli_fetch_assoc($sqle);
                                                                        do{
                                                                            ?>
                                                                            <li class="list-group-item" style="margin: 10px !important; border-radius: 0; color: white; background-color: #1d2938; opacity: .8;">
                                                                                <div class="row">
                                                                                    <div class="col-md-8">
                                                                                        <h4><?php echo $rse['tittle']; ?></h4>
                                                                                        <p><?php echo $rse['h_intro']; ?></p>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <img src="http://teamvelocity.co.zw/wpv-content/2018/uploads/imgs/articwBf5HC/<?php echo $rse['img']; ?>" height="50px"/>
                                                                                        <p><a  href="details.php?art_id=<?php echo $rse['id'];?>">Read More <i class="fa fa-arrow-circle-right"></i></a> </p>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <?php
                                                                        }while($rse = mysqli_fetch_assoc($sqle));
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-tab-list tab-pane fade" id="mentalwelbeing">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="review-content-section">
                                                            <div class="card-block">
                                                                <ul class="list-group">
                                                                    <?php
                                                                    $id = 3;
                                                                    $sle = "SELECT * FROM `h_pages` WHERE `h_cat` = '$id' ";

                                                                    $sqle = mysqli_query($dbc, $sle);
                                                                    if(mysqli_num_rows($sqle) == 0){

                                                                        echo "<script>alert('No Articles for current Category , ".$_POST['pg']."!')</script>";


                                                                    }else{
                                                                        $rse = mysqli_fetch_assoc($sqle);
                                                                        do{
                                                                            ?>
                                                                            <li class="list-group-item" style="margin: 10px !important; border-radius: 0; color: white; background-color: #1d2938; opacity: .8;">
                                                                                <div class="row">
                                                                                    <div class="col-md-8">
                                                                                        <h4><?php echo $rse['tittle']; ?></h4>
                                                                                        <p><?php echo $rse['h_intro']; ?></p>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <img src="http://teamvelocity.co.zw/wpv-content/2018/uploads/imgs/articwBf5HC/<?php echo $rse['img']; ?>" height="50px"/>
                                                                                        <p><a  href="details.php?art_id=<?php echo $rse['id'];?>">Read More <i class="fa fa-arrow-circle-right"></i></a> </p>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <?php
                                                                        }while($rse = mysqli_fetch_assoc($sqle));
                                                                    }
                                                                    ?>
                                                                </ul>
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
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="white-box analytics-info-cs mg-b-30 res-mg-t-30">
                            <h3 class="box-title">Total Visit</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash"></div>
                                </li>
                                <li class="text-right sp-cn-r"><i class="fa fa-level-up" aria-hidden="true"></i> <span class="counter sales-sts-ctn">8659</span></li>
                            </ul>
                        </div>
                        <div class="white-box analytics-info-cs mg-b-30">
                            <h3 class="box-title">Total Page Views</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash2"></div>
                                </li>
                                <li class="text-right"><i class="fa fa-level-up" aria-hidden="true"></i> <span class="counter sales-sts-ctn">7469</span></li>
                            </ul>
                        </div>
                        <div class="white-box analytics-info-cs mg-b-30">
                            <h3 class="box-title">Unique Visitor</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash3"></div>
                                </li>
                                <li class="text-right"><i class="fa fa-level-up" aria-hidden="true"></i> <span class="counter sales-sts-ctn">6011</span></li>
                            </ul>
                        </div>
                        <div class="white-box analytics-info-cs">
                            <h3 class="box-title">Bounce Rate</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash4"></div>
                                </li>
                                <li class="text-right"><i class="fa fa-level-down" aria-hidden="true"></i> <span class="sales-sts-ctn">18%</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="traffic-analysis-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="white-box tranffic-als-inner">
                            <h3 class="box-title"><small class="pull-right m-t-10 text-success last-month-sc cl-one"><i class="fa fa-sort-asc"></i> 18% last month</small> Site Traffic</h3>
                            <div class="stats-row">
                                <div class="stat-item">
                                    <h6>Overall Growth</h6>
                                    <b>80.40%</b></div>
                                <div class="stat-item">
                                    <h6>Montly</h6>
                                    <b>15.40%</b></div>
                                <div class="stat-item">
                                    <h6>Day</h6>
                                    <b>5.50%</b></div>
                            </div>
                            <div id="sparkline8"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="white-box tranffic-als-inner res-mg-t-30">
                            <h3 class="box-title"><small class="pull-right m-t-10 text-danger last-month-sc cl-two"><i class="fa fa-sort-desc"></i> 18% last month</small>Site Traffic</h3>
                            <div class="stats-row">
                                <div class="stat-item">
                                    <h6>Overall Growth</h6>
                                    <b>80.40%</b></div>
                                <div class="stat-item">
                                    <h6>Montly</h6>
                                    <b>15.40%</b></div>
                                <div class="stat-item">
                                    <h6>Day</h6>
                                    <b>5.50%</b></div>
                            </div>
                            <div id="sparkline9"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="white-box tranffic-als-inner res-mg-t-30">
                            <h3 class="box-title"><small class="pull-right m-t-10 text-success last-month-sc cl-three"><i class="fa fa-sort-asc"></i> 18% last month</small>Site Traffic</h3>
                            <div class="stats-row">
                                <div class="stat-item">
                                    <h6>Overall Growth</h6>
                                    <b>80.40%</b></div>
                                <div class="stat-item">
                                    <h6>Montly</h6>
                                    <b>15.40%</b></div>
                                <div class="stat-item">
                                    <h6>Day</h6>
                                    <b>5.50%</b></div>
                            </div>
                            <div id="sparkline10"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-sales-area mg-tb-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <div class="product-sales-chart">
                            <div class="portlet-title">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="caption pro-sl-hd">
                                            <span class="caption-subject text-uppercase"><b>Order Statistic</b></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="actions graph-rp">
                                            <a href="#" class="btn btn-dark-blue btn-circle active tip-top" data-toggle="tooltip" title="Upload">
                                                    <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                                </a>
                                            <a href="#" class="btn btn-dark btn-circle active tip-top" data-toggle="tooltip" title="Refresh">
                                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                                </a>
                                            <a href="#" class="btn btn-blue-grey btn-circle active tip-top" data-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="line-chart" class="flot-chart flot-chart-sts line-chart-statistic"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="analytics-rounded mg-b-30 res-mg-t-30">
                            <div class="analytics-rounded-content">
                                <h5>Percentage distribution</h5>
                                <h2><span class="counter">60</span>/20</h2>
                                <div class="text-center">
                                    <div id="sparkline51"></div>
                                </div>
                            </div>
                        </div>
                        <div class="analytics-rounded">
                            <div class="analytics-rounded-content">
                                <h5>Percentage division</h5>
                                <h2><span class="counter">150</span>/<span class="counter">54</span></h2>
                                <div class="text-center">
                                    <div id="sparkline52"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="author-area-pro">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="personal-info-wrap">
                            <div class="widget-head-info-box">
                                <div class="persoanl-widget-hd">
                                    <h2>Jon Royita</h2>
                                    <p>Founder of Uttara It Park</p>
                                </div>
                                <img src="img/notification/5.jpg" class="img-circle circle-border m-b-md" alt="profile">
                                <div class="social-widget-result">
                                    <span>100 Tweets</span> |
                                    <span>350 Following</span> |
                                    <span>610 Followers</span>
                                </div>
                            </div>
                            <div class="widget-text-box">
                                <h4>Jhon Royita</h4>
                                <p>To all the athaists attacking me right now, I can't make you believe in God, you have to have faith.</p>
                                <div class="text-right like-love-list">
                                    <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                    <a class="btn btn-xs btn-primary"><i class="fa fa-heart"></i> Love</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="author-widgets-single res-mg-t-30">
                            <div class="author-wiget-inner">
                                <div class="perso-img">
                                    <img src="img/notification/6.jpg" class="img-circle circle-border m-b-md" alt="profile">
                                </div>
                                <div class="persoanl-widget-hd persoanl1-widget-hd">
                                    <h2>Fire Foxy</h2>
                                    <p>Founder of Uttara It House</p>
                                </div>
                                <div class="social-widget-result social-widget1-result">
                                    <span>100 Tweets</span> |
                                    <span>350 Following</span> |
                                    <span>610 Followers</span>
                                </div>
                            </div>
                            <div class="widget-text-box">
                                <h4>Fire Foxy</h4>
                                <p>To all the athaists attacking me right now, I can't make you believe in God, you have to have faith.</p>
                                <div class="text-right like-love-list">
                                    <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                    <a class="btn btn-xs btn-primary"><i class="fa fa-heart"></i> Love</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="personal-info-wrap personal-info-ano res-mg-t-30">
                            <div class="widget-head-info-box">
                                <div class="persoanl-widget-hd">
                                    <h2>Jon Royita</h2>
                                    <p>Founder of Uttara It Park</p>
                                </div>
                                <img src="img/contact/2.jpg" class="img-circle circle-border m-b-md" alt="profile">
                                <div class="social-widget-result">
                                    <span>100 Tweets</span> |
                                    <span>350 Following</span> |
                                    <span>610 Followers</span>
                                </div>
                            </div>
                            <div class="widget-text-box">
                                <h4>Jhon Royita</h4>
                                <p>To all the athaists attacking me right now, I can't make you believe in God, you have to have faith.</p>
                                <div class="text-right like-love-list">
                                    <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                    <a class="btn btn-xs btn-primary"><i class="fa fa-heart"></i> Love</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="calender-area mg-tb-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="calender-inner">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php

include_once("../includes/_ftr.php")


?>