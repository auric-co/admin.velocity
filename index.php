<?php
session_start();
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];

require_once("dashboard/inclt/config.php");
require_once("dashboard/inclt/functions.php");
require_once("dashboard/inclt/encrt/lib/password.php");

if(func::checkLoginState($dbh)){
	header('Location:'.$uri.'/dashboard/');
	exit();
}
if(isset($_POST['us-id']) && isset($_POST['pwd'])){
	
	
	if (preg_match ('%^[A-Za-z0-9._\%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$%', stripslashes(trim($_POST['us-id'])))) {

		$u = func:: escape_data($dbc, $_POST['us-id']);

	} else {

		$u = FALSE;

		$err = '<div class="alert alert-danger">
				 <a href="#" class="close" data-dismiss="alert">&times;</a>
				 <strong>Error!</strong> Please enter a valid email address
			  </div>';

	}

	if (preg_match ('%^[A-Za-z0-9]\S{8,20}$%', stripslashes(trim($_POST['pwd'])))) {

		$p = func:: escape_data($dbc, $_POST['pwd']);

	} else {

		$p = FALSE;

		$err = '<div class="alert alert-danger">
				 <a href="#" class="close" data-dismiss="alert">&times;</a>
				 <strong>Error!</strong> Please enter a valid Password
			  </div>';

	}
	
	
	if($u && $p){
	
		$sql = "SELECT COUNT(*) FROM admn_tb WHERE `emtl` = '$u'";
		if ($res = $dbh->query($sql)) {

			if ($res->fetchColumn() == 1) {
				
				$query="SELECT * FROM admn_tb WHERE emtl = :username";
				$stmt = $dbh ->prepare($query);
				$stmt->execute(array(':username' =>$u));

				$row = $stmt-> fetch(PDO::FETCH_ASSOC);

				$hash = $row['pwd'];

				$options = array('cost' => 11);

				if (password_verify($p, $hash)) {
				
					if (password_needs_rehash($hash, PASSWORD_DEFAULT, $options)) {

							$newHash = password_hash($p, PASSWORD_DEFAULT, $options);
							$sql = "UPDATE admn_tb SET `pwd`='$newHash' WHERE emtl='$u'";
							$db_insert = mysqli_query($dbc, $sql);
						}
						
						func::createRecord($dbh, $row['nmt'], $row['id']);
						header('Location:'.$uri.'/dashboard/');
						exit();
					
					
				}else{
						$err = '<div class="alert alert-danger">
						 <a href="#" class="close" data-dismiss="alert">&times;</a>
						 <strong>Error!</strong> Invalid Login Input!
					  </div>';
				}
			}else{
				$err = '<div class="alert alert-danger">
				 <a href="#" class="close" data-dismiss="alert">&times;</a>
				 <strong>Error!</strong> Please check Your Login Input!
			  </div>';
			}
		}
	}
}

$res = null;
$dbh = null;
	

?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="Chris Nyandoro">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="http://velocityhealth.co.za/images/icons/favicon.png">


    <title>Velocity Health</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <link href="dashboard/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="dashboard/css/bootstrap.min.css" rel="stylesheet">
    <link href="dashboard/css/login.css" rel="stylesheet">

    <noscript>Sorry, your browser does not support JavaScript! When you have JavaScript disabled, please enable it.</noscript>

</head>
  <body id="login" class="text-center">
	<div class="header">
		<h1><img src="http://velocityhealth.co.za/images/icons/logo.png" height="80" />Velocity Health</h1>
	</div>
	<div class="main-content-agile">
		<div class="sub-main">	
			<?PHP
	        if(!empty($err)){
	            echo $err;
	        }
	        ?>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<input type="email" placeholder="Email" id="inputEmail" name="us-id" autocomplete="email" class="user" required=""><br>
				<input type="password" id="inputPassword" name="pwd" placeholder="Password" name="Password" class="pass" required=""><br>
				<input type="submit" value="">
			</form>
			<p><a href="account-recovery">Forgot Password</a></p>
		</div>
	</div>
	<div class="footer">
		<p>&copy; <?php echo date("Y") ?> Velocity Health</p>
	</div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="dashboard/inclt/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="dashboard/inclt/assets/js/vendor/popper.min.js"></script>
    <script src="dashboard/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  </body>
</html>
