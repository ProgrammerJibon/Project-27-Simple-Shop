<?php 
require_once 'functions.php';
$result = array();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($user_data) && isset($user_data['type']) && ($user_data['type'] == "ADMIN"  || $user_data['type'] == "BRAIN")) {
	if (isset($_POST['category']) && isset($_POST['new_cat'])) {
		if (isset($_FILES['cover']['tmp_name'])) {
			$file_path = "/uploads/".date("Y/M/");
			if (!file_exists($file_path)) {
				mkdir($file_path, 0777, true);
			}
			$file_name = $file_path."cat-".time()."-".rand().".".explode("/", mime_content_type($_FILES['cover']['tmp_name']))[1];
			move_uploaded_file($_FILES['cover']['tmp_name'], $file_name);
		}elseif (isset($_POST['cat_id']) && ($_POST['cat_id']) != "") {
			$file_name = categories($_POST['cat_id'])[0]['cover'];
		}
		if(isset($_POST['cat_id']) && $_POST['cat_id'] != ""){
			if (mysqli_query($connect, "UPDATE `categories` SET `name` = '".$_POST['category']."', `cover` = '$file_name' WHERE `categories`.`id` = '".$_POST['cat_id']."'")) {
				header("Location: /account?current=categories&changed=true");
			}
		}elseif (mysqli_query($connect, "INSERT INTO `categories` (`id`, `name`, `added_by`, `description`, `time`, `status`, `cover`) VALUES (NULL, '".$_POST['category']."', '".$user_data['id']."', '', '".time()."', 'ACTIVE', '$file_name')")) {
			$result['add_category'] = true;
			header("Location: /account?current=categories&added=true");
		}else{
			$result['add_category'] = false;
			header("Location: /account?current=categories&added=false");
		}		
	}
	if (isset($_POST['make_admin'])) {
		if (mysqli_query($connect, "UPDATE `users` SET `type` = 'ADMIN' WHERE `users`.`id` = '".$_POST['make_admin']."'")) {
			header("Location: /account?current=customers&make_admin=true");
		}else{
			header("Location: /account?current=customers&make_admin=false");
		}
	}
	if (isset($_POST['make_user'])) {
		if (mysqli_query($connect, "UPDATE `users` SET `type` = 'USER' WHERE `users`.`id` = '".$_POST['make_user']."'")) {
			header("Location: /account?current=customers&make_user=true");
		}else{
			header("Location: /account?current=customers&make_user=false");
		}
	}
	if (isset($_POST['remove_user'])) {
		if (mysqli_query($connect, "UPDATE `users` SET `type` = 'DELETED' WHERE `users`.`id` = '".$_POST['remove_user']."'")) {
			header("Location: /account?current=customers&deleted=true");
		}else{
			header("Location: /account?current=customers&deleted=false");
		}
	}
	if (isset($_POST['categories']) && isset($_POST['delete'])) {
		if (mysqli_query($connect, "UPDATE `categories` SET `status` = 'DELETED' WHERE `categories`.`id` = '".$_POST['categories']."'")) {
			$result['deleted'] = "cat_".$_POST['categories'];
		}
		
	}
	if (isset($_POST['remove_product']) && $_POST['remove_product'] !== "") {
		if ($_POST['remove_product'] !== "" && mysqli_query($connect, "UPDATE `products` SET `type` = 'REMOVED' WHERE `products`.`id` = '".$_POST['remove_product']."'")) {
			header("Location: /account?current=products&remove_product=true");
		}else{
			header("Location: /account?current=products&remove_product=false");
		}
	}
	if (isset($_POST['restore_product']) && $_POST['restore_product'] !== "") {
		if ($_POST['restore_product'] !== "" && mysqli_query($connect, "UPDATE `products` SET `type` = '' WHERE `products`.`id` = '".$_POST['restore_product']."'")) {
			header("Location: /account?current=products&restore_product=true");
		}else{
			header("Location: /account?current=products&restore_product=false");
		}
	}
	if (isset($_POST['add_product'])) {
		if (isset($_POST['cod']) && $_POST['cod'] == "on") {
			$_POST['cod'] = 1;
		}else{
			$_POST['cod'] = 0;
		}
		$name = ucwords(strip_tags(addslashes($_POST['name'])));
		$cod = ucwords(strip_tags(addslashes($_POST['cod'])));
		$category = ucwords(strip_tags(addslashes($_POST['category'])));
		$price = ucwords(strip_tags(addslashes($_POST['price'])));
		$stock = ucwords(strip_tags(addslashes($_POST['stock'])));
		$desc = ucwords(strip_tags(addslashes($_POST['desc'])));
		$by_company = ucwords(strip_tags(addslashes($_POST['by_company'])));
		$pictures = "";
		$time = time();
		$files = rearrange_files($_FILES['pics']);
		$add_by = $user_data['id'];
		$file_path = "uploads/".date("Y/M/");
		if (!file_exists($file_path)) {
			mkdir($file_path, 0777, true);
		}
		$int_g = 0;
		foreach ($files as $key) {
			$mime_type = explode("/", mime_content_type($key['tmp_name']));
			if ($mime_type[0] == "image") {
				$file_name = $file_path.time()."_".rand().".".$mime_type[1];
				if (move_uploaded_file($key['tmp_name'], $file_name)) {
					if ($int_g < (count($files)-1)) {
						$pictures .= $file_name."\n";
						$int_g++;
					}else{
						$pictures .= $file_name;
					}
				}
					
			}
		}
		if (mysqli_query($connect, "INSERT INTO `products` (`id`, `name`, `prize`, `pics`, `category`, `added_by`, `description`, `COD`, `total`, `time`, `brand`, `type`) VALUES (NULL, '$name', '$price', '$pictures', '$category', '$add_by', '$desc', '$cod', '$stock', '$time', '$by_company', '')")) {
			header("Location: /account?current=products&added=true");
		}else{
			header("Location: /account?current=products&added=false");
		}
	}

}

