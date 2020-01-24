<?php 
session_start();
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];



?>
<!doctype html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard V.1 | Velocity Health</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="http://velocityhealth.co.za/images/icons/favicon.png">
    <!-- Google Fonts
        ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/font-awesome.min.css">
    <!-- nalika Icon CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/nalika-icon.css">
    <!-- owl.carousel CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/owl.theme.css">
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/owl.transitions.css">
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/animate.css">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/normalize.css">
    <!-- meanmenu icon CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/meanmenu.min.css">
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/modals.css">
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/main.css">
    <!-- morrisjs CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/calendar/fullcalendar.print.min.css">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/style.css">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/form/all-type-forms.css">
    <link rel="stylesheet" href="<?php echo $uri; ?>/dashboard/css/responsive.css">
    <!-- modernizr JS
        ============================================ -->
    <script src="<?php echo $uri; ?>/dashboard/js/vendor/modernizr-2.8.3.min.js"></script>
    <style>
   #reg_Table tbody tr td{
        color: #000 !important;
    }
    #reg_Table {
        color: #fff !important;
    }
    </style>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="<?php echo $uri; ?>/">
                    <img class="main-logo" src="http://velocityhealth.co.za/images/icons/logo.png" width="200px" alt="" />
                </a>
                <strong><img src="http://velocityhealth.co.za/images/icons/logo.png" width="100px" alt="" /></strong>
            </div>
            <div class="nalika-profile">
                <div class="profile-dtl">
                    <img src="<?php echo $uri; ?>/dashboard/img/notification/4.jpg" alt="" />
                </div>
            </div> 
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li class="active">
                            <a class="has-arrow" href="<?php echo $uri; ?>/dashboard/articles/" aria-expanded="false"><i class="fa fa-briefcase icon-wrap"></i> <span class="mini-click-non">Velocity Articles</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="View and Manage Articles" href="<?php echo $uri; ?>/dashboard/articles/"><span class="mini-sub-pro">Articles</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="<?php echo $uri; ?>/dashboard/disease-assistant/" aria-expanded="false"><i class="fa fa-medkit icon-wrap"></i> <span class="mini-click-non">Disease Assistant</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="View and Manage Disease Information" href="<?php echo $uri; ?>/dashboard/disease-assistant/"><span class="mini-sub-pro">Diseases</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="<?php echo $uri; ?>/dashboard/members/" aria-expanded="false"><i class="fa fa-user icon-wrap"></i> <span class="mini-click-non">Members</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Manage Subscriptions" href="<?php echo $uri; ?>/dashboard/members/"><span class="mini-sub-pro">Manage</span></a></li>
                                <li><a title="Manage Subscriptions" href="<?php echo $uri; ?>/dashboard/members/subscriptions/"><span class="mini-sub-pro">Subscriptions</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="<?php echo $uri; ?>/dashboard/partners/" aria-expanded="false"><i class="fa fa-diamond icon-wrap"></i> <span class="mini-click-non">Activity Classes </span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Manage Class Registers" href="<?php echo $uri; ?>/dashboard/classes/"><span class="mini-sub-pro">Class Registers</span></a></li>
                                <li><a title="Add New Partner" href="<?php echo $uri; ?>/dashboard/classes/add.php"><span class="mini-sub-pro">Add Class</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="<?php echo $uri; ?>/dashboard/partners/" aria-expanded="false"><i class="fa fa-diamond icon-wrap"></i> <span class="mini-click-non">Partners </span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Manage Partners" href="<?php echo $uri; ?>/dashboard/partners/"><span class="mini-sub-pro">Manage Partners</span></a></li>
                                <li><a title="Add New Partner" href="<?php echo $uri; ?>/dashboard/partners/add.php"><span class="mini-sub-pro">Add Partners</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="<?php echo $uri; ?>/dashboard/api/" aria-expanded="false"><i class="fa fa-gear icon-wrap"></i> <span class="mini-click-non">API</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="API" href="<?php echo $uri; ?>/dashboard/api/"><span class="mini-sub-pro">API</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-table icon-wrap"></i> <span class="mini-click-non">Miscellaneous</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Slide Manager" href="<?php echo $uri; ?>/dashboard/slide-manager/"><span class="mini-sub-pro">Slide Manager</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <!-- Remember to remove the variable folder when uploading to online server -->
                        <a href="<?php echo $uri; ?>/"><img class="main-logo" src="http://velocityhealth.co.za/images/icons/logo.png" width="150px" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n hd-search-rp">
                                            <div class="breadcome-heading">
                                                <form role="search" method="get" action="<?php echo $uri; ?>/dashboard/search">
                                                    <input type="text" name="q" placeholder="Search..." class="form-control">
                                                    <a type="submit" href=""><i class="fa fa-search"></i></a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                <li class="nav-item dropdown" style="margin-left:20px;">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                                        <span class="indicator-ms"></span>
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <div role="menu" class="author-message-top dropdown-menu animated zoomIn">
                                                        <div class="message-single-top">
                                                            <h1>Message</h1>
                                                        </div>
                                                        <ul class="notification-menu">
                                                            <li>
                                                                <a href="#">
                                                                    <div class="notification-icon">
                                                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="notification-content">
                                                                        <span class="notification-date">16 Sept</span>
                                                                        <h2>From Sender</h2>
                                                                        <p>Example message - done this project as soon possible.</p>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            
                                                        </ul>
                                                        <div class="message-view">
                                                            <a href="#">View All Messages</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li style="margin-left:25px;" class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                        Notifications<span class="indicator-nt"></span>
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <div role="menu" class="notification-author dropdown-menu animated zoomIn">
                                                        <div class="notification-single-top">
                                                            <h1>Notifications</h1>
                                                        </div>
                                                        <ul class="notification-menu">
                                                            <li>
                                                                <a href="#">
                                                                    <div class="notification-icon">
                                                                        <i class="fa fa-info" aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="notification-content">
                                                                        <span class="notification-date">16 Sept</span>
                                                                        <h2>Advanda Cro</h2>
                                                                        <p>Example notification - do this project as soon possible.</p>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            
                                                        </ul>
                                                        <div class="notification-view">
                                                            <a href="#">View All Notification</a>
                                                        </div>
                                                    </div>

                                                </li>
                                                <li style="margin-left:20px;" class="nav-item nav-setting-open"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"> News <i class="fa fa-angle-down"></i></a>

                                                    <div role="menu" class="admintab-wrap menu-setting-wrap menu-setting-wrap-bg dropdown-menu animated zoomIn">
                                                        <ul class="nav nav-tabs custon-set-tab">
                                                            <li class="active"><a data-toggle="tab" href="#Notes">News <i class="fa fa-angle-down"></i></a>
                                                            </li>
                                                            <li><a data-toggle="tab" href="#Projects">Activity</a>
                                                            </li>
                                                            <li><a data-toggle="tab" href="#Settings">Settings</a>
                                                            </li>
                                                        </ul>

                                                        <div class="tab-content custom-bdr-nt">
                                                            <div id="Notes" class="tab-pane fade in active">
                                                                <div class="notes-area-wrap">
                                                                    <div class="note-heading-indicate">
                                                                        <h2><i class="fa fa-chat"></i> Latest News</h2>
                                                                        <p>You have 10 New News.</p>
                                                                    </div>
                                                                    <div class="notes-list-area notes-menu-scrollbar">
                                                                        <ul class="notes-menu-list">
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/4.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/1.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/2.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/3.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/4.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/1.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/2.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/1.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/2.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="notes-list-flow">
                                                                                        <div class="notes-img">
                                                                                            <img src="img/contact/3.jpg" alt="" />
                                                                                        </div>
                                                                                        <div class="notes-content">
                                                                                            <p> The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                                                            <span>Yesterday 2:45 pm</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="Projects" class="tab-pane fade">
                                                                <div class="projects-settings-wrap">
                                                                    <div class="note-heading-indicate">
                                                                        <h2><i class="fa fa-info"></i> Recent Activity</h2>
                                                                        <p> You have 20 Recent Activity.</p>
                                                                    </div>
                                                                    <div class="project-st-list-area project-st-menu-scrollbar">
                                                                        <ul class="projects-st-menu-list">
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>New User Registered</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">1 hours ago</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>New Order Received</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">2 hours ago</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>New Order Received</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">3 hours ago</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>New Order Received</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">4 hours ago</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>New User Registered</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">5 hours ago</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>New Order</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">6 hours ago</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>New User</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">7 hours ago</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2>New Order</h2>
                                                                                            <p> The point of using Lorem Ipsum is that it has a more or less normal.</p>
                                                                                            <span class="project-st-time">9 hours ago</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="Settings" class="tab-pane fade">
                                                                <div class="setting-panel-area">
                                                                    <div class="note-heading-indicate">
                                                                        <h2><i class="fa fa-gear"></i> Settings Panel</h2>
                                                                        <p> You have 20 Settings. 5 not completed.</p>
                                                                    </div>
                                                                    <ul class="setting-panel-list">
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Show notifications</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                                                                                            <label class="onoffswitch-label" for="example">
                                                                                                    <span class="onoffswitch-inner"></span>
                                                                                                    <span class="onoffswitch-switch"></span>
                                                                                                </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Disable Chat</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                                                                                            <label class="onoffswitch-label" for="example3">
                                                                                                    <span class="onoffswitch-inner"></span>
                                                                                                    <span class="onoffswitch-switch"></span>
                                                                                                </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Enable history</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                                                                                            <label class="onoffswitch-label" for="example4">
                                                                                                    <span class="onoffswitch-inner"></span>
                                                                                                    <span class="onoffswitch-switch"></span>
                                                                                                </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Show charts</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                                                                                            <label class="onoffswitch-label" for="example7">
                                                                                                    <span class="onoffswitch-inner"></span>
                                                                                                    <span class="onoffswitch-switch"></span>
                                                                                                </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Update everyday</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" checked="" class="onoffswitch-checkbox" id="example2">
                                                                                            <label class="onoffswitch-label" for="example2">
                                                                                                    <span class="onoffswitch-inner"></span>
                                                                                                    <span class="onoffswitch-switch"></span>
                                                                                                </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Global search</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" checked="" class="onoffswitch-checkbox" id="example6">
                                                                                            <label class="onoffswitch-label" for="example6">
                                                                                                    <span class="onoffswitch-inner"></span>
                                                                                                    <span class="onoffswitch-switch"></span>
                                                                                                </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Offline users</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" name="collapsemenu" checked="" class="onoffswitch-checkbox" id="example5">
                                                                                            <label class="onoffswitch-label" for="example5">
                                                                                                    <span class="onoffswitch-inner"></span>
                                                                                                    <span class="onoffswitch-switch"></span>
                                                                                                </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="nav-item" style="margin-left:20px;">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                            <i class="fa fa-user"></i>
                                                            <span class="admin-name"><?php echo $_COOKIE['ad_name']; ?></span>
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <li><a href="<?php echo $uri; ?>/dashboard/account"><span class="fa fa-user author-log-ic"></span> My Profile</a>
                                                        </li>
                                                        <li><a href="<?php echo $uri; ?>/dashboard/account/settings/"><span class="fa fa-gear author-log-ic"></span> Settings</a>
                                                        </li>
                                                        <li><a href="<?php echo $uri; ?>/dashboard/sign-out/"><span class="fa fa-lock author-log-ic"></span> Log Out</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                        <li><a data-toggle="collapse" data-target="#others" href="#">Miscellaneous <span class="admin-project-icon fa fa-angle-down"></span></a>
                                            <ul id="others" class="collapse dropdown-header-top">
                                                <li><a href="<?php echo $uri; ?>/dashboard/articles/"><span class="mini-sub-pro">Articles</span></a></li>
                                                <li><a href="<?php echo $uri; ?>/dashboard/members"><span class="mini-sub-pro">Members</span></a></li>
                                                <li><a href="<?php echo $uri; ?>/dashboard/partners/"><span class="mini-sub-pro">Partners</span></a></li>
                                                <li><a href="<?php echo $uri; ?>/dashboard/disease-assistant/"><span class="mini-sub-pro">Disease Assistant</span></a></li>
                                                <li><a href="<?php echo $uri; ?>/dashboard/api/"><span class="mini-sub-pro">API</span></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu end -->
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="breadcomb-wp">
                                            <div class="breadcomb-icon">
                                                <i class="fa fa-home"></i>
                                            </div>
                                            <div class="breadcomb-ctn">
                                                <h2>Velocity Health</h2>
                                                <p>Welcome!</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control">

                                                        <option>Select Report</option>
                                                        <option value="1">Events Attendance</option>
                                                        <option value="2">Daily Events Attendance</option>
                                                        <option value="3">Member Subscription</option>
                                                        <option value="4">Events Registration</option>
                                                        <option value="5">Company Members Report</option>
                                                        <option value="6">App Download Report</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control">

                                                        <option>Select Month</option>
                                                        <option value="jan">January</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control">
                                                        <option>Select Year</option>
                                                        <option value="2018">2018</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="breadcomb-report">
                                                    <button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="fa fa-download"></i></button>
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