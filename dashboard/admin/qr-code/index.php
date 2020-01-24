<?php
require_once("../../inclt/config.php");
require_once("../../inclt/functions.php");

if(!func::checkLoginState($dbh)) {
   echo '<script> window.open("../../../admin.teamvelocity.co.zw","_self")</script>';
   exit();
}
include_once("../../includes/_hd.php");



 ?>
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
            <div class="col-md-6 col-md-6 col-sm-6 col-xs-12">
                <div class="text-center custom-login" style="color:#fff;">
                    <h3>QR Code Generator</h3>
                    <p>Generate event participation QR Code</p>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="generate.php" id="addAdmin" method="post">
                            <div class="row">

                                <div class="form-group col-lg-12">
                                    <label>Event</label>
                                    <select id="nmt" name="nmt" class="form-control">
                                    	<option>Select Event</option>
                                    <?php 
                                    $curl = curl_init();

									curl_setopt_array($curl, array(
									  CURLOPT_URL => "http://velocityapp-001-site1.atempurl.com/api/EventsApi/GetEvents",
									  CURLOPT_RETURNTRANSFER => true,
									  CURLOPT_ENCODING => "",
									  CURLOPT_MAXREDIRS => 10,
									  CURLOPT_TIMEOUT => 30,
									  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									  CURLOPT_CUSTOMREQUEST => "GET",
									  CURLOPT_POSTFIELDS => "",
									));

									$response = curl_exec($curl);
									$err = curl_error($curl);

									curl_close($curl);

									if ($err) {
									  echo '<option value="0">No Events Found</option>';
									} else {
									  // encode json oblect to array
										$data = json_decode($response, true);
										foreach ($data as $key) {
											echo '<option value="'.$key['EventID'].'">'.$key['Title'].'</option>';
										}
									}


                                    ?>
                                    </select>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>Unique Event Code</label>
                                    <input type="text" id="code" name="code" class="form-control"/>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Email also to</label>
                                    <input type="email" id="emtl" name="emtl" class="form-control">
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Password (<small>validate your action. only admins are allowed to generate QR Codes.</small>)</label>
                                    <input type="password" id="pd" name="pd" class="form-control">
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit"  class="btn btn-success loginbtn" value="Generate"/>
                                <input type="submit" onClick="formCancel()" class="btn btn-default" value="Cancel"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
        </div>
    </div>
<hr>
<?php 

include_once("../../includes/_ftr.php");

 ?>