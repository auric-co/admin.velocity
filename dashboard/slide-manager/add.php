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

?>

<!-- Single pro tab start-->
<div class="single-product-tab-area mg-b-30">
    <!-- Single pro tab review Start-->
    <div class="single-pro-review-area">
        <div class="container-fluid">
            <div class="row">
            
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="review-tab-pro-inner">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="caption pro-sl-hd">
                                <span class="caption-subject text-uppercase"><b>Select Article</b><small></small></span>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <ul id="myTab3" class="tab-review-design">
                            <li class="active"><a href="#nutrition"><i class="icon nalika-edit" aria-hidden="true"></i>Nutrition and Diet</a></li>
                            <li><a href="#exercise"><i class="icon nalika-picture" aria-hidden="true"></i>Exercise/Fitness</a></li>
                            <li><a href="#mentalwelbeing"><i class="icon nalika-chat" aria-hidden="true"></i> Mental Welbeing</a></li>                        </ul>
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
                                                                                    <p><a  href="make.php?id=<?php echo $rse['id'];?>">Add to Slide <i class="fa fa-arrow-circle-right"></i></a> </p>
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
                                                                                        <p><a  href="make.php?id=<?php echo $rse['id'];?>">Add to Slide<i class="fa fa-arrow-circle-right"></i></a> </p>
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
                                                                                        <p><a  href="make.php?id=<?php echo $rse['id'];?>">Add to Slide <i class="fa fa-arrow-circle-right"></i></a> </p>
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
