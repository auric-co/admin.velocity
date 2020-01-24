<?php
include_once("../includes/_hd.php");
require_once("../inclt/config.php");
require_once("../inclt/functions.php");
if(!func::checkLoginState($dbh)) {
    header('Location: ' . $uri);
    exit();
}
if(isset($_POST['create'])){
    $dt_st = $_POST['dt-st'];
    $tm_st = $_POST['tm-st'];
    $tm_end =$_POST['tm-end'];
    $ddln = $_POST['ddln'];
    $error ="";
    if (preg_match ('%^[A-Za-z0-9\.\' \-]{2,60}$%', stripslashes(trim($_POST['evnt_name'])))) {

        $evnmt = func:: escape_data($dbc,$_POST['evnt_name']);

    } else {

        $evnmt = FALSE;

        $error = '<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong>Please enter a Valid Event name. Name should start with capital letters and only alphabet and numerics, period and a single quote are allowed
				</div>';

    }
    if (preg_match ('%[A-Za-z0-9\+\.\' \-\(\)\%\:\<\>]{10,}$%', stripslashes(trim($_POST['evnt_desc'])))) {

        $evnt_desc = func:: escape_data($dbc,$_POST['evnt_desc']);

    } else {

        $evnt_desc = FALSE;

        $error .= '<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong>Please type a valid event description. No double quotes, semi colon, curly braces should be entered,
				</div>';

    }
    if (preg_match ('%[A-Za-z0-9\+\.\' \-\(\)\%]{10,}$%', stripslashes(trim($_POST['tpln'])))) {

        $tpl = func:: escape_data($dbc,$_POST['tpln']);

    } else {

        $tpl = FALSE;

        $error .= '<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong>Please enter a valid event Topline.
				</div>';

    }
    if (preg_match ('%^[A-Za-z0-9\.\' \-]{2,60}$%', stripslashes(trim($_POST['vn'])))) {

        $vn = func:: escape_data($dbc,$_POST['vn']);

    } else {

        $vn = FALSE;

        $error .= '<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong>Please enter a Valid Event name. Name should start with capital letters and only alphabet and numerics, period and a single quote are allowed.
				</div>';

    }
    if (preg_match ('%^[0-9]{1,5}$%', stripslashes(trim($_POST['pnts'])))) {

        $pnt = func:: escape_data($dbc,$_POST['pnts']);

    } else {

        $pnt = FALSE;

        $error .= '<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong>Points cannot contain more than 5 digits. Please enter valid Points value.
				</div>';

    }

    if (preg_match ('%^[0-9]{2,5}$%', stripslashes(trim($_POST['sub_f'])))) {

        $fee = func:: escape_data($dbc,$_POST['sub_f']);

    } else {

        $fee = FALSE;

        $error .= '<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong>Please enter valid event Fee in Dollars. Exclude the dollar sign.
				</div>';

    }

    if (preg_match ('%^[0-9]{0,2}$%', stripslashes(trim($_POST['evnt_cat'])))) {

        $cat = func:: escape_data($dbc,$_POST['evnt_cat']);

    } else {

        $cat = FALSE;

        $error .= '<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong>Something wrong with your category selection. Select again!
				</div>';

    }
    if(empty($error)){
        $ev_id="vhe".func::createString(10);
        $create = "INSERT INTO `evnt`(`ev_id`, `cat`, `eve_class`, `post`,`nmt`,`sub_fee`, `tpline`, `dsc`, `img`, `thumbn`,`dt_ln`, `dt_st`, `tm_st`, `tm_end`, `vn`, `pnt`) VALUES ('$ev_id','$cat', '', '','$evnmt', '$fee','$tpl','$evnt_desc','','', '$ddln','$dt_st','$tm_st','$tm_end','$vn','$pnt')";
        $db_insert = mysqli_query($dbc, $create);
        if($db_insert){
            //notify all users of event created via whatsap and text and or email when event is posted
            echo "<script>alert('Event Successfully Created!')</script>";
            echo "<script>window.open('index.php?utm_atc=crtd_le','_self')</script>";
        }else{
            echo "<script>alert('Something Went Wrong!')</script>";
            echo "<script>window.open('index-2.php?utm_atc=failed','_self')</script>";
        }
    }
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
                                    <li class="active"><a href="#create_event"><i class="icon nalika-edit" aria-hidden="true"></i> Create Event</a></li>
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
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="review-content-section">
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="evnt_name"><i class="icon nalika-user" aria-hidden="true"></i></label>
                                                            <input type="text" name="evnt_name" id="evnt_name" <?php if(isset($_POST['evnt_name'])){ ?>value=" <?php echo $_POST['evnt_name'];} ?>" required class="form-control" placeholder="Event Name">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="dt_st"><i class="fa fa-calendar" aria-hidden="true"></i> Event Date</label>
                                                            <input type="date" class="form-control" id="dt_st" name="dt-st" <?php if(isset($_POST['dt-st'])){ ?>value=" <?php echo $_POST['dt-st'];} ?>" required title="Event Date">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="ddln"><i class="fa fa-calendar" aria-hidden="true"></i> Registration Deadline</label>
                                                            <input type="date"  class="form-control" id="ddln" name="ddln" <?php if(isset($_POST['ddln'])){ ?>value=" <?php echo $_POST['ddln'];} ?>" required placeholder="Deadline for Registration">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="tm_st"><i class="fa fa-clock-o" aria-hidden="true"></i> Start Time</label>
                                                            <input type="time" class="form-control" id="tm_st" required name="tm-st" <?php if(isset($_POST['tm-st'])){ ?>value=" <?php echo $_POST['tm-st'];} ?>" placeholder="Start Time">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i> End Time</label>
                                                            <input type="time" class="form-control" id="tm_end" name="tm-end" <?php if(isset($_POST['tm-end'])){ ?>value=" <?php echo $_POST['tm-end'];} ?>" required placeholder="Closing Time">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i> Registration Price</label>
                                                            <input type="number" class="form-control" name="sub_f" <?php if(isset($_POST['sub_f'])){ ?>value=" <?php echo $_POST['sub_f'];} ?>" required placeholder="Registration Price">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="tpln"><i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                            <textarea class="form-control" required name="tpln" id="tpln" <?php if(isset($_POST['tpln'])){ ?>value=" <?php echo $_POST['tpln'];} ?>" placeholder="Event Topline"></textarea>
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="review-content-section">
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="evnt_cat"><i class="icon nalika-favorites-button" aria-hidden="true"></i></label>
                                                            <select name="evnt_cat" id="evnt_cat" required class="form-control pro-edt-select form-control-primary">
                                                                <option value="opt1">Select Event Category</option>
                                                                <?php
                                                                $get_cats = "SELECT * FROM evnt_cat";
                                                                $run_cats = mysqli_query($dbc, $get_cats);
                                                                if(mysqli_num_rows($run_cats) != 0){
                                                                    $row_cats = mysqli_fetch_array($run_cats);
                                                                    do{
                                                                        $cat_id = $row_cats['evnt_cat_id'];
                                                                        $cat_name = $row_cats['evnt_name'];
                                                                        ?>

                                                                        <option value='<?php echo $cat_id; ?>' <?php if (isset($_POST['evnt_cat'])){ if ($_POST['evnt_cat'] == $cat_id){ echo 'selected="selected"'; } } ?> ><?php echo  $cat_name;  ?></option>

                                                                        <?php
                                                                    }while($row_cats = mysqli_fetch_array($run_cats));
                                                                }

                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="event_dsc"><i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                            <textarea class="form-control" name="evnt_desc" required id="event_dsc" rows="8" placeholder="Event Description"><?php if(isset($_POST['event_dsc'])){  echo $_POST['event_dsc'];} ?></textarea>
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="vn"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                                                            <input type="text" class="form-control" required name="vn" <?php if(isset($_POST['vn'])){ ?>value=" <?php echo $_POST['vn'];} ?>" id="vn" placeholder="Venue">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="spons"><i class="icon nalika-like" aria-hidden="true"></i></label>
                                                            <input type="text" class="form-control" name="spons" id="spons" <?php if(isset($_POST['spons'])){ ?>value=" <?php echo $_POST['spons'];} ?>" placeholder="Primary Sponsor Partner">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <label class="input-group-addon" for="pnts"><i class="fa fa-diamond"></i></label>
                                                            <input type="text" class="form-control" required id="pnts" name="pnts" <?php if(isset($_POST['pnts'])){ ?>value=" <?php echo $_POST['pnts'];} ?>" placeholder="Event Points">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="text-center custom-pro-edt-ds">
                                                        <input type="submit" name="create"  class="btn btn-ctl-bt waves-effect waves-light m-r-10" value="Save"/>
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
    function formCancel() {
        event.preventDefault();
        //show popup to confirm clear, then
        //now i have to clear all the fields,
    }
</script>
