<?php
error_reporting(0);
		
class func{
	public static function checkLoginState($dbh){
			if(!isset($_SESSION)){
				session_start();
			}
			if(isset($_COOKIE['ad_id']) && isset($_COOKIE['ad_token']) && isset($_COOKIE['ad_serial'])){
				
				$userid = $_COOKIE['ad_id'];
				$token = $_COOKIE['ad_token'];
				$serial = $_COOKIE['ad_serial'];
				
				$query = "SELECT * FROM `admn_tb-ss` WHERE `ss_us_id` = :userid AND `ss_tkn` = :token AND `ss_srl` = :serial;";
				
				$stmt = $dbh ->prepare($query);
				$stmt->execute(array(':userid' =>$userid, ':token' =>$token, ':serial' =>$serial));
				
				$row = $stmt-> fetch(PDO::FETCH_ASSOC);
				
				if($row['ss_id'] >0){
					if(
					$row['ss_us_id'] == $_COOKIE['ad_id'] && 
					$row['ss_tkn'] == $_COOKIE['ad_token'] &&
					$row['ss_srl'] == $_COOKIE['ad_serial']
					
					)
					{
					if(
					$row['ss_us_id'] == $_SESSION['ad_id'] && 
					$row['ss_tkn'] == $_SESSION['ad_token'] &&
					$row['ss_srl'] == $_SESSION['ad_serial']
					)
					{
						return true;
					}else{
						func::deleteCookie();
                        header("location:".$uri."/?error=session-expired");
					}
				}
				
			}
			
		}

	}
	public static function escape_data ($dbc, $data) {

		if (function_exists('mysql_real_escape_string')) {
			$data = mysqli_real_escape_string ($dbc, trim($data));
			$data = strip_tags($data);
		} else {
			$data = mysqli_escape_string ($dbc, trim($data));
			$data = strip_tags($data);
		}	
		return $data;

	}

	public static function createRecord($dbh,$admin_name, $admin_id){
		
		
		
		$token = func:: createString(30);
		$serial = func:: createString(30);
		
		
		func:: createCookie($admin_name, $admin_id, $token, $serial);
		func:: createSession($admin_name, $admin_id, $token, $serial);
		$dt = date("d/m/Y");
		
		$query ="INSERT INTO `admn_tb-ss`(`ss_id`, `ss_us_id`, `ss_tkn`, `ss_srl`, `ss_dt`) VALUES ('',:admin_id,:token,:serial,:dt)";
		
		$dbh->prepare('DELETE FROM `admn_tb-ss` WHERE  `ss_us_id` = :sessions_userid;') ->execute(array(':sessions_userid' =>$admin_id));
		$stmt = $dbh -> prepare($query);
		$stmt->execute(array(':admin_id' =>$admin_id, ':token' => $token, ':serial' => $serial, ':dt' => $dt));
		
		
	}	
	public static function createCookie($admin_name, $admin_id, $token, $serial){
		setcookie('ad_id', $admin_id, time() + (86400) * 30, "/");
		setcookie('ad_name', $admin_name, time() + (86400) * 30, "/");
		setcookie('ad_token', $token, time() + (86400) * 30, "/");
		setcookie('ad_serial', $serial, time() + (86400) * 30, "/");
	}
	public static function deleteCookie(){
		setcookie('ad_id', '', time() -1, "/");
		setcookie('ad_name', '', time() -1, "/");
		setcookie('ad_token', '', time() -1, "/");
		setcookie('ad_serial', '', time() -1, "/");
		session_destroy();
	}
	public static function createSession($admin_name, $admin_id, $token, $serial){
		
		if(!isset($_SESSION)){
			session_start();
		}
		$_SESSION['ad_id'] = $admin_id;
		$_SESSION['ad_token'] = $token;
		$_SESSION['ad_serial'] = $serial;
		$_SESSION['ad_name'] = $admin_name;
		
    }
    public static function dateFormat($dt){
        return date("Y-m-d", strtotime($dt));
    }
    public static function timeFormat($tm){
        return date("H:i", strtotime($tm));
    }
	public static function createString($len){
		$string = "1qay2wsx3edc4rfv5tgb6zhn7ujm8ik9ollpAQWSXEDCVFRTGBNHYZUJMKILOP";
		
		return substr(str_shuffle($string), 0, $len);
	}
	
