<?php 
require_once("../inclt/config.php");
require_once("../inclt/functions.php");
print_r($_POST);
echo "<hr>";


    if (preg_match ('%^[0-9]{0,2}$%', stripslashes(trim($_POST['p_cat'])))) {

        $cat = func:: escape_data($dbc,$_POST['p_cat']);

    } else {

        $cat = FALSE;


    }
    $tittle = func:: escape_data($dbc,$_POST['p_name']);
	$ackn = func:: escape_data($dbc,$_POST['ackn']);
	$intro = $_POST['p_intro'];
    $h_post = $_POST['p_data'];
    $id = "v_article_".func::createString(6);
    $f = strtolower($tittle);
    $k = str_replace(" ", "_",$f);
    $m = str_replace(")", "",$k);
    $lnk = str_replace("(", "",$m);
    if($lnk && $id && $cat && $tittle && $intro && $h_post && $ackn){
		$sql = "INSERT INTO `h_pages`(`id`, `lnk`, `post`, `main`, `tittle`, `h_intro`, `h_post`, `h_cat`, `img`, `dt`) VALUES ('$id', '$lnk', '0', '0', '$tittle', '$intro', '$h_post', '$cat', '', now())";
		$insert = mysqli_query($dbc, $sql);
		if ($insert) {
			echo "Is added";
		}else{
			echo mysqli_error($dbc);
		}
	}else{
		echo "Nothing";
	}
?>