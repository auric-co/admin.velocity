<?php
    require_once("../inclt/config.php");
    require_once("../inclt/functions.php");

    if(!func::checkLoginState($dbh)) {
    echo '<script> window.open("../../../admin.teamvelocity.co.zw","_self")</script>';
    exit();
    }
    include_once("../includes/_hd.php");

    $error = "";
    if (preg_match ('%^[0-9]{0,2}$%', stripslashes(trim($_POST['sess_dur'])))) {

        $dur = func:: escape_data($dbc,$_POST['sess_dur']);

    } else {
        $dur = FALSE;
        echo "<script>alert('Invalid Duration Input!')</script>";
        echo "<script>window.open('details.php?class_id=".$classID."&utm_atc=failed','_self')</script>";
    }
    
    $tm_s = func::timeFormat($_POST['sess_tm']);
    $day = func:: escape_data($dbc,$_POST['sessionDT']);
    $classID = func:: escape_data($dbc,$_POST['class']);
    $dt = ''; // create intervals 
    $tm_e = date('H:i',strtotime('+'.$dur.' hour',strtotime($tm_s))); //add duration
    if($day && $tm_s && $dur && $tm_e ){
        $fs = "SELECT * FROM `classes` WHERE `id`= '$classID'";
        $fqr = mysqli_query($dbc, $fs);
        if(mysqli_num_rows($fqr) != 0){
            $frs = mysqli_fetch_assoc($fqr);
            $step  = 1;
            $unit  = 'W';
            $start = new DateTime($frs['dt_s']);
            $end   = new DateTime($frs['dt_e']);

            $start->modify($day); // Move to first occurence

            $interval = new DateInterval("P{$step}{$unit}");
            $period   = new DatePeriod($start, $interval, $end);

            foreach ($period as $date) {
                $dt =  $date->format('Y-m-d');
                $sql = "INSERT INTO `class_sessions`(`id`, `classID`, `tm_s`, `tm_e`, `dt`) VALUES ('','$classID','$tm_s','$tm_e','$dt')";
                $insert = mysqli_query($dbc, $sql);
            }
            if ($insert) {
                echo "<script>alert('Class Successfully Created!')</script>";
                echo "<script>window.open('details.php?class_id=".$classID."&lastSession=".mysqli_insert_id($dbc)."&utm_atc=crtd_le','_self')</script>";
            }else{
                echo "<script>alert('Class Not Created!')</script>";
                echo "<script>window.open('details.php?class_id=".$classID."&utm_atc=failed','_self')</script>";
            }
        }
        
    }

?>

<div class="col md 6" style="margin:0 auto;">
    <i class="fa  fa-spinner fa-spin" style="font-size: 35px;"></i>
</div>
<?php include_once("../includes/_hd.php");