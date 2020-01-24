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
if(isset($_POST['create'])){

    $ptn_name = func::escape_data($dbc, $_POST['name']);
    $ptnr_cat = func::escape_data($dbc, $_POST['ptnr_cat']);
    $ptn_web = func::escape_data($dbc, $_POST['web']); 
    $ptn_add = func::escape_data($dbc, $_POST['address']);
    $ptn_num = func::escape_data($dbc, $_POST['phone']);
    $ptn_desc= func::escape_data($dbc, $_POST['desc']);
    $ptn_emtl = func::escape_data($dbc, $_POST['emtl']);




    // Check if image file is a actual image or fake image
        

                $insert = "INSERT INTO `patners`(`cat`, `nmt`, `img`, `bg_img`, `dsc`, `ptn_addr`, `ptn_mbl`, `ptn_emtl`, `ptn_url`, `lnk`) VALUES ($ptnr_cat,'$ptn_name','','','$ptn_desc','$ptn_add','$ptn_num','$ptn_emtl','$ptn_web','$lnk')";
                $qry = mysqli_query($dbc, $insert);
                
                if($qry){

                    echo "<script>alert('Partner Added successful!')</script>";
                    echo "<script>window.open('../partners/?notif=partner-addedd','_self')</script>"; 
                    
                }else{
                    echo "<script>alert('Partner could not be added')</script>";
                    echo "<script>window.open('../partners?notif=failed to add'_self')</script>";
                }  

        



}




?>