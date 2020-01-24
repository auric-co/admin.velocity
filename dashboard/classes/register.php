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
                            <h4>Company - Activity:  Class Session Register</h4>
                            <div class="add-product">
                                <a href="">Add New Member</a>
                            </div>
                            <table id="reg_Table">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Member #</th>
                                        <th>Contact #</th>
                                        <th>Class Name - Session</th>
                                        <th>Attendance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr  style="color: #000;">
                                        <td  style="color: #000;">Nyandoro Christopher</td>
                                        <td>8983492788952</td>
                                        <td>263778512351</td>
                                        <td>FML Zumba - FML Zumba Class 1</td>
                                        <td>
                                            <a href="#" title="Yes" style="margin: 2px; border: 1px solid green; border-radius: 10px; padding: 5px;">
                                                <i class="fa fa-check text-success"></i> Yes
                                            </a>
                                            <a href="#" title="No" style="margin: 2px; border: 1px solid red; border-radius: 10px; padding: 5px;">
                                                <i class="fa fa-times text-danger"></i> No
                                            </a>
                                        </td>
                                        <td><a href="#members/single.php?memberID=">Read More..</a></td>
                                    </tr>
                                    <tr>
                                        <td>Nyandoro Christopher</td>
                                        <td>8983492788952</td>
                                        <td>263778512351</td>
                                        <td>FML Zumba - FML Zumba Class 1</td>
                                        <td>
                                            <a href="#" title="Yes" style="margin: 2px; border: 1px solid green; border-radius: 10px; padding: 5px;">
                                                <i class="fa fa-check text-success"></i> Yes
                                            </a>
                                            <a href="#" title="No" style="margin: 2px; border: 1px solid red; border-radius: 10px; padding: 5px;">
                                                <i class="fa fa-times text-danger"></i> No
                                            </a>
                                        </td>
                                        <td><a href="#members/single.php?memberID=">Read More..</a></td>
                                    </tr>
                                    <tr>
                                        <td>Nyandoro Christopher</td>
                                        <td>8983492788952</td>
                                        <td>263778512351</td>
                                        <td>FML Zumba - FML Zumba Class 1</td>
                                        <td>
                                            <a href="#" title="Yes" style="margin: 2px; border: 1px solid green; border-radius: 10px; padding: 5px;">
                                                <i class="fa fa-check text-success"></i> Yes
                                            </a>
                                            <a href="#" title="No" style="margin: 2px; border: 1px solid red; border-radius: 10px; padding: 5px;">
                                                <i class="fa fa-times text-danger"></i> No
                                            </a>
                                        </td>
                                        <td><a href="#members/single.php?memberID=">Read More..</a></td>
                                    </tr>
                                    <tr>
                                        <td>Nyandoro Christopher</td>
                                        <td>8983492788952</td>
                                        <td>263778512351</td>
                                        <td>FML Zumba - FML Zumba Class 1</td>
                                        <td>
                                            <a href="#" title="Yes" style="margin: 2px; border: 1px solid green; border-radius: 10px; padding: 5px;">
                                                <i class="fa fa-check text-success"></i> Yes
                                            </a>
                                            <a href="#" title="No" style="margin: 2px; border: 1px solid red; border-radius: 10px; padding: 5px;">
                                                <i class="fa fa-times text-danger"></i> No
                                            </a>
                                        </td>
                                        <td><a href="#members/single.php?memberID=">Read More..</a></td>
                                    </tr>
                                    <tr>
                                        <td>Nyandoro Christopher</td>
                                        <td>8983492788952</td>
                                        <td>263778512351</td>
                                        <td>FML Zumba - FML Zumba Class 1</td>
                                        <td>
                                            <a href="#" title="Yes" style="margin: 2px; border: 1px solid green; border-radius: 10px; padding: 5px;">
                                                <i class="fa fa-check text-success"></i> Yes
                                            </a>
                                            <a href="#" title="No" style="margin: 2px; border: 1px solid red; border-radius: 10px; padding: 5px;">
                                                <i class="fa fa-times text-danger"></i> No
                                            </a>
                                        </td>
                                        <td><a href="#members/single.php?memberID=">Read More..</a></td>
                                    </tr>
                                    
                                <tbody>

                            </table>
                            <!--<div class="custom-pagination">
								<ul class="pagination">
									<li class="page-item"><a class="page-link" href="#">Previous</a></li>
									<li class="page-item"><a class="page-link" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item"><a class="page-link" href="#">Next</a></li>
								</ul>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
 include_once("../includes/_ftr.php");


 ?>
 <script>
 $(document).ready( function () {
    $('#reg_Table').DataTable();
} );
 </script>