<?php
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];



?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Password Recevery | Velocity Health</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="http://teamvelocity.co.zw/wpv-content/2018/img/favicon.png">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/owl.carousel.css">
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/owl.theme.css">
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/normalize.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/main.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/calendar/fullcalendar.print.min.css">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/form/all-type-forms.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="http://admin.teamvelocity.co.zw//dashboard/css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="http://admin.teamvelocity.co.zw//dashboard/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <div class="color-line"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="back-link back-backend">
                    <a href="http://admin.teamvelocity.co.zw//dashboard/" class="btn btn-primary">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-bottom: 200px;">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
            <div class="col-md-4 col-md-4 col-sm-4 col-xs-12">
                <div style="color: #fff;" class="text-center ps-recovered">
                    <h3>PASSWORD RECOVERY</h3>
                    <p>Please fill the form to recover your password</p>
                </div>
                <div class="hpanel">
                    <div class="panel-body poss-recover">
                        <p>
                            Enter your email address and your password will be reset and emailed to you.
                        </p>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="pdRecover">
                            <div class="form-group">
                                <label class="control-label" for="username">Email</label>
                                <input type="text" placeholder="example@gmail.com" title="Please enter you email adress" required="" value="" name="username" id="username" class="form-control">
                                <span class="help-block small">Your registered email address</span>
                            </div>

                            <button class="btn btn-success btn-block">Reset password</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
        </div>
    </div>
<?php

include_once("../dashboard/includes/_ftr.php")


?>