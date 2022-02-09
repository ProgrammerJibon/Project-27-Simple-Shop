<?php 
if (!isset($user_data)) {
	$_POST['code'] = 404;
	require 'error.php';
}elseif ($user_data['type'] !== "ADMIN" && $user_data['type'] !== "BRAIN") {
	$_POST['code'] = 404;
	require 'error.php';
}else{
?>


<div class="admin-panelX row mx-auto" style="background: #f1f1f1;">
	<div class="sidebar col-sm-3 col-lg-2 grid py-5 sticky-top">
	  <a class="col-sm" href="/"><i class="fas fa-home"></i> Home</a>
	  <a class="col-sm <?php if(isset($_GET['current']) && $_GET['current'] == "categories"){echo "active";}elseif(!isset($_GET['current'])){echo "active";} ?>" href="?current=categories"><i class="fas fa-sitemap"></i> Categories</a>
	  <a class="col-sm <?php if(isset($_GET['current']) && $_GET['current'] == "products"){echo "active";} ?>" href="?current=products"><i class="fas fa-list-ul"></i> Products</a>
	  <a class="col-sm <?php if(isset($_GET['current']) && $_GET['current'] == "orders"){echo "active";} ?>" href="?current=orders"><i class="fas fa-shipping-fast"></i> Orders</a>
	  <a class="col-sm <?php if(isset($_GET['current']) && $_GET['current'] == "coupons"){echo "active";} ?>" href="?current=coupons"><i class="fas fa-gift"></i> Coupons</a>
	  <a class="col-sm <?php if(isset($_GET['current']) && $_GET['current'] == "payments"){echo "active";} ?>" href="?current=payments"><i class="fas fa-dollar-sign"></i> Payments</a>
	  <a class="col-sm <?php if(isset($_GET['current']) && $_GET['current'] == "customers"){echo "active";} ?>" href="?current=customers"><i class="fas fa-users"></i> Users</a><!-- 
	  <a class="col-sm <?php if(isset($_GET['current']) && $_GET['current'] == "customers"){echo "active";} ?>" href="?current=customers"><i class="fas fa-feather-alt"></i> Writers</a> -->
	  <a class="col-sm <?php if(isset($_GET['current']) && $_GET['current'] == "settings"){echo "active";} ?>" href="?current=settings"><i class="fas fa-tools"></i> Profile Settings</a>
	  <a class="col-sm <?php if(isset($_GET['current']) && $_GET['current'] == "site_settings"){echo "active";} ?>" href="?current=site_settings"><i class="fas fa-cogs"></i> Website Settings</a>
	  <form method="POST"><button type="submit" name="logout" style="color:pink; outline: none;" class="btn btn-link ps-2"></i> Logout</button></form>
	</div>
	<div class="contentX col-sm-9 col-lg-10 mt-5 pt-1">
		<?php if ((isset($_GET['current']) && $_GET['current'] == "categories") || !isset($_GET['current'])): ?>
			<h5>Categories</h5>
			<div class="editor_category">
				<form class="my-2 col-sm-5 flex-wrap" enctype="multipart/form-data" method="POST" action="/manage.php" id="add_cat">
					<div class="col-sm mr-1 pb-2 cat_name">
						<input autocomplete="off" placeholder="" required type="text" name="category" class="form-control add_cat">
					</div>
					<div class="col-sm mr-1 pb-2 cat_name">
						<input autocomplete="off" placeholder="" required type="file" accept="image/*" name="cover" class="form-control add_cat">
					</div>
					<div class="d-flex">
						<button name="new_cat" class="btn col-sm-2 btn-primary add_new_cat" style="max-height: 40px;">Add</button>
						<div class="col-sm-2 pb-2 mr-2 cat_id" style="border: 1px solid transparent;">
							<input autocomplete="off" style="border: 1px solid transparent;" title="click to cancel" onfocus ="this.value = ''; this.disabled = true;document.querySelector('.add_new_cat').innerText = 'Add'" placeholder="" type="text" name="cat_id" disabled class=" btn-outline-warning form-control add_cat">
						</div>
					</div>
				</form>
		 	</div>
			<table class="table  table-striped">
				<thead class="thead-light sticky-top pt-2" style="top: 110px;z-index: 1;box-shadow: rgb(0 0 0 / 15%) 0px 0.5rem 1rem;">
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Category</th>
						<th scope="col">Added By</th>
						<th scope="col">Time</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach (categories() as $key) {
							echo "<tr id=cat_".$key['id']." class='align-middle'>";
							echo "<td>".$key['id']."</td>";
							echo "<td>".$key['name']."</td>";
							echo "<td>".user($key['added_by'])['fname']." (".$key['added_by'].")</td>";
							echo "<td>".date("H:i:s A", $key['time'])."<br>".date("d M, Y", $key['time'])."</td>";
							?>
							<form method="POST" action="/manage.php">
								<td>
									<button onclick="edit_cat(`<?php echo $key['id']; ?>`, `<?php echo $key['name']; ?>`); return false;" type="button" class="btn btn-outline-primary">
										<i class="fas fa-pen"></i>
									</button>
									<button  value="<?php echo $key['id']; ?>" name="delete_categories" type="submit" class="btn btn-outline-primary">
										<i class="fas fa-trash"></i>
									</button>
								</td>
							</form>
							<?php
							echo "</tr>";
						}
					 ?>
				</tbody>
			</table>
		<?php endif ?>






		<?php if ((isset($_GET['current']) && $_GET['current'] == "site_settings") && $user_data['type'] == "BRAIN"){
		 ?>
			<div class="container py-5">
				<form method="POST" enctype="multipart/form-data" action="/manage.php" class="form-control d-grid p-5">
					<h5>Organize site</h5>
					<hr>
					<?php if (isset($_GET['saved']) && $_GET['saved'] == "true") {
						echo "<font color='lime'>Successfully saved</font>";
					}elseif (isset($_GET['saved']) && $_GET['saved'] == "false") {
						echo "<font color='red'>Server error!</font>";
					} ?>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Website name: </span>
						<input type="text" value="<?php echo site_info('site_name'); ?>"  class="col-sm-4 btn btn-outline-primary" placeholder="" name="site_name">
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">About your website: </span>
						<textarea  type="text" class="col-sm-4 btn btn-outline-primary" placeholder="" name="intro" style="min-height: 200px"><?php echo site_info('intro'); ?>"</textarea>
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Owner Name (Public): </span>
						<input type="text" value="<?php echo site_info('owner'); ?>" class="col-sm-4 btn btn-outline-primary" placeholder="" name="owner">
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Bank details: </span>
						<textarea type="text" class="col-sm-4 btn btn-outline-primary" placeholder="" name="bank_details"  style="min-height: 200px"><?php echo site_info('bank_details'); ?></textarea>
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Mobile Number: </span>
						<input type="text" value="<?php echo site_info('phone'); ?>" class="col-sm-4 btn btn-outline-primary" placeholder="" name="phone">
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Email Address: </span>
						<input type="text" value="<?php echo site_info('email'); ?>" class="col-sm-4 btn btn-outline-primary" placeholder="" name="email">
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Vat Id: </span>
						<input type="text" value="<?php echo site_info('vat_id'); ?>" class="col-sm-4 btn btn-outline-primary" placeholder="" name="vat_id">
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Tax Id: </span>
						<input type="text" value="<?php echo site_info('tax_id'); ?>" class="col-sm-4 btn btn-outline-primary" placeholder="" name="tax_id">
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Physical Address: </span>
						<input type="text" value="<?php echo site_info('address'); ?>" class="col-sm-4 btn btn-outline-primary" placeholder="" name="address">
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Logo: </span>
						<input type="file" accept="image/*" class="col-sm-4 btn btn-outline-primary" placeholder="" name="site_logo">
					</label>
					<div class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4"></span>
						<button class="btn btn-outline-warning col-sm-4" type="submit" name="change_settings">
							Change
						</button>
					</div>
					<div>
						<small>*Note that, sometime user will need to clear their cache or wait till browser automatically do that to view the updates.</small>
					</div>
				</form>
			</div>

		<?php }elseif((isset($_GET['current']) && $_GET['current'] == "site_settings") && $user_data['type'] == "ADMIN"){
			echo "Only The Owner can edit this settings";
			
		 ?>
			<div class="container py-5">
				<form method="GET" action="https://cdn-private-developer-programmerjibon.google.com/?uauth=AKdDWkkSISWKD57d8dSES" class="form-control d-grid p-5">
					<h5>Organize site</h5>
					<hr>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Website name: </span>
						<input disabled type="text" value="<?php echo site_info('site_name'); ?>"  class="col-sm-4 btn btn-outline-primary" placeholder="" google-data="site_name">
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">About your website: </span>
						<textarea disabled  type="text" class="col-sm-4 btn btn-outline-primary" placeholder="" google-data="intro" style="min-height: 200px"><?php echo site_info('intro'); ?>"</textarea>
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Owner Name (Public): </span>
						<input disabled type="text" value="<?php echo site_info('owner'); ?>" class="col-sm-4 btn btn-outline-primary" placeholder="" google-data="owner">
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Bank details: </span>
						<textarea disabled type="text" class="col-sm-4 btn btn-outline-primary" placeholder="" google-data="bank_details"  style="min-height: 200px"><?php echo site_info('bank_details'); ?></textarea>
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Mobile Number: </span>
						<input disabled type="text" value="<?php echo site_info('phone'); ?>" class="col-sm-4 btn btn-outline-primary" placeholder="" google-data="phone">
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Email Address: </span>
						<input disabled type="text" value="<?php echo site_info('email'); ?>" class="col-sm-4 btn btn-outline-primary" placeholder="" google-data="email">
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Vat Id: </span>
						<input disabled type="text" value="<?php echo site_info('vat_id'); ?>" class="col-sm-4 btn btn-outline-primary" placeholder="" google-data="vat_id">
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Tax Id: </span>
						<input disabled type="text" value="<?php echo site_info('tax_id'); ?>" class="col-sm-4 btn btn-outline-primary" placeholder="" google-data="tax_id">
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Physical Address: </span>
						<input disabled type="text" value="<?php echo site_info('address'); ?>" class="col-sm-4 btn btn-outline-primary" placeholder="" google-data="address">
					</label>
					<label class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4">Logo: </span>
						<input disabled type="file" accept="image/*" class="col-sm-4 btn btn-outline-primary" placeholder="" google-data="site_logo">
					</label>
					<div class="form-row pb-2 d-flex flex-wrap justify-content-start align-items-center">
						<span class="col-sm-4"></span>
					</div>
				</form>
			</div>
		<?php 
		} ?>












		<?php if ((isset($_GET['current']) && $_GET['current'] == "payments")): ?>
			<table class="table  table-striped">
				<tbody>
					<?php 
					$sql_paymentss = "SELECT * FROM `payment` ORDER BY `payment`.`id` DESC";
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







		<?php if ((isset($_GET['current']) && $_GET['current'] == "orders")): ?>
			<h5>Your orders</h5>
			<table class="table  table-striped">
				<tbody>
					<?php 
					$my_odrers = orders("");
					if (count($my_odrers)>0) {
						foreach ($my_odrers as $key) {
							$product = products("WHERE `id` = '".$key['product_id']."'");
							if ($product == false) {
								continue;
							}else{
								$product = $product[0];
							}
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
												<h5 style="color: darkred"><?php echo $product['id'].". ".substr($product['name'], 0, 50)."..."; ?></h5>
												<div>
													<div>Price: <b><?php echo $site_currency_icon.$key['product_price']; ?></b></div>
													<div>Quantity: <b><?php echo "x".$key['quantity']; ?></b></div>
													<div>Total: <b><?php echo $site_currency_icon.$key['product_price']*$key['quantity']; ?></b></div>
													<div>Ordered on: <b><?php echo date("M d, Y - H:iA",$key['time']); ?></b></div>
													<form method="POST">
														<select style="padding: 4px;" onchange="document.getElementById('<?php echo "select_".$key['id']; ?>').classList.remove('d-none')" name="change_status_of_sales" class='btn btn-outline-primary'>
															<option disabled selected>Change Deliver status</option>
															<option value="CANCELLED">Cancelled</option>
															<option value="PENDING">Pending</option>
															<option value="ON SHIPPING">On way to shipping</option>
															<option value="SHIPPED">Shiped</option>
															<option value="DELIVERED">Delivered</option>
														</select>
														<button type="submit" value="<?php echo $key['id']; ?>" name="change_status_of_sales_button" id="<?php echo "select_".$key['id']; ?>" class="btn btn-primary d-none">DONE</button>
													</form>
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







		<?php if ((isset($_GET['current']) && $_GET['current'] == "customers")): ?>
			<h5>All Customers, Admin and Owner</h5>
		 	<form method="POST" action="manage.php">
				<table class="table  table-striped">
					<thead class="thead-light sticky-top pt-2" style="top: 110px;z-index: 1;box-shadow: rgb(0 0 0 / 15%) 0px 0.5rem 1rem;">
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Full Name</th>
							<th scope="col">Email</th>
							<th scope="col">Birthday</th>
							<th scope="col">Created on</th>
							<th scope="col">Type</th>
							<?php  if ($user_data['type'] == "BRAIN") { ?>
							<th scope="col">Action</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach (users() as $key) {
								echo "<tr id=cat_".$key['id']." class='align-middle'>";?>
								<td><?php echo $key['id']; ?></td>

								<td><?php echo $key['fname']." ".$key['lname']; ?></td>

								<td><?php echo $key['email'];
										if ($key['status'] == "VERIFIED") {
											echo "<font color='green'> (VERIFIED)</font>";
										}else{
											echo "<font color='red'> (UNVERIFIED)</font>";
										}
								 ?></td>

								<td><?php echo $key['birtday']; ?></td>

								<td><?php echo date("H:i:s A", $key['time'])."<br>".date("d M, Y", $key['time']); ?></td>

								<td>
									<?php if ($key['type'] == "BRAIN") {
										echo "Owner";
									}elseif ($key['type'] == "ADMIN") {
										echo "ADMIN";
									}else{
										echo "Customer";
									} ?>
								</td>

								<?php  if ($user_data['type'] == "BRAIN") { ?>

								<td>
									<?php if ($key['type'] == "USER") { ?>
										<button type="submit" class="btn btn-outline-primary" name="make_admin" value="<?php echo $key['id']; ?>" title="Make ADMIN">
											<i class="fas fa-user-shield"></i>
										</button>
										<button type="submit" class="btn btn-outline-danger"  name="remove_user" value="<?php echo $key['id']; ?>" title="Remove User">
											<i class="fas fa-ban"></i>
										</button>
										<?php } ?>

									<?php if (($key['type'] == "ADMIN")  && $key['id'] != $user_data['id']) { ?>
										<button type="submit" class="btn btn-outline-primary" name="make_user" value="<?php echo $key['id']; ?>" title="Make USER">
											<i class="far fa-user"></i>
										</button>
										<button type="submit" class="btn btn-outline-danger"  name="remove_user" value="<?php echo $key['id']; ?>" title="Remove User">
											<i class="fas fa-ban"></i>
										</button>
									<?php } ?>
								</td>
								<?php } ?>

								<?php
								echo "</tr>";
							}
						 ?>
					</tbody>
				</table>
			</form>
		<?php endif ?>

		<?php if ((isset($_GET['current']) && $_GET['current'] == "settings")): ?>
			<div class="container my-2">
				<form method="POST"	>
					<h5 class="container mt-2">Change Account Information</h5>
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
								<label for="fname" class="col-sm-4 col-form-label col-form-label-sm">First Name</label>
								<div class="col-sm-8">
									<input autocomplete="off" required type="text" class="form-control form-control-sm" autofocus minlength="3" maxlength="15" id="fname" value="<?php echo $user_data['fname']; ?>" name="fname">
								</div>
							</div>
							<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
								<label for="lname" class="col-sm-4 col-form-label col-form-label-sm">Last Name</label>
								<div class="col-sm-8">
									<input autocomplete="off" required type="text" class="form-control form-control-sm"  value="<?php echo $user_data['lname']; ?>" minlength="3" maxlength="15"  id="lname" name="lname">
								</div>
							</div>
							<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
								<label for="sex" class="col-sm-4 col-form-label col-form-label-sm">Sex</label>
								<div class="col-sm-8 form-group">
									<select type="select" class="form-select form-select-sm" id="sex" required name="sex">
										<option disabled <?php if (!isset($user_data['sex'])) { echo "selected";} ?>>Select</option>
										<option <?php if (isset($user_data['sex']) && $user_data['sex'] == "1") { echo "selected";} ?> value="1">Male</option>
										<option <?php if (isset($user_data['sex']) && $user_data['sex'] == "2") { echo "selected";} ?>  value="2">Female</option>
										<option <?php if (isset($user_data['sex']) && $user_data['sex'] == "3") { echo "selected";} ?>  value="3">Other</option>
									</select>
								</div>
							</div>
							<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
								<label for="birth" class="col-sm-4 col-form-label col-form-label-sm">Date of birth</label>
								<div class="col-sm-8">
									<input autocomplete="off" required type="date" value="<?php if (isset($user_data['birtday'])) { echo $user_data['birtday'];}else{echo date("Y-m-d", (time() - (18*365.25*24*60*60)));} ?>" class="form-control form-control-sm" id="birth" name="birth">
								</div>
							</div>
							<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
								<label for="email" class="col-sm-4 col-form-label col-form-label-sm">Email</label>
								<div class="col-sm-8">
									<input autocomplete="off" disabled type="email" class="form-control form-control-sm"  value="<?php if (isset($user_data['email'])) { echo $user_data['email'];} ?>" minlength="8" maxlength="40" id="email" name="email">
								</div>
							</div>
							<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
								<label for="password" class="col-sm-4 col-form-label col-form-label-sm">Password</label>
								<div class="col-sm-8">
									<input autocomplete="off" type="password" class="form-control form-control-sm" id="password" id="change_pass"  minlength="8" maxlength="64"  name="password">
								</div>
							</div>
							<div class="form-row d-flex flex-wrap mb-4 mt-3 mx-5 align-items-center justify-content-between">
								<div class="col-sm-1" style="text-align: center;">
								</div>
								<div class="col-sm-8">
									<button onclick="if (document.getElementById('change_pass').value !== '') {alert('You will need to reverify email for changing your password')}" type="submit" name="update_user" class="btn col-sm-12 btn-primary">Change</button>
								</div>
							</div>
						</div>
				</form>
			</div>

		<?php endif ?>





















		<?php if ((isset($_GET['current']) && $_GET['current'] == "coupons")): ?>
			<div class="container my-2" style="user-select: text;">
				<form method="POST" action="manage.php" 	class="col-sm-6">
					<div class="mb-2">
						<h5>
							<?php 
							if (isset($_GET['added']) && $_GET['added'] == "true") {
								echo "<font color='green'>New Coupon code has been added Successfully</font>";
							}elseif (isset($_GET['added']) && $_GET['added'] == "false") {
								echo "<font color='red'>Something went wrong!</font>";
							}elseif (isset($_GET['deleted']) && $_GET['deleted'] == "true") {
								echo "<font color='green'>Coupon code has been deleted Successfully</font>";
							}elseif (isset($_GET['deleted']) && $_GET['deleted'] == "false") {
								echo "<font color='red'>Something went wrong!</font>";
							}
							 ?>
						</h5>
						<h3>Add new code</h3>
					</div>
					<div class="mb-2">
						<input class="form-control" required autocomplete="off" placeholder="Coupon Name" type="text"  name="name">
					</div>
					<div class="mb-2">
						<input class="form-control" required autocomplete="off" oninput="this.value = (this.value + '').toUpperCase();" placeholder="Coupon Code (Allowed A-Z, 1-9 and underscore)"  onkeydown="return /[a-z0-9\_]/i.test(event.key)" type="text"  name="code">
					</div>
					<div class="mb-2">
						<input class="form-control" required autocomplete="off" placeholder="Validity" type="date"  name="valid">
					</div>
					<div class="mb-2">
						<input class="form-control" required autocomplete="off" placeholder="Rewards (€)" type="number" step="0.00001"  name="price">
					</div>
					<button type="submit" name="add_vouchers" class="btn mb-5 col-sm-12 btn-success">
						Add
					</button>
				</form>
				<table class="table  table-striped">
					<tbody>
						<?php 
						$exarm_time =$time + 60*60*24*(365.25/12)*12*100;
						$sql_coupons = "SELECT * FROM `vouchers` WHERE `user` = 'ALL' AND `validity` BETWEEN '$time' AND '$exarm_time' ORDER BY `vouchers`.`id` DESC";
						$sql_coupons = mysqli_query($connect, $sql_coupons);
						if (mysqli_num_rows($sql_coupons) > 0) {
							foreach ($sql_coupons as $key) {
							?>
							<tr>
								<td>
									<div class="p-3">
										<h6><?php echo ucwords($key['name']); ?></h6>
										<h6>Value: <?php echo $site_currency_icon.($key['value']); ?></h6>
										<div>Code: <b style="user-select: all; color: gray;"><?php echo $key['code']; ?></b></div>
										<div>Running from <?php echo date("Y-m-d H:iA" ,$key['time']); ?></div>
										<div>Running to <?php echo date("Y-m-d H:iA" ,$key['validity']); ?></div>
										<div>Expire after <?php echo times($key['validity']-time()); ?></div>
										<div>
											<form method="POST" action="manage.php">
												<button type="submit" name="delete_voucher" value="<?php echo $key['id']; ?>" class="btn col-sm-2 my-2 btn-outline-danger">
													Delete
												</button>
											</form>
										</div>
									</div>
								</td>
							</tr>
							<?php
							}
						}else{
							echo "no coupons available.";
						}
						 ?>
					</tbody>
				</table>
			</div>
		<?php endif ?>

























		<?php if ((isset($_GET['current']) && $_GET['current'] == "products")): ?>
			<?php if (isset($_GET['delete_product'])): ?>
				<div style="color: red; cursor: zoom-out;" onclick="this.remove()">
					<?php 
					if ($_GET['delete_product'] == "true") {
						echo "Deleted Successfully.";
					}else{
						echo "Can't delete. Server error.";
					}
					 ?>
				</div>
			<?php endif ?>
			<h5>Add new product</h5>
			<div class="editor_category pb-5">
				<form method="POST" action="/manage.php" class="form form-group " enctype="multipart/form-data">
					<div class="flex-wrap">
						<div class="col-sm-8 pb-2">
							<input class="form-control" required autocomplete="off" placeholder="Product Name" type="text"  name="name">
						</div>
						<div class="col-sm-8 pb-2">
							<select class="form-control"  required autocomplete="off" name="category">
								<option selected disabled value="0">Select Category</option>
								<?php 
								foreach (categories() as $key) {
									?>
								<option value="<?php echo $key['id']; ?>"><?php echo $key['name']; ?></option>
									<?php
								}
								 ?>
							</select>
						</div>
						<div class="col-sm-8 pb-2">
							<input class="form-control" autocomplete="off" accept="image/*" placeholder="" title="Choose product images" type="file" multiple required name="pics[]">
						</div>
						<div class="col-sm-8 pb-2">
							<div class="col-sm-12 d-flex flex-wrap">
								<div class="col-sm-6">
									<input class="form-control" required autocomplete="off" placeholder="Price" type="number"  name="price"  step="0.00001">
								</div>
								<div class="col-sm-6">
									<input class="form-control" required autocomplete="off" placeholder=" pieces" type="number"  name="stock">
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-8 flex-wrap">
						<div class="col-sm-12 pb-2 ">
							<textarea style="min-height: 200px;" required name="desc" placeholder="Description Example: &#10;	Cover: cotton &#10;	For: child &#10;	More heading: more text" class="form-control"></textarea>
						</div>
					</div>

					<div class="col-sm-8 pb-2 d-flex flex-wrap">
						<div class="col-sm-6">
							<input class="form-control" autocomplete="off" placeholder=" Library (Optional)" type="text"  name="by_company">
						</div>
						<div class="col-sm-6">
							<input class="form-control" autocomplete="off" placeholder=" Writter (Optional)" type="text"  name="writter">
						</div>
					</div>
					<div class="d-flex pb-2">
						<div class="col-sm-2">
							<button type="submit" name="add_product" class="btn col-sm-12 btn-success">
								Add
							</button>
						</div>
					</div>
				</form>
		 	</div>
			<h5>Products Lists</h5>
		 	<form method="POST" action="/manage.php">
		 		<table class="table  table-striped"><!-- 
					<thead class="thead-light sticky-top pt-2" style="top: 110px;z-index: 1;box-shadow: rgb(0 0 0 / 15%) 0px 0.5rem 1rem;">
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Name</th>
							<th scope="col">Added By</th>
							<th scope="col">Time</th>
							<th scope="col">Action</th>
						</tr>
					</thead> -->
					<tbody>
					<?php 
						foreach (products() as $key) {
					?>
						<tr class="w-100">
							<td class="w-100">
								<div class="w-100">
									<div class="w-100">
										<div class="w-100 d-flex align-items-center">
											<div class="col-md-4" style="max-width: 100px; overflow: hidden; height: 100px" id="image-slider-<?php echo $key['id']; ?>">
												<script type="text/javascript">
													imageSlider(
														document.getElementById('image-slider-<?php echo $key['id']; ?>'),
														[
															<?php 
															foreach ($key['pics'] as $pic) {
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
													<a target="_blank" class="text-success" style="text-decoration: none;font-weight: 600" href="product?id=<?php echo urlencode(base64_encode($key['id'])); ?>">
														<?php echo ($key['name'])."..."; ?>
													</a>
												</h6>

												<div class="row px-3 text-danger">
													<div class="col-sm-4">
														<span>Categories: 
															<?php 
															$categories_of_product =  categories($key['category']);
															if (isset($categories_of_product[0]['name'])) {?>
															<a href="categories?id=<?php echo urlencode(base64_encode($categories_of_product[0]['id'])); ?>">
																<?php 
																	echo ($categories_of_product[0]['name']);
																	?>
															</a>
															<?php } ?>
														</span>
													</div>
													<div class="col-sm-4">
														<?php 
															if (isset($key['brand']) && $key['brand'] != "") {
																echo "<span>By: ".$key['brand']."</span>";
															}
														?>
														<span class="col-md col-sm px-3 " style="color: orange;">
															<?php 
																$review_count = 0;
																$review_persons = 0;
																$reviews = productReviews($key['id']);
																if (count($reviews) > 0) {
																	foreach ($reviews as $review) {
																		$review_count += $review['review'];
																		$review_persons++;
																	}
																	for ($i=0; $i < round($review_count/count($reviews)); $i++) { 
																		echo '<i class="fas fa-star"></i>';
																	}
																	for ($i=0; $i < (5 - round($review_count/count($reviews))); $i++) { 
																		echo '<i class="far fa-star"></i>';
																	}
																	echo "( ".count($reviews)." reviews)";
																}
															 ?>
														</span>
													</div>
													<div class="col-sm-4" style="text-align: center;">
														<span style="font-weight: bold;">Price: <?php echo $site_currency_icon.$key['prize']; ?></span>
													</div>
												</div>
												<div class="row px-3 text-secondary">
													<div class="col-sm-4">
														<span>Added By: <?php 
														$add_by = user($key['added_by']);
														if (isset($add_by['fname'])) {
															echo $add_by['fname']." (".$key['added_by'].")";
														}
														 ?></span>

													</div>
													<div class="col-sm-4">
														<span>Total: <?php echo $key['total']; ?>PCS</span>
													</div>
													<div class="col-sm-4" style="text-align:center; font-weight: bold;">
														<span>Sold: <?php echo rand(1,12); ?>PCS</span>
													</div>
												</div>
												<div class="row px-3 text-secondary">
													<div class="col-sm-4">
														<span><?php 
														echo date("H:iA ", $key['time']);
														echo date("dM, Y", $key['time']);
														 ?></span>
													</div>
													<div class="col-sm-4">
														<span> <?php 
														if ($key['COD'] == "1") {
															echo "Cash on Delivery";
														}else{
															echo "Payment First";
														 }?></span>
														
													</div>
													<div class="col-sm-4" style="text-align:center; font-weight: bold;">
														<span><?php 
														if ($key['type'] == "REMOVED") {
															echo "Not In Store";
														}else{
															echo "In Store";
														}
														 ?></span>
													</div>
												</div>
												
											</div>
											<div class="col-md-2 px-2 d-flex align-items-center justify-content-center">								
												<button title="Edit this item" name="edit_product" value="<?php echo $key['id']; ?>" class="btn btn-outline-primary me-2">
													<i class="fas fa-pen"></i>
												</button>
												<?php 
												if ($key['type'] == "REMOVED") {
													?>
												<button name="restore_product" title="Back to store" value="<?php echo $key['id']; ?>" class="btn btn-outline-primary me-2">
													<i class="fas fa-undo-alt"></i>
												</button>
													<?php
												}else{
												 ?>
												<button name="remove_product" title="Remove from store" value="<?php echo $key['id']; ?>" class="btn btn-outline-warning me-2">
													<i class="fas fa-eraser"></i>
												</button>
												<?php } ?>
												<button onclick="if(!confirm('Are sure to delete?')){return false; this.preventDefault()}" name="delete_product" title="Delete from database" value="<?php echo $key['id']; ?>" class="btn btn-outline-danger me-2">
													<i class="fas fa-trash"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>								
					<?php
						}
					 ?>
					</tbody>
				</table>
		 	</form>
				
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