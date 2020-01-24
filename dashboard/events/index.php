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
                            <h4>Velocity Events</h4>
                            <div class="add-product">
                                <a href="events-add.php">Add New Event</a>
                            </div>
                            <table>
                                <tr>
                                    <th>Image</th>
                                    <th>Event Title</th>
                                    <th>Status</th>
                                    <th>Registrations</th>
                                    <th>Date</th>
                                    <th>Price</th>
                                    <th>Setting</th>
                                    <th>Action</th>
                                </tr>
                                <?php
                                    func::events();
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