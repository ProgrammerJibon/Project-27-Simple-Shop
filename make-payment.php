<?php 
if (isset($_GET['on']) && isset($user_data) && $_GET['on'] != "") {
	$payment_id = addslashes(base64_decode(gzdecode($_GET['on'])));
	if (isset($_POST['paid'])) {
		$making_transaction_id = "TXN".$user_data['id']."X".$payment_id."W".time();
		$paid_by = "MasterCard";
		if (mysqli_query($connect, "UPDATE `payment` SET `txn_id` = '".$making_transaction_id."', `time` = '".time()."', `method` = '".$paid_by."' WHERE `payment`.`id` = '".$payment_id."'")) {
			if ($_POST['paid'] >= 100) {
				$bonus = 20;
			}elseif ($_POST['paid'] >= 50) {
				$bonus = 10;
			}elseif ($_POST['paid'] >= 20) {
				$bonus = 5;
			}
			if (isset($bonus)) {
				if (mysqli_query($connect, "INSERT INTO `vouchers` (`id`, `name`, `code`, `time`, `validity`, `user`, `value`) VALUES (NULL, 'Gift for order of €$_POST[paid]', 'ORDER_$time', '$time', '".time()+(30*86400)."', '$user_data[id]', '$bonus')")) {
					header("Location: /account?current=coupons");
				}else{
					header("Location: /account?current=orders");
				}
			}else{
				header("Location: /account?current=orders");
			}
		}
	}elseif (isset($_POST['unpaid'])) {
		header("Location: /account?current=orders");
	}
	$payment_query = mysqli_query($connect, "SELECT * FROM `payment` WHERE `id` = '".$payment_id."' ORDER BY `id` DESC");
	if (mysqli_num_rows($payment_query) > 0) {
		foreach ($payment_query as $keysing) {
			if ($keysing['txn_id'] == "") {
				
		?>
		<form method="POST">
			<h1 class="">THIS IS TEST MODE. NO ORDERS WILL BE SHIPPED</h1>
			<h3>Payment ammount: <?php echo $site_currency_icon.$keysing['ammount']; ?></h3>
			<button name="unpaid">UNPAID</button>
			<button name="paid" value="<?php echo $keysing['ammount']; ?>">MAKE PAID</button>
		</form>
		<?php
			}
		} 
	}
	?>
<?php
}else{
	$_POST['code'] = 403;
	require_once 'error.php';
}