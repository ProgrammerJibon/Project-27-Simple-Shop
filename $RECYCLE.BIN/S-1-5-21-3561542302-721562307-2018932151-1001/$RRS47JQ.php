<?php 
if (!isset($user_data)) {
	$_POST['code'] = 404;
	require 'error.php';
}elseif ($user_data['type'] !== "USER") {
	$_POST['code'] = 404;
	require 'error.php';
}else{
?>


<div class="admin-panelX row mx-auto" style="background: #f1f1f1;">
	<div class="sidebar col-sm-3 col-lg-2 grid py-5 sticky-top">
	  <a class="col-sm" href="/"><i class="fas fa-home"></i> <?php echo t(42)[$l]; ?></a>
	  <a class="col-sm <?php if(isset($_GET['current']) && $_GET['current'] == "orders"){echo "active";} ?>" href="?current=orders"><i class="fas fa-shipping-fast"></i> <?php echo t(6)[$l]; ?></a>
	  <a class="col-sm <?php if(isset($_GET['current']) && $_GET['current'] == "payments"){echo "active";} ?>" href="?current=payments"><i class="fas fa-dollar-sign"></i> <?php echo t(7)[$l]; ?></a>
	  <a class="col-sm <?php if(isset($_GET['current']) && $_GET['current'] == "cart"){echo "active";} ?>" href="?current=cart"><i class="fas fa-shopping-cart"></i> <?php echo t(6)[$l]; ?> <?php echo t(8)[$l]; ?></a>
	  <a class="col-sm <?php if(isset($_GET['current']) && $_GET['current'] == "settings"){echo "active";} ?>" href="?current=settings"><i class="fas fa-tools"></i> <?php echo t(5)[$l]; ?></a>
	  <form method="POST"><button type="submit" name="logout" style="color:pink; outline: none;" class="btn btn-link ps-2"></i> <?php echo t(9)[$l]; ?></button></form>
	</div>
	<div class="contentX col-sm-9 col-lg-10 mt-5 pt-1">
		<?php if ((isset($_GET['current']) && $_GET['current'] == "cart")): ?>
			<h5><?php echo t(43)[$l]; ?></h5>
				<table class="table  table-striped">
					<thead class="thead-light sticky-top pt-2" style="top: 110px;z-index: 1;box-shadow: rgb(0 0 0 / 15%) 0px 0.5rem 1rem;">
					</thead>
					<tbody>
						<?php 
							$cart_list = mysqli_query($connect, "SELECT * FROM `cart` WHERE `user_id` = '".$user_data['id']."' ORDER BY `cart`.`id` DESC");
							foreach ($cart_list as $key) {
								$product_id = ($key['product_id']);
								$product = products(" WHERE `id` = '$product_id' ");
								if (isset($product[0]['name'])) {
									$product = $product[0];
									
							?>
								<tr>
									<td>
										<form method="POST" action="/pay-now">
											<div class="w-100 d-flex align-items-center">
												<div class="col-md-4" style="max-width: 100px; overflow: hidden; height: 100px" id="image-slider-<?php echo $product['id']; ?>">
													<script type="text/javascript">
														imageSlider(
															document.getElementById('image-slider-<?php echo $product['id']; ?>'),
															[
																<?php 
																foreach ($product['pics'] as $pic) {
																	echo "`$pic`,";
																}
																 ?>
															],
															[],
															{
																dots: false,
																buttons: false,
																interval: 3210
															}
														);
													</script>
												</div>
												<div class="col-md col-sm">
													<h6 class="col-md col-sm px-3 product_admin_heading">
														<a target="_blank" class="text-success" style="text-decoration: none;font-weight: 600" href="product?id=<?php echo urlencode(base64_encode($product['id'])); ?>">
															<?php echo ($product['name'])."..."; ?>
														</a>
													</h6>
													<div class="row px-3 text-danger">
														<div class="col-sm-4">
															<span><?php echo date("dM, Y - H:iA", $key['time']) ?></span>
														</div>
														<div class="col-sm-4" style="text-align: center;">
															<span><?php echo t(44)[$l]; ?>: <?php echo $site_currency_icon.$product['prize']; ?></span>
														</div>
														<div class="col-sm-4">
															<span><?php echo t(45)[$l]; ?>: <?php echo $site_currency_icon.($product['prize']*$key['quantity']); ?></span>
														</div>
													</div>
													
												</div>
												<div class="col-md-5 px-2 d-flex align-items-center justify-content-center">

													<div class="col-sm-5">
														<input class="col-sm-4 col-sm-4 btn btn-outline-primary" type="number" required min="1"value="<?php echo $key['quantity']; ?>" name="quantity">
														<button class="col-sm-6 btn btn-outline-primary" name="quantity_change" value="<?php echo $key['id']; ?>">
															<?php echo t(46)[$l]; ?>
														</button>
													</div>
													<button name="remove_from_cart" title="Remove from cart" value="<?php echo $key['id']; ?>" class="btn btn-outline-danger">
														<i class="fas fa-eraser"></i>
													</button>
													<input type="hidden" hidden name="cart_number" value="<?php echo $key['id']; ?>">
													<button name="to_pay" value="<?php echo $product['id']; ?>" class="btn btn-outline-primary mx-2">
														<i class="fas fa-money-check-alt"></i>
													</button>
													
												</div>
											</div>
										</form>
									</td>
								</tr>
							<?php
							}
								}

						 ?>
					</tbody>
				</table>
		<?php endif ?>
		<?php if ((isset($_GET['current']) && $_GET['current'] == "settings")): ?>
			<div class="container my-2">
				<form method="POST"	>
					<h5 class="container mt-2"><?php echo t(47)[$l]; ?></h5>
						<div class="container">
							<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
								<?php 
									if ($error != "") {
										$error = '<ol style="list-style: square;" class="alert alert-danger col-sm-12 px-5">'.$error.'</ol>';
										echo $error;
									}

								 ?>
							</div>
							<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
								<label for="fname" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(48)[$l]; ?></label>
								<div class="col-sm-8">
									<input autocomplete="off" required type="text" class="form-control form-control-sm" autofocus minlength="3" maxlength="15" id="fname" value="<?php echo $user_data['fname']; ?>" name="fname">
								</div>
							</div>
							<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
								<label for="lname" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(49)[$l]; ?></label>
								<div class="col-sm-8">
									<input autocomplete="off" required type="text" class="form-control form-control-sm"  value="<?php echo $user_data['lname']; ?>" minlength="3" maxlength="15"  id="lname" name="lname">
								</div>
							</div>
							<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
								<label for="sex" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(54)[$l]; ?></label>
								<div class="col-sm-8 form-group">
									<select type="select" class="form-select form-select-sm" id="sex" required name="sex">
										<option disabled <?php if (!isset($user_data['sex'])) { echo "selected";} ?>><?php echo t(54)[$l]; ?></option>
										<option <?php if (isset($user_data['sex']) && $user_data['sex'] == "1") { echo "selected";} ?> value="1"><?php echo t(50)[$l]; ?></option>
										<option <?php if (isset($user_data['sex']) && $user_data['sex'] == "2") { echo "selected";} ?>  value="2"><?php echo t(51)[$l]; ?></option>
										<option <?php if (isset($user_data['sex']) && $user_data['sex'] == "3") { echo "selected";} ?>  value="3"><?php echo t(52)[$l]; ?></option>
									</select>
								</div>
							</div>
							<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
								<label for="birth" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(53)[$l]; ?></label>
								<div class="col-sm-8">
									<input autocomplete="off" required type="date" value="<?php if (isset($user_data['birtday'])) { echo $user_data['birtday'];}else{echo date("Y-m-d", (time() - (18*365.25*24*60*60)));} ?>" class="form-control form-control-sm" id="birth" name="birth">
								</div>
							</div>
							<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
								<label for="email" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(38)[$l]; ?></label>
								<div class="col-sm-8">
									<input autocomplete="off" disabled type="email" class="form-control form-control-sm"  value="<?php if (isset($user_data['email'])) { echo $user_data['email'];} ?>" minlength="8" maxlength="40" id="email" name="email">
								</div>
							</div>
							<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
								<label for="password" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(39)[$l]; ?></label>
								<div class="col-sm-8">
									<input autocomplete="off" type="password" class="form-control form-control-sm" id="password" id="change_pass"  minlength="8" maxlength="64"  name="password">
								</div>
							</div>
							<div class="form-row d-flex flex-wrap mb-4 mt-3 mx-5 align-items-center justify-content-between">
								<div class="col-sm-1" style="text-align: center;">
								</div>
								<div class="col-sm-8">
									<button onclick="if (document.getElementById('change_pass').value !== '') {alert('You will need to reverify email for changing your password')}" type="submit" name="update_user" class="btn col-sm-12 btn-primary"><?php echo t(46)[$l]; ?></button>
								</div>
							</div>
						</div>
				</form>
			</div>
		<?php endif ?>



		<?php if ((isset($_GET['current']) && $_GET['current'] == "payments")): ?>
			<table class="table  table-striped">
				<tbody>
					<?php 
					$sql_paymentss = "SELECT * FROM `payment` WHERE `user_id` = '".$user_data['id']."' ORDER BY `payment`.`id` DESC";
					$query_paymentss = mysqli_query($connect, $sql_paymentss);

					if (mysqli_num_rows($query_paymentss) > 0) {
						?>
					<thead>
						<tr>
							<th>ID</th>
							<th>Transaction ID</th>
							<th>Date</th>
							<th>User Name(User Id)</th>
							<th>Method</th>
							<th>Ammount</th>
						</tr>
					</thead>
						<?php
						foreach ($query_paymentss as $keys) {
						?>
					<tr>
						<td><?php echo $keys['id']; ?></td>
						<td style="font-family: sans-serif; user-select: text;"><?php 
							if ($keys['txn_id'] == "") {
								echo "<font color='red'>Didn't paid yet</font>";
							}else{
								echo $keys['txn_id'];
							}
						 ?></td>
						<td><?php echo date("d M, y - h:iA", $keys['time']); ?></td>
						<td><?php $user_data_payments = user($keys['user_id']);
							echo $user_data_payments['fname']." ".$user_data_payments['lname']." (".$user_data_payments['id'].")";

						 ?></td>
						<td><?php echo $keys['method']; ?></td>
						<td><?php echo $site_currency_icon.$keys['ammount']; ?></td>
					</tr>
						<?php
						}
					}else{
						echo "<b>You don't have any payments</b>";
					}

					 ?>
				</tbody>
			</table>
		<?php endif; ?>


		<?php if ((isset($_GET['current']) && $_GET['current'] == "orders") || !isset($_GET['current'])): ?>
			<h5>Your orders</h5>
			<table class="table  table-striped">
				<tbody>
					<?php 
					$my_odrers = orders("WHERE `user_id` = '".$user_data['id']."'");
					if (count($my_odrers)>0) {
						foreach ($my_odrers as $key) {
							$product = products("WHERE `id` = '".$key['product_id']."'")[0];
							?>
								<td>
									<div class="d-flex flex-wrap justify-content-between align-items-center">
										<div class="d-flex flex-wrap align-items-center">
											<div>
												<img style="height: 200px; width: 150px;" src="<?php 
													$picxex = $product['pics'][0];
													echo $picxex;
												 ?>">
											</div>
											<div class="px-3">
												<h5 style="color: darkred"><?php echo substr($product['name'], 0, 50)."..." ?></h5>
												<div>
													<div>Price: <b><?php echo $site_currency_icon.$key['product_price']; ?></b></div>
													<div>Quantity: <b><?php echo "x".$key['quantity']; ?></b></div>
													<div>Total: <b><?php echo $site_currency_icon.$key['product_price']*$key['quantity']; ?></b></div>
													<div>Ordered on: <b><?php echo date("M d, Y - H:iA",$key['time']); ?></b></div>
												</div>
											</div>
										</div>

										<div>
											<div>Mobile Number: <?php echo $key['mobile']; ?></div>
											<div><?php echo $key['address']; ?></div>
											<div>City: <?php echo $key['city']; ?>, Country:<?php echo $key['country']; ?></div>
											<?php 

											
											$payment_query = mysqli_query($connect, "SELECT * FROM `payment` WHERE `id` = '".$key['bill_number']."' ORDER BY `id` DESC");
											if (mysqli_num_rows($payment_query) > 0) {
												foreach ($payment_query as $key_payer) {
													if ($key_payer['txn_id'] == "") {

													?>
													<div class="d-flex flex-wrap align-items-center justify-content-between">
														<div>
															<div style="color: red;">No process till make payment</div>
														</div>
														<div class="px-3">
															<a href="<?php  echo "/payment?on=".urlencode(gzencode(base64_encode($key['bill_number']))) ?>" title="Make the payment" class="btn btn-outline-primary">
																<i class="far fa-credit-card"></i>
															</a>
														</div>
													</div>
													<?php
													}else{
														?>
														<?php
														echo "Status: 	<b>".$key['status']."</b><br>";
														echo "Transaction ID: 	<b style='user-select: text; font-family: sans-serif;'>".$key_payer['txn_id']."</b>";
														if ($key['status'] == "DELIVERED" && $key['review_user'] == "") { ?>
															<div class="d-flex flex-wrap align-items-center justify-content-between">
																<a href="<?php  echo "/review?on=".$key['id']; ?>" title="Make a review" class="btn btn-outline-primary">
																	Leave a review. <i class="far fa-star"></i>
																</a>
															</div>
															<?php
														}elseif($key['status'] == "DELIVERED"){
															?>
														<div>
															<a href="<?php  echo "/review?on=".$key['id']; ?>" title="Make a review" class="btn btn-outline-primary">
																<?php 
																echo "<div style='color: orange'>";
																for ($i=0; $i < $key['review_star']; $i++) { 
																	echo '<i class="fas fa-star"></i>';
																}
																for ($i=0; $i < (5-$key['review_star']); $i++) { 
																	echo '<i class="far fa-star"></i>';
																}
																echo "</div>";

																 ?>
															</a>
														</div>
															<?php
														}
													}
													break;
												}
											}else{
												echo "Failed to process";
											}
													
										 ?>
										
										</div>
									</div>										
								</td>
							<?php
							echo "</tr>";
						}}else{
							echo "You didn't make any order";
						} ?>
				</tbody>
			</table>
		<?php endif ?>



























	</div>
</div>


<?php }?>
<?php 
/*$str = "";
foreach (explode("\n", $str) as $key) {
	mysqli_query($connect, "INSERT INTO `categories` (`id`, `name`, `added_by`, `description`, `time`) VALUES (NULL, '$key', '5', '', '".time()."')");
}*/
 ?>