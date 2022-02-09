<?php 
session_start();

if (isset($_GET['language'])) {
	if ($_SESSION['language'] = addslashes(strtolower($_GET['language']))) {
		if (isset($_GET['next'])) {
			header("Location: $_GET[next]");
		}else{
			header("Location: /");
		}
	}
}
$l = 'en';
if (isset($_SESSION['language'])) {
	$l = $_SESSION['language'];
}

$_SESSION['site_name'] = "Books Store";
$site_currency_icon = '<i class="fas fa-euro-sign"></i>';
$site_currency_name = "EURO";
$ext_url = urlencode($_SERVER['REQUEST_URI']);


$connect = connect();
$error = "";
if (isset($_SESSION['user_id'])) {
	$user_data = user($_SESSION['user_id']);
}else{
	$user_data = false;
}

function connect(){
	$DB_HOST = "localhost";
	$DB_USER = "root";
	$DB_PASS = "";
	$DB_NAME = "project_27";
	$CONNECT = @mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	return $CONNECT;
}


function t($id = 1){
	global $connect;
	$result = array();
	$sql = "SELECT * FROM `translations` WHERE `id` = '$id' LIMIT 1";
	$query = mysqli_query($connect, $sql);
	foreach ($query as $key) {
		unset($key['id']);
		$result = $key;
	}
	return $result;
}



function site_info($value= null)
{
	if ($value == null) {
		return false;
	}
	global $connect;
	$value = strtolower(addslashes($value));
	$sql = "SELECT * FROM `site_info` WHERE `name` = '".$value."'";
	$query = mysqli_query($connect, $sql);
	$ret = false;
	foreach ($query as $key) {
		$ret = $key['details'];
	}
	return $ret;
}

function orders($add = null)
{
	global $connect;
	$result = array();
	foreach (mysqli_query($connect, "SELECT * FROM `orders` $add ORDER BY `id` DESC, `status` DESC") as $values) {
		$result[] = $values;
	}
	return $result;
}

function payments($add = null)
{
	global $connect;
	$result = array();
	foreach (mysqli_query($connect, "SELECT * FROM `payment` $add ORDER BY `id` DESC, `txn_id` DESC") as $values) {
		$result[] = $values;
	}
	return $result;
}

function products($add = null){
	global $connect;
	if ($add == null) {
		$add = "";
	}
	$result = array();
	$sql = mysqli_query($connect, "SELECT * FROM `products` $add ORDER BY `products`.`id` DESC");
	foreach ($sql as $key) {
		$key['pics'] = explode("\n", $key['pics']);
		$result[] = $key;
	}
	return $result;
}

function send_code(){
	global $connect;global $user_data;
	$user_data = user($_SESSION['user_id']);
	if (isset($_SESSION['user_id']) && isset($user_data['id']) && $user_data['status'] != "VERIFIED") {
		$message = "Your verfication code for ".$_SESSION['site_name']." is <b>".$user_data['status']."</b>";
		return sent_mail($user_data['email'], $user_data['fname'], $message, "Verfication Code");
	}else{
		return false;
	}
	
}

