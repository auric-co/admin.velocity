<div class="section-admin container-fluid">
    <div class="row admin text-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="admin-content analysis-progrebar-ctn res-mg-t-15">

                        <?php
                        $msql = "SELECT * FROM `lgt` WHERE `actv`= '1' ";
                        $mqry = mysqli_query($dbc, $msql);
                        $count = mysqli_num_rows($mqry);
                        
                        $target = 10000;

                        $level = $count / $target;

                        $p = $level * 100;



                        ?>
                        <h4 class="text-left text-uppercase"><b>Members</b></h4>
                        <div class="row vertical-center-box vertical-center-box-tablet">
                            <div class="col-xs-3 mar-bot-15 text-left">
                                <label class="label bg-green"><?php echo $p;?>% <i class="fa fa-level-up" aria-hidden="true"></i></label>
                            </div>
                            <div class="col-xs-9 cus-gh-hd-pro">
                                <h2 class="text-right no-margin"><?php echo $count." of ".$target;?></h2>
                            </div>
                        </div>
                        <div class="progress progress-mini">
                            <div style="width: <?php echo $p; ?>%;" class="progress-bar bg-green"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-bottom:1px;">
                    <a href="<?php echo $uri; ?>/members/reports">
                        <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                            <h4 class="text-left text-uppercase"><b>Reports</b></h4>
                            <div class="row vertical-center-box vertical-center-box-tablet">
                                <div class="text-left col-xs-3 mar-bot-15">
                                    <label class="label bg-red">Manage Reports</label>
                                </div>
                                <div class="col-xs-9 cus-gh-hd-pro">
                                    <h2 class="text-right no-margin"><i class="fa fa-angle-right" aria-hidden="true"></i></h2>
                                </div>
                            </div>
                            <div class="progress progress-mini">
                                <div style="width: 100%;" class="progress-bar progress-bar-danger bg-red"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                        <h4 class="text-left text-uppercase"><b>Events Attendance</b></h4>
                        <div class="row vertical-center-box vertical-center-box-tablet">
                            <div class="text-left col-xs-3 mar-bot-15">
                                <label class="label bg-blue">Manage events Attendance Register</label>
                            </div>
                            <div class="col-xs-9 cus-gh-hd-pro">
                                <h2 class="text-right no-margin"><i class="fa fa-angle-right"></i></h2>
                            </div>
                        </div>
                        <div class="progress progress-mini">
                            <div style="width: 100%;" class="progress-bar bg-blue"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                        <h4 class="text-left text-uppercase"><b>Zumba attendances</b></h4>
                        <div class="row vertical-center-box vertical-center-box-tablet">
                            <div class="text-left col-xs-3 mar-bot-15">
                                <label class="label bg-purple">Manage Zumba Attendance Report</label>
                            </div>
                            <div class="col-xs-9 cus-gh-hd-pro">
                                <h2 class="text-right no-margin"><i class="fa fa-angle-right" aria-hidden="true"></i></h2>
                            </div>
                        </div>
                        <div class="progress progress-mini">
                            <div style="width: 100%;" class="progress-bar bg-purple"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>