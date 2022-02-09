<?php 
if (isset($_POST['logout']) && isset($_SESSION['user_id'])) {
	if($_SESSION['user_id'] = null){
        header("Location: /");
    }
}elseif(isset($_POST['logout'])){
    header("Location: /");
}
if (isset($_POST['register']) && $user_data == false) {
	$error = register($connect);
}
if (isset($_POST['update_user'])) {
	$error = update_user($connect);
}
if (isset($user_data['id']) && ($user_data['type'] == "BRAIN" || $user_data['type'] == "ADMIN")) {
	if (isset($_POST['change_status_of_sales_button']) && isset($_POST['change_status_of_sales'])) {
		mysqli_query($connect, "UPDATE `orders` SET `status` = '".addslashes($_POST['change_status_of_sales'])."' WHERE `orders`.`id` = '".addslashes($_POST['change_status_of_sales_button'])."'");
		header("refresh: 0");
	}
}
if (isset($_POST['login']) && $user_data == false) {
	$error = login($connect);
}elseif (isset($_SESSION['user_id'])) {
	if (isset($uxk['id']) && $uxk['id'] == false) {
		unset($_SESSION['user_id']);
		header("/login");
	}
	if (!isset($user_data['status'])) {
		if (isset($_SESSION['user_id'])) {
			unset($_SESSION['user_id']);
		}
	}
	if (isset($_POST['submit_code'])) {
		$error  = verify_email($connect);
	}
}else{

}