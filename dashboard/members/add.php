<?php


if (!isset($_GET['company']) || empty($_GET['company']) || $_GET['company'] == ""){
header("location:http://admin.velocityhealth.co.za/dashboard/members?error=company-not-set");
exit();
}

include_once("../includes/_hd.php");
require_once("../inclt/config.php");
require_once("../inclt/functions.php");

if(!func::checkLoginState($dbh)) {
    header('Location: ' . $uri . '/');
    exit();
}
$err = "";



if (isset($_POST['save'])){
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $msisdn = $_POST['msisdn'];
    $age = $_POST['age'];
    $company = $_POST['company'] ? $_POST['company'] : $_GET['company'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $bmi = $_POST['bmi'];
    $member_number = $_POST['member_no'];
    $request = json_encode(
        array(
            'email' => $email,
            'msisdn' => $msisdn,
            'name' => $name,
            'member_number' => $member_number,
            'surname' => $surname,
            'company' => $company,
            'age' => $age,
            'weight' => $weight,
            'height' => $height,
            'bmi' => $bmi
        ));
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.velocityhealth.co.za/admin/register/client/member",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS => $request,
        CURLOPT_HTTPHEADER => array(
            "content-type: application/json",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $data = json_decode($response, true);
    curl_close($curl);
    if ($err){
        $err = '<div class="alert alert-danger">
				 <a href="#" class="close" data-dismiss="alert">&times;</a>
				 <strong>Error!</strong> Connection error
			  </div>';
    }else{
        if ($data['success']){
            $err = '<div class="alert alert-success">
				 <a href="#" class="close" data-dismiss="alert">&times;</a>
				 <strong>Success!</strong> Member saved Successfully
			  </div>';
        }else{
            if (isset($data['error']['message'])){
                $err = '<div class="alert alert-danger">
                     <a href="#" class="close" data-dismiss="alert">&times;</a>
                     <strong>Error !</strong>'.$data['error']['message'].'
                  </div>';
            }else{
                echo  '<div class="alert alert-danger">
				 <a href="#" class="close" data-dismiss="alert">&times;</a>
				 <strong>Error!</strong> Error connecting to service. Please try again later
			  </div>';
            }

        }

    }

}

include_once("../includes/top_bar.php");
?>
    <div class="product-status mg-b-30 mg-t-15">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="review-tab-pro-inner">
                            <ul id="myTab3" class="tab-review-design">
                                <li class="active"><a href="#create_article"><i class="icon nalika-edit" aria-hidden="true"></i> Create New Class</a></li>
                            </ul>
                            <?php
                            if ($err !== '') {
                                echo $err;
                            }

                            ?>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="create_article">
                                    <form action="<?php echo $_SERVER['PHP_SELF'];?>?company=<?php echo $_GET['company']; ?>" method="post" id="add">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section">
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="c_name"><i class="fa fa-user" aria-hidden="true"></i></label>
                                                        <input type="hidden" name="company" value="<?php echo $_GET['company']; ?>" required>
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="name">Name:</label>
                                                        <input type="text" class="form-control" name="name" id="name" placeholder="First Name">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="surname">Surname:</label>
                                                        <input type="text" class="form-control" name="surname" id="surname" placeholder="Last Name">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="member_no">Member #:</label>
                                                        <input type="text" class="form-control" name="member_no" id="member_no" placeholder="Member Number">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="msisdn">Mobile:</label>
                                                        <input type="text" class="form-control" name="msisdn" id="msisdn" placeholder="Mobile Number">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="email">Email:</label>
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="age">Age:</label>
                                                        <input type="number" class="form-control" name="age" id="age" placeholder="Age">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="height">Height:</label>
                                                        <input type="text" class="form-control" name="height" id="height" placeholder="Height">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="dt_s">Weight:</label>
                                                        <input type="text" class="form-control" name="weight" id="weight" placeholder="Weight">
                                                    </div>
                                                    <div class="input-group mg-b-pro-edt">
                                                        <label class="input-group-addon" for="dt_e">To: </label>
                                                        <input type="text" class="form-control" name="bmi" placeholder="BMI results">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <input type="submit" name="save"  class="btn btn-ctl-bt waves-effect waves-light m-r-10" value="Save"/>
                                                    <button type="button" class="btn btn-ctl-bt waves-effect waves-light">Discard</button>
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