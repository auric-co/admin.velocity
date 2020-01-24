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
                        <h4>Homepage Slide Carousel</h4>
                        <div class="add-product">
                            <a href="add.php">Add New Slide</a>
                        </div>
                        <ul class="list-group row">
                            <?php 
                            $id = '';
                            $sql = "SELECT * FROM `slide` WHERE 1";
                            $qry = mysqli_query($dbc, $sql);
                            if(mysqli_num_rows($qry) != 0){
                                $rs = mysqli_fetch_assoc($qry);

                                do{

                                    $tbl = $rs['sl_table'];
                                    $id = $rs['sl_tb_id'];
                                    $img = $rs['img'];
                                    if($tbl == "h_pages" || "activitiz"){
                                        $id_tb = "id";
                                    }else{
                                        $id_tb = "ev_id";
                                    }
                                    $ssql = "SELECT * FROM ".$tbl." WHERE ".$id_tb."= '$id'";
                                    $qqry = mysqli_query($dbc, $ssql);
                                    $rrs = mysqli_fetch_assoc($qqry);

                                    switch ($tbl) {
                                        case $tbl == "h_pages":
                                            $nmt = $rrs['tittle'];
                                            $id = $rrs['id'];
                                            break;
                                        case $tbl == "evnt":
                                            $nmt = $rrs['nmt'];
                                            $id = $rrs['ev_id'];
                                            break;
                                        case $tbl == "activitiz":
                                            $nmt = $rrs['nmt'];
                                            $id = $rrs['id'];
                                            break;
                                        default:
                                            $lnk = $uri."/dashboard/slide-manager/?utm_err=slide-could-not-locate-item";
                                            //default link for non links
                                    }

                                    ?>
                                    <li class="list-group-item" style="margin: 10px !important; border-radius: 0; color: white; background-color: #1d2938; opacity: .8;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4><?php echo $nmt; ?></h4>
                                            </div>
                                            <div class="col-md-2">
                                                <p><img src="http://teamvelocity.co.zw/wpv-content/2018/uploads/imgs/sld/<?php echo $img; ?>" height="100" alt="Slide image" /></p>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                    <form action="post.php" method="post">
                                                        <input type="hidden" value="<?php echo $id; ?>" name="id"/>
                                                        <?php
                                                        if($rs['post'] == 0){
                                                            echo '<input type="submit" value="POST" class="btn btn-success"/>';
                                                        }else{
                                                            echo '<input type="submit" value="DE-POST" class="btn btn-danger"/>';
                                                        }
                                                        ?>
                                                    </form>
                                                 </li>
                                                    <li class="list-inline-item"><a href="delete.php?id=<?php echo $id;?>" class="btn btn-danger">Remove</a></li>
                                                    <li class="list-inline-item"><a href="active.php?id=<?php echo $id;?>" class="btn btn-info">Make Main</a></li>
                                                    <li class="list-inline-item"><a href="edit.php?id=<?php echo $id;?>" class="btn btn-warning">Edit</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <?php

                                }while($rs = mysqli_fetch_assoc($qry));
                            }
                            ?>
                        </ul>
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