if (isset($user_data['type']) && $user_data['type'] == "BRAIN") {
	$querysx = "";
	if (isset($_POST['site_name'])) {
		$querysx .= "UPDATE `site_info` SET `details` = '".addslashes(strip_tags($_POST['site_name']))."' WHERE `site_info`.`name` = 'site_name';";
	}
	if (isset($_POST['intro'])) {
		$querysx .= "UPDATE `site_info` SET `details` = '".addslashes(($_POST['intro']))."' WHERE `site_info`.`name` = 'intro';";
	}
	if (isset($_POST['owner'])) {
		$querysx .= "UPDATE `site_info` SET `details` = '".addslashes(strip_tags($_POST['owner']))."' WHERE `site_info`.`name` = 'owner';";
	}
	if (isset($_POST['bank_details'])) {
		$querysx .= "UPDATE `site_info` SET `details` = '".addslashes(($_POST['bank_details']))."' WHERE `site_info`.`name` = 'bank_details';";
	}
	if (isset($_POST['phone'])) {
		$querysx .= "UPDATE `site_info` SET `details` = '".addslashes(strip_tags($_POST['phone']))."' WHERE `site_info`.`name` = 'phone';";
	}
	if (isset($_POST['email'])) {
		$querysx .= "UPDATE `site_info` SET `details` = '".addslashes(strip_tags($_POST['email']))."' WHERE `site_info`.`name` = 'email';";
	}
	if (isset($_POST['vat_id'])) {
		$querysx .= "UPDATE `site_info` SET `details` = '".addslashes(strip_tags($_POST['vat_id']))."' WHERE `site_info`.`name` = 'vat_id';";
	}
	if (isset($_POST['tax_id'])) {
		$querysx .= "UPDATE `site_info` SET `details` = '".addslashes(strip_tags($_POST['tax_id']))."' WHERE `site_info`.`name` = 'tax_id';";
	}
	if (isset($_POST['address'])) {
		$querysx .= "UPDATE `site_info` SET `details` = '".addslashes(strip_tags($_POST['address']))."' WHERE `site_info`.`name` = 'address';";
	}
	if (isset($_FILES['site_logo']['tmp_name']) && $_FILES['site_logo']['tmp_name'] != null) {
		$site_logo = 'cdn/programmerjibon/'.time().rand().".".(explode("/", mime_content_type($_FILES['site_logo']['tmp_name']))[1]);
        if(!file_exists("cdn/programmerjibon")){
            mkdir("cdn/programmerjibon", 0777, true);
        }
		if(move_uploaded_file($_FILES['site_logo']['tmp_name'], $site_logo)){
            $querysx .= "UPDATE `site_info` SET `details` = '".(strip_tags($site_logo))."' WHERE `site_info`.`name` = 'logo';";
        }else{
            $result[] = "error upload";
        }
	}
	if (mysqli_multi_query($connect, $querysx)) {
		header("Location:/account?current=site_settings&saved=true");
	}else{
		header("Location: /account?current=site_settings&saved=false");
	}
}

if(isset($_POST['cities']) && $_POST['cities'] > 0){
	$sql = "SELECT * FROM `states` WHERE `country_id` LIKE '".addslashes($_POST['cities'])."'";
	$cities = array();
	if ($query = mysqli_query($connect, $sql)) {
		foreach ($query as $key) {
			$cities[] = $key;
		}
		$result['cities'] = $cities;
	}
}

if(!isset($_POST) || $_POST == null){
    header("Location: https://instagram.com/ProgrammerJibon");
}
echo json_encode($result);