	public static function code($len){
		//$len here is the length of the string in-between the dashes
	return strtoupper(func::createString($len))."-".strtoupper(func::createString($len))."-".strtoupper(func::createString($len))."-".strtoupper(func::createString($len));
	
	}
	public static function admin_prev($admin){
		global $dbc;
		$sql = "SELECT `perm_lvl` FROM `admn_tb` WHERE `id`='$admin' ";
		$query = mysqli_query($dbc, $sql);
		if(mysqli_num_rows($query) == 1){
           $rs = mysqli_fetch_assoc($query);
		   return $rs['perm_lvl'];
		}else{
			die();
		}
	}
	public static function events(){
        global $dbc;
        $sql = "SELECT * FROM `evnt` ORDER BY `ev_id` DESC";
        $query = mysqli_query($dbc, $sql);
        $rs = mysqli_fetch_assoc($query);
            if(mysqli_num_rows($query) == 0){
                echo '<tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>No events found</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>';
            }else{
				?>
				<?PHP
            do {
                $dt = strtotime($rs['dt_st']);
                ?>
                <tr>
                    <td><img src="img/new-product/5-small.jpg" alt="" /></td>
                    <td><?php echo $rs['nmt'];  ?></td>
                    <td>
                        <form action="post.php" method="post">
                            <input type="hidden" value="<?php echo $rs['ev_id']; ?>" name="evnt"/>
                            <?php
                            if($rs['post'] == 0){
                                echo '<input type="submit" value="POST" class="pd-setting"/>';
                            }else{
                                echo '<input type="submit" value="DE-POST" class=" btn btn-danger"/>';
                            }
                            ?>
                        </form>

                    </td>
                    <td>
                        <?php
                        $ev_id = $rs['ev_id'];
                        $rsql = "SELECT * FROM `reg` WHERE `ev_id`='$ev_id'";
                        $rqry = mysqli_query($dbc, $rsql);
                        echo mysqli_num_rows($rqry)." users signed up";
                        ?>
                    </td>
                    <td><?php echo date("j F Y", $dt); ?></td>
                    <td>
                        <?php
                        $psql = "SELECT * FROM `reg_plans` WHERE `evnt`=".$rs['id'];
                        $pqry  = mysqli_query($dbc, $psql);
                        if(mysqli_num_rows($pqry) != 0){
                            // put the plans here, still to decide whether a list or what
                        }else{
                            echo "$".$rs['sub_fee'].".00";
                        }
                        ?>
                    </td>
                    <td>
                        <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </td>
                    <td><a href="details-events.php?evnt=<?php echo $rs['ev_id']; ?>&src=home">Read More <i class="fa fa-arrow-circle-right"></i> </a></td>
                </tr>

                <?php
                }while($rs=mysqli_fetch_assoc($query));
				?>
				<?php
            }
	}

	public static function members(){
        global $dbc;
        $sql = "SELECT * FROM `evnt` ORDER BY `ev_id` DESC";
        $query = mysqli_query($dbc, $sql);
        $rs = mysqli_fetch_assoc($query);
            if(mysqli_num_rows($query) == 0){
                echo '<tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>No events found</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>';
            }else{
				?>
				<?PHP
            do {
                $dt = strtotime($rs['dt_st']);
                ?>
                <tr>
                    
                    <td>First Name</td>
                    <td>
                        Surname
                    </td>
                    <td>email@domain.com</td>
                    <td>
                        Company Name
                    </td>
                    <td>89 Points</td>
                    <td>
                        Subscribed till 23/08/19
                    </td>
                    
                    <td>
                        <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        <button data-toggle="tooltip" title="Suspend" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </td>
                    <td><a href="details.php?member=<?php echo $rs['USID']; ?>&src=home">More <i class="fa fa-arrow-circle-right"></i> </a></td>
                </tr>

                <?php
                }while($rs=mysqli_fetch_assoc($query));
				?>
				<?php
            }
	}
	
	public static function regEmail($email, $pd){
		$mail = new PHPMailer();
		$mail->SMTPAuth = true;
		$mail->Username = admnEmt;
		$mail->Password = admnPD;
		$mail->SMTPSecure = "TLS"; //ssl
		$mail->Port = 587; //465

		$subject = "Velocity Health Online System Account";
        $mail->addAddress($email);
        $mail->setFrom(admnEmt);
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $body = "
        <h2 align='center'>Account Created</h2>
        <p>Your Velocity Health Portal Account has been created. Here are your login credentials</p>
        <p>Username/ Email: ".$email." <br/> Password: ".$pd."</p>
        <p>Welcome to Velocity Health!</p>
        <hr/>
        <p>Regards <br/> <span style='color: lime; font-style: italics; font-size: 16px; font-weight: 300;'>Admin</span>
        <hr/>
        <p style='margin: 0 auto;'>Copyright © Velocity Health ".date('Y')." </p>
        ";
        $mail->Body = $body;

        if ($mail->send()) {
        	return true;
        }else{
        	return false;
        }
			
	}


}



 ?>