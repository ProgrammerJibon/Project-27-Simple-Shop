<?php 
if (isset($_GET['on']) && isset($user_data) && $_GET['on'] != "") {
	$payment_id = addslashes(base64_decode(gzdecode($_GET['on'])));
	if (isset($_POST['paid'])) {
		$making_transaction_id = "TXN".$user_data['id']."X".$payment_id."W".time();
		$paid_by = "MasterCard";
		if (mysqli_query($connect, "UPDATE `payment` SET `txn_id` = '".$making_transaction_id."', `time` = '".time()."', `method` = '".$paid_by."' WHERE `payment`.`id` = '".$payment_id."'")) {
			header("Location: /account");
		}
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
			<button name="paid">MAKE PAID</button>
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