function productReviews($product_id = null)
{
	global $connect;
	$result = array();
	if ($product_id != null) {
		$query = mysqli_query($connect, "SELECT * FROM `orders` WHERE `review_user` != '' AND `product_id` = '$product_id' ORDER BY `id` DESC");
		if (mysqli_num_rows($query) > 0) {
			$int = 0;
			foreach ($query as $key) {
				$result[$int]['user_id'] = $key['user_id'];
				$result[$int]['review'] = $key['review_star'];
				$result[$int]['review_user'] = $key['review_user'];
				$result[$int]['review_admin'] = $key['review_admin'];
				$result[$int]['review_time'] = $key['review_time'];
				$int++;
			}
		}

	}
	return $result;
}
function verify_email($connect)
{
	global $connect, $user_data;
	$error = "";
	$code = $user_data['status'];
	if (isset($_POST['code']) && $_POST['code'] == $code && $code != "VERIFIED") {
		if (mysqli_query($connect, "UPDATE `users` SET `verify_time` = '".time()."', `status` = 'VERIFIED' WHERE `users`.`id` = '".$_SESSION['user_id']."'")) {
			header("Location: /account");
		}else{
			$error .= '<li>Invalid Code</li>';
		}		
	}else{
		$error .= '<li>Invalid Code</li>';
		if (mysqli_query($connect, "UPDATE `users` SET `status` = '".rand(10000000, 99999999)."' WHERE `users`.`id` = '".$user_data['id']."'")) {
			if (send_code()) {
				$error .= '<li>New Code has been sent</li>';	
			}
		}
	}
	return $error;
}
function login(){
	$error = '';
	if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password'])) {
		$email = (strtolower(strip_tags(addslashes($_POST['email']))));
		$password = md5((strip_tags(addslashes($_POST['password']))));
		$user_data = user($email);
		if ($email !== $user_data['email']) {
			$error .= '<li>Email not found</li>';
		}elseif ($password !== $user_data['pass']) {
			$error .= '<li>Password is incorrect</li>';
		}else{
			
			$_SESSION['user_id'] = $user_data['id'];
			print_r($_SESSION['user_id'] );
			header("Location: /account");
		}
	}else{
		$error .= '<li>Invalid input</li>';
	}
	return $error;
}
function register($connect)
{
	$error = "";
	if (isset($_POST['register'])) {
		if (isset($_POST['fname']) && strlen($_POST['fname']) >= 3 &&  strlen($_POST['fname']) <= 15) {
			$fname = preg_replace("/[^a-zA-Z\s]+/", "", ucwords(strtolower(strip_tags(addslashes($_POST['fname'])))));
		}else{
			$error .= '<li>Provide an valid first name</li>'.strlen($_POST['fname']);			
		}
		if (isset($_POST['lname']) && strlen($_POST['lname']) >= 3 &&  strlen($_POST['lname']) <= 15) {
			$lname = preg_replace("/[^a-zA-Z\s]+/", "", ucwords(strtolower(strip_tags(addslashes($_POST['lname'])))));
		}else{
			$error .= '<li>Provide an valid last name</li>';			
		}
		if (isset($_POST['email']) && strlen($_POST['email']) >= 8 &&  strlen($_POST['email']) <= 40 && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {	
			$email = (strtolower(strip_tags(addslashes($_POST['email']))));
			$uxk = user($email);
			if (isset($uxk['id']) && $uxk['id'] != false) {
				$error .= '<li>Email already existed</li>';
			}
		}else{
			$error .= '<li>Provide an valid email address</li>';			
		}
		if (isset($_POST['password']) && strlen($_POST['password']) >= 8 &&  strlen($_POST['password']) < 64) {	
			$password = md5((strip_tags(addslashes($_POST['password']))));
		}else{
			$error .= '<li>Provide an valid password</li>';			
		}
		if (isset($_POST['sex']) && ($_POST['sex'] == 1 || $_POST['sex'] == 2 || $_POST['sex'] == 3 )) {
			$sex = strip_tags(addslashes($_POST['sex']));
		}else{
			$error .= '<li>Choose your sex</li>';	
		}
		if (isset($_POST['birth'])) {
			$birth = strip_tags(addslashes($_POST['birth']));
		}else{
			$error .= '<li>Choose your birth</li>';	
		}

		if (isset($connect) && $error == "" && $connect != false) {
			if (mysqli_query($connect, "INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `pass`, `birtday`, `type`, `time`, `status`, `verify_time`, `sex`) VALUES (NULL, '$fname', '$lname', '$email', '$password', '$birth', 'USER', '".time()."', '".rand(100000, 999999)."', '', '$sex')")) {
				$_SESSION['user_id'] = mysqli_insert_id($connect);
				send_code();
				header("Location: /account");			
			}else{
				$error .= '<li>Something went wrong!</li>';	
			}
		}else if(!isset($connect) || $connect != false){
			$error .= '<li>Something went wrong!</li>';	
		}
		
	}
	return $error;
}



function update_user($connect)
{
	global $connect, $user_data;
	$error = "";
	$email_code = "VERIFIED";
	if (isset($_POST['update_user'])) {
		if (isset($_POST['fname']) && strlen($_POST['fname']) >= 3 &&  strlen($_POST['fname']) <= 15) {
			$fname = preg_replace("/[^a-zA-Z\s]+/", "", ucwords(strtolower(strip_tags(addslashes($_POST['fname'])))));
		}else{
			$error .= '<li>Provide an valid first name</li>'.strlen($_POST['fname']);			
		}
		if (isset($_POST['lname']) && strlen($_POST['lname']) >= 3 &&  strlen($_POST['lname']) <= 15) {
			$lname = preg_replace("/[^a-zA-Z\s]+/", "", ucwords(strtolower(strip_tags(addslashes($_POST['lname'])))));
		}else{
			$error .= '<li>Provide an valid last name</li>';			
		}
		if (isset($_POST['password']) && $_POST['password'] != '') {
			if (isset($_POST['password']) && strlen($_POST['password']) >= 8 &&  strlen($_POST['password']) < 64) {	
				$password = md5((strip_tags(addslashes($_POST['password']))));
				if ($password != $user_data['pass']) {
					$email_code = rand(100000, 999999);
				}
			}else{
				$error .= '<li>Provide an valid password</li>';			
			}
		}else{
			$password = $user_data['pass'];
		}
			
		if (isset($_POST['sex']) && ($_POST['sex'] == 1 || $_POST['sex'] == 2 || $_POST['sex'] == 3 )) {
			$sex = strip_tags(addslashes($_POST['sex']));
		}else{
			$error .= '<li>Choose your sex</li>';	
		}
		if (isset($_POST['birth'])) {
			$birth = strip_tags(addslashes($_POST['birth']));
		}else{
			$error .= '<li>Choose your birth</li>';	
		}

		if (isset($connect) && $error == "" && $connect != false) {
			if (mysqli_query($connect, "UPDATE `users` SET `fname` = '$fname', `lname` = '$lname',  `pass` = '$password', `sex` = '$sex', `birtday` = '$birth', `status` = '$email_code' WHERE `users`.`id` = '".$user_data['id']."'")) {
				if ($password != $user_data['pass']) {
					send_code();
				}
				header("Location: /account?current=settings");			
			}else{
				$error .= '<li>Something went wrong!</li>';	
			}
		}else if(!isset($connect) || $connect != false){
			$error .= '<li>Something went wrong!</li>';	
		}
		
	}
	return $error;
}
function sent_mail($to = null, $fname = null, $message = null, $subject = null){
	$fname = ucwords(strtolower(addslashes($fname)));
	$to = (strtolower(addslashes(strip_tags($to))));
	

	$website_title = $_SESSION['site_name'];
	$website_url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'];
	$web_mail = "ProgrammerJibon@gmail.com";
	$logo = "http://auiplay.com/mailer/logo.png";

	if ($subject == null) {
		$subject = "Notification from $website_title";
	}
	$header = '';
	$headerX['Content-Type'] = 'text/html;charset: ISO-8859-1';
	$headerX['MIME-Version'] = '1.0';
	$headerX['X-Priority'] = '1';
	$subject = ucwords(strtolower(addslashes(strip_tags($subject))));
	// $headerX['Priority'] = 'Urgent';
	// $headerX['Importance'] = 'High';
	// $headerX['X-MSMail-Priority'] = 'High';
	$headerX['Return-Path'] = 'ProgrammerJibon@gmail.com';
	$headerX['Reply-To'] = $web_mail;
	$headerX['X-Mailer'] = 'PHP/'.phpversion();
	$headerX['From'] = "$website_title <$web_mail>";

	$header = $headerX;
	$mail_body = '
	<body style="margin: 0; padding: 0;">
		<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing: border-box;font-size: 14px;width: 100%;background: #f6f6f6;margin: 0;padding: 0;user-select: none;">
			<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing: border-box;font-size: 14px;margin: 0;padding: 0;">
					<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;display: block!important;max-width: 600px!important;clear: both!important;margin: 0 auto;padding: 0;min-width:400px;">
						<div style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing: border-box;max-width: 600px;display: block;margin: 0 auto;padding: 20px;padding-top: 50px">
							<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing: border-box;font-size: 12px;border-radius: 3px;background: #fff;margin: 0;padding: 0;border: 1px solid #e9e9e9; width: 100%; padding: 16px;color: #8d8d8d;">
								<tbody>
									<tr>
										<td><br></td>
									</tr>
									<tr>
										<td style="margin: 0 auto;display: flex;align-items: center;justify-content: space-between;">
											<a target="_blank" href="'.$website_url.'">
												<img style="width: auto;height: 70px;pointer-events: none;" src="'.$logo.'">
											</a>
											<div  style="display: flex;justify-content: center;margin-left: auto;">
												'.date("H:i:s A").'<br>
												'.date("d M, Y").'
											</div>
										</td>
									</tr>
									<tr>
										<td><br></td>
									</tr>
									<tr>
										<td>Hi <b>'.$fname.'</b>,</td>
									</tr>
									<tr>
										<td><br></td>
									</tr>
									<tr style="font-size: 14px;color:#444444;">
										<td>'.$message.'</td>
									</tr>
									<tr>
										<td><br>Please keep in mind that if this mail contain any crediatials, don\'t share these or this email with anyone. Not even with your girlfriend. Never share your email and password. Keep your privacy safe.</td>
									</tr>
									<tr>
										<td><br></td>
									</tr>
									<tr>
										<td>Thank you for your time.</td>
									</tr>
									<tr>
										<td><br></td>
									</tr>
									<tr>
										<td>From, <br>'.$website_title.' team.</td>
									</tr>
									<tr>
										<td><br></td>
									</tr>
								</tbody>
							</table>
							<div style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px;width:100%;clear:both;color:#999;margin:0;padding:20px">
								<table width="100%" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px;margin:0;padding:0; color: #cfcfcf;">
									<tbody><tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px;margin:0;padding:0">
										<td style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:12px;vertical-align:top;text-align:center;margin:0;padding:0 0 5px" align="center" valign="top">You are receiving this email to protect and verify users crediatials and personal informations.</td>
									</tr>
									<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px;margin:0;padding:0">
										<td style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:12px;vertical-align:top;text-align:center;margin:0;padding:0 0 5px" align="center" valign="top">
											© 2021-'.date('y').' All rights reserved by <a target="_blank" style="color: lightpink;" href="'.$website_url.'">'.$website_title.'</a>.Programmed by <a target="_blank" style="color: lightpink;" href="https://instagram.com/ProgrammerJibon">ProgrammerJibon</a>
										</td>
									</tr>
								</tbody></table>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</body>
	';
	if (mail($to, $subject, $mail_body, $header)) {
		return $to;
	}else{
		return false;
	}
}
function categories($id = null){
	global $connect;
	$add = "";
	$result = array();
	if($id != null){
		$add = "WHERE `id` LIKE '$id'";
	}
	if ($sql = mysqli_query($connect, "SELECT * FROM `categories` $add  ORDER BY `categories`.`id` DESC")) {
		foreach ($sql as $key) {
			if ($key['status'] == "ACTIVE") {
				$result[] = $key;
			}
			
		}
	}
	return $result;
}
function user($id = null){
	global $connect;
	$data = false;
	if ($id != null) {
		$query = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$id' OR `email` = '$id'  ORDER BY `users`.`id` ASC");
		foreach ($query as $key) {
			if ($key['type'] == "ADMIN" || $key['type'] == "USER" || $key['type'] == "BRAIN") {
				$data = $key;
			}			
		}
	}
	if ($data == false) {
		$data['id'] = false;
		$data['fname'] = false;
		$data['lname'] = false;
		$data['email'] = false;
		$data['pass'] = false;
		$data['birtday'] = false;
		$data['type'] = false;
		$data['time'] = false;
		$data['status'] = false;
		$data['verify_time'] = false;
	}
	return $data;
}

function rearrange_files($arr) {
	foreach($arr as $key => $all) {
	    foreach($all as $i => $val) {
	        $new_array[$i][$key] = $val;    
	    }    
	}
		return $new_array;
}
function users(){
	global $connect, $user_data;
	$data = array();
	if (isset($user_data['type']) && ($user_data['type'] == "ADMIN"  || $user_data['type'] == "BRAIN")) {
		$query = mysqli_query($connect, "SELECT * FROM `users` ORDER BY `users`.`id` DESC");
		foreach ($query as $key) {
			if ($key['type'] == "ADMIN" || $key['type'] == "USER" || $key['type'] == "BRAIN") {
				$data[] = $key;
			}
		}
	}
	return $data;
}




require_once 'data.php';