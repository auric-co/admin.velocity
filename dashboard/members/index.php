<?php
include_once("../includes/_hd.php");
require_once("../inclt/config.php");
require_once("../inclt/functions.php");

if(!func::checkLoginState($dbh)) {
    header('Location: ' . $uri . '/'.$folder);
    exit();
}
include_once("../includes/top_bar.php");
 ?>
        <div class="product-status mg-b-30 mg-t-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>Velocity Health Clients</h4>

                            <table>
                                <tr>
                                    
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Logo</th>
                                    <th></th>
                                </tr>
                                <?php

                                $curl = curl_init();
                                curl_setopt_array($curl, array(
                                    CURLOPT_URL => "http://api.velocityhealth.co.za/admin/clients",
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => "",
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 30,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => "GET",
                                    CURLOPT_POSTFIELDS => '',
                                    CURLOPT_HTTPHEADER => array(
                                        "content-type: application/json",
                                    ),
                                ));

                                $response = curl_exec($curl);
                                $err = curl_error($curl);
                                $data = json_decode($response, true);
                                curl_close($curl);
                                if ($err){

                                }else{
                                    if ($data['success']){
                                        foreach ($data['company'] as $key){
                                            ?>
                                <tr>
                                    <td><?php echo $key['id']; ?></td>
                                    <td>
                                        <?php echo $key['name']; ?>
                                    </td>
                                    <td><img style="width: 100px;" class=" rounded" src="http://clientzone.velocityhealth.co.za/images/client-photos/<?php echo $key['logo']; ?>" alt="" width="100"></td>
                                    <td>
                                        <a href="add.php?company=<?php echo $key['id'];?>">Add Members</a>
                                    </td>
                                </tr>
                                            <?php
                                        }

                                    }else{


                                    }

                                }


                                ?>
                            </table>
                            <div class="custom-pagination">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
 include_once("../includes/_ftr.php");


 ?>