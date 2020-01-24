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
    header('Location: ' . $uri . '/'.$folder);
    exit();
}
include_once("../includes/_hd.php");
include_once("../includes/top_bar.php");
?>
    <div class="product-status mg-b-30 mg-t-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Velocity Partners</h4>
                        <div class="add-product">
                            <a href="add.php">Add New Partner</a>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mg-t-30">
                                <ul id="myTab3" class="tab-review-design">
                                    <?php
                                    $cat_sql = "SELECT * FROM `partner_cat` WHERE 1";
                                    $cat_qry = mysqli_query($dbc, $cat_sql);
                                    if (mysqli_num_rows($cat_qry) != 0) {
                                        $cat_rw = mysqli_fetch_assoc($cat_qry);
                                        do {
                                            ?>
                                            <li class="<?php if ($cat_rw['id'] == 1) {echo "active";} ?>"><a href="#<?php echo $cat_rw['id'] ?>"><?php echo $cat_rw['name']; ?></a></li>
                                            <?php
                                        }while ( $cat_rw = mysqli_fetch_assoc($cat_qry));
                                    }

                                     ?>
                                </ul>

                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <?php
                                    $key_sql = "SELECT * FROM `partner_cat` WHERE 1";
                                    $key_qry = mysqli_query($dbc, $key_sql);
                                    if (mysqli_num_rows($key_qry) != 0) {
                                        $key = mysqli_fetch_assoc($key_qry);
                                        do {
                                            $id = $key['id'];
                                            $sle = "SELECT * FROM `patners` WHERE `cat` = '$id'";

                                            $sqle = mysqli_query($dbc, $sle);
                                            if(mysqli_num_rows($sqle) != 0){

                                                $rse = mysqli_fetch_assoc($sqle);
                                                do{
                                                    if ($rse['cat'] == $id) {
                                                     
                                                   ?>
                                                    <div class="product-tab-list tab-pane fade <?php if($rse['cat'] == 1){ echo "active";} ?> in" id="<?php echo $key['id']; ?>">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="review-content-section">
                                                                    <div class="card-block">
                                                                        <ul class="list-group">
                                                                            <li class="list-group-item" style="margin: 10px !important; border-radius: 0; color: white; background-color: #1d2938; opacity: .8;">
                                                                                <div class="row">
                                                                                    <div class="col-md-8">
                                                                                        <h4><?php echo $rse['nmt']; ?></h4>
                                                                                        <p><?php echo $rse['dsc']; ?></p>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <p><img src="http://teamvelocity.co.zw/wpv-content/2018/uploads/imgs/partners/<?php echo $rse['img']; ?>"/></p>
                                                                                        <p><a  href="details.php?ptn_id=<?php echo $rse['id'];?>">Read More <i class="fa fa-arrow-circle-right"></i></a> </p>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                }while($rse = mysqli_fetch_assoc($sqle));
                                            }else{
                                            ?>
                                            <div class="product-tab-list tab-pane fade <?php if($rse['cat'] == 1){ echo "active";} ?> in" id="<?php echo $key['id']; ?>">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="review-content-section">
                                                            <div class="card-block">
                                                                <ul class="list-group">
                                                                    <li class="list-group-item" style="margin: 10px !important; border-radius: 0; color: white; background-color: #1d2938; opacity: .8;">
                                                                        <div class="row">
                                                                            <div class="col-md-8">
                                                                                <h4>No Partners Found for Category <span style="color: red;"><?php echo $key['name']; ?></span></h4>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <p><img src="http://teamvelocity.co.zw/wpv-content/2018/" height="50px"/></p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                <?php
                                                
                                            }
                                            
                                            ?>
                                            
                                            <?php
                                        }while ( $key = mysqli_fetch_assoc($key_qry));

                                    }else{
                                        
                                    }

                                     ?>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="custom-pagination">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include_once("../includes/_ftr.php");


?>