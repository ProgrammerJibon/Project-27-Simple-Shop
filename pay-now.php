<?php 
if (!isset($user_data['id'])) {
	header("Location: /account");
}
if (isset($_POST['to_cart']) && isset($user_data['id']) && $_POST['to_cart'] !== "") {
	if (mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `cart` WHERE `user_id` = '".$user_data['id']."' AND `product_id` = '".$_POST['to_cart']."' ORDER BY `id` DESC")) == 0) {
		mysqli_query($connect, "INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `time`) VALUES (NULL, '".$user_data['id']."', '".addslashes($_POST['to_cart'])."', '".addslashes($_POST['quantity'])."', '".time()."')");
		header("Location: /account?current=cart");
	}else{
		mysqli_query($connect, "UPDATE `cart` SET `quantity` = '".$_POST['quantity']."'  WHERE `user_id` = '".$user_data['id']."' AND `product_id` = '".$_POST['to_cart']."'");
		header("Location: /account?current=cart");
	}
	
}elseif (isset($_POST['remove_from_cart']) && $_POST['remove_from_cart'] !== "") {
	mysqli_query($connect, "DELETE FROM `cart` WHERE `cart`.`id` = '".addslashes($_POST['remove_from_cart'])."'");
	header("Location: /account?current=cart");
}elseif (isset($_POST['quantity_change']) && $_POST['quantity_change'] !== "") {
	mysqli_query($connect, "UPDATE `cart` SET `quantity` = '".$_POST['quantity']."' WHERE `cart`.`id` = '".$_POST['quantity_change']."'");
	header("Location: /account?current=cart");
}elseif(isset($_POST['country']) && isset($_POST['city']) && isset($_POST['product_quantity']) && isset($_POST['product_id']) && isset($_POST['addreess']) && isset($_POST['number']) && isset($_POST['post_code']) && $_POST['country'] != "" && $_POST['product_quantity'] != "" && $_POST['city'] != "" && $_POST['product_id'] != "" && $_POST['addreess'] != "" && $_POST['number'] != "" && $_POST['post_code'] != ""){
	$product_price = products(" WHERE `id` = '".addslashes($_POST['product_id'])."' ")[0]['prize'];

	$voucher_data = "";
	$voucher_value = 0;
	if (isset($_POST['voucher']) && $_POST['voucher'] != "") {
		$voucher_query = "SELECT * FROM `vouchers` WHERE `code` LIKE '".strtoupper($_POST['voucher'])."'";
		$voucher_query = mysqli_query($connect, $voucher_query);
		if (mysqli_num_rows($voucher_query) > 0) {
			foreach ($voucher_query as $voucher_query_key) {
				if ($voucher_query_key['validity'] > $time && ($voucher_query_key['user'] == $user_data['id'] || $voucher_query_key['user'] == "ALL") && ($product_price*$_POST['product_quantity']) >= ($voucher_query_key['value']*1.5)) {
					$voucher_data = "$voucher_query_key[name] ($voucher_query_key[code])";
					$voucher_value = $voucher_query_key['value'];
					if ($voucher_query_key['user'] == $user_data['id']) {
						mysqli_query($connect, "DELETE FROM `vouchers` WHERE `vouchers`.`id` = '$voucher_query_key[id]'");
					}
				}						
			}
		}
	}


	if (mysqli_query($connect, "INSERT INTO `payment` (`time`, `user_id`, `ammount`) VALUES ('".time()."', '".$user_data['id']."',  '".($product_price*$_POST['product_quantity'] - $voucher_value)."')")) {
		$payment_id = mysqli_insert_id($connect);
		$country = null;
		foreach (mysqli_query($connect, "SELECT * FROM `countries` WHERE `id` = '".addslashes(ucwords(strtolower($_POST['country'])))."'") as $key) {
			$country = $key['name'];
		}
		$order_sql = "INSERT INTO `orders` (`user_id`, `country`, `city`, `post_code`, `address`, `time`, `status`, `product_id`, `bill_number`, `product_price`, `quantity`, `mobile`, `voucher_data`, `voucher_value`) VALUES ('".$user_data['id']."', '".$country."', '".addslashes(ucwords(strtolower($_POST['city'])))."', '".addslashes(ucwords(strtolower($_POST['post_code'])))."', '".addslashes(ucwords(strtolower($_POST['addreess'])))."', '".time()."', 'PENDING', '".$_POST['product_id']."', '".$payment_id."', '".$product_price."', '".addslashes(ucwords(strtolower($_POST['product_quantity'])))."', '".addslashes(ucwords(strtolower($_POST['number'])))."', '$voucher_data', '$voucher_value')";	
		if (mysqli_query($connect, $order_sql)) {
			header("Location: /payment?on=".urlencode(gzencode(base64_encode($payment_id))));
		}
	}


}elseif (isset($_POST['to_pay']) && isset($_POST['quantity'])) {
	$quantity_count = $_POST['quantity'];
	$product_id = $_POST['to_pay'];
	require_once 'add-address-on-buy.php';
}elseif (isset($_POST['product_id']) && isset($_POST['product_quantity'])) {
	$quantity_count = $_POST['product_quantity'];
	$product_id = $_POST['product_id'];
	require_once 'add-address-on-buy.php';
}else{
	 print("<pre>");
	print_r($_POST);
	 print("</pre>");
}