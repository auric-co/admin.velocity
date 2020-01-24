<?php
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];


require_once("../inclt/config.php");
require_once("../inclt/functions.php");
require_once("../inclt/encrt/lib/password.php");
if(!func::checkLoginState($dbh)) {
    header('Location: ' . $uri);
    exit();
}

if(isset($_POST['save'])){

    $nmt = func::escape_data($dbc, $_POST['name']);
    $class = func::escape_data($dbc, $_POST['cat']);
    $symptom = func::escape_data($dbc, $_POST['symptom']);
    $dsc = func::escape_data($dbc, $_POST['desc']);
    $ack = func::escape_data($dbc, $_POST['ack']);


    $insert = "INSERT INTO `diss_topic`(`id`, `title`, `dz_class`, `dsc`, `symptoms`,`ack`) VALUES ('','$nmt','$class','$dsc','$symptom','$ack')";

    $qry = mysqli_query($dbc, $insert);
    
    if($qry){

        echo "<script>alert('Disease Added successful!')</script>";
        echo "<script>window.open('../disease-assistant/?notif=disease-addedd','_self')</script>"; 
        
    }else{
        echo "<script>alert('Disease Failed to save')</script>";
        echo "<script>window.open('../disease-assistant?notif=failed to add'_self')</script>";
    }  

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
                        <ul id="myTab3" class="tab-review-design">
                            <li class="active"><a href="#create_event"><i class="icon nalika-edit" aria-hidden="true"></i>Save New Disease</a></li>
                        </ul>
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                if(!empty($error))
                                    echo $error; ?>
                            </div>
                        </div>
                        <div id="myTabContent" class="tab-content custom-product-edit">
                            <div class="product-tab-list tab-pane fade active in" id="create_event">
                                <form action="" method="post" id="add_d">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="input-group mg-b-pro-edt">
                                                    <label class="input-group-addon" for="name">Disease Name</label>
                                                    <input type="text" name="name" id="name" <?php if(isset($_POST['name'])){ ?>value=" <?php echo $_POST['name'];} ?>" required class="form-control">
                                                </div>                            
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="input-group mg-b-pro-edt">
                                                    <label class="input-group-addon" for="ptnr_cat">Disease Category</label>
                                                    <select name="cat" id="cat" required class="form-control pro-edt-select form-control-primary">
                                                        <option value="null">Select Disease Class</option>
                                                        <option value="0">Cat</option>
                                                    </select>
                                                </div>
                            
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="input-group mg-b-pro-edt">
                                                    <label class="input-group-addon" for="event_dsc"><i class="fa fa-info-circle" aria-hidden="true"></i> Description</label>
                                                    <textarea class="form-control" name="desc"  id="dsc" rows="8" placeholder="Disease Description"><?php if(isset($_POST['dsc'])){  echo $_POST['dsc'];} ?>
                                                    </textarea>
                                                </div>
                                                <div class="input-group mg-b-pro-edt">
                                                    <label class="input-group-addon" for="symptom"><i class="fa fa-ambulance" aria-hidden="true"></i> Symptoms</label>
                                                    <textarea  class="form-control" rows="5" id="symptom" name="symptom"><?php if(isset($_POST['symptom'])){  echo $_POST['symptom'];} ?></textarea>
                                                </div>
                                                <div class="input-group mg-b-pro-edt">
                                                    <label class="input-group-addon" for="ack">Acknowldgement</label>
                                                    <input type="text" class="form-control"   name="ack" id="ack" placeholder="Acknowledgements" <?php if(isset($_POST['ack'])){ echo 'value="'.$_POST["ack"].'"';} ?>>
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
<?php
include_once("../includes/_ftr.php");


?>
<script>
CKEDITOR.replace( 'dsc' );
CKEDITOR.replace( 'symptom' );
    function formCancel() {
        event.preventDefault();
        if (confirm("Are you sure you want to discard changes?")) {
            document.getElementById("add_d").reset();
            if (confirm("Return to Disease Assistant?")) {
                window.open("../disease-assistant/", "_self");
            }
        };
    }
</script>
