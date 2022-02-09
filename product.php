<?php 
if (!isset($_GET['id'])) {
	$_POST['code'] = 404;
	require_once 'error.php';
}
$product_details = products(" WHERE `id` LIKE '".base64_decode($_GET['id'])."' ");
if (!isset($product_details[0]['name'])) {
	$_POST['code'] = 404;
	require_once 'error.php';
}else{
	$product_details = $product_details[0];
?>
<div class="container" style="background: white;">
	<div id="productView" class="pdp-block my-5">
		<div class="pdp-block align-items-center d-flex flex-wrap pdp-block__main-information">
			<div class="col-lg-4 col-sm-10 my-3" style="min-width: 300px;">
				<div class="col-lg-12  w-100">
					<div class="product-image-slider w-100" style="height: 400px;">
						<script type="text/javascript">
							imageSlider(
								document.querySelector('.product-image-slider'),
								[
									<?php 
									foreach ($product_details['pics'] as $pic) {
										echo "`$pic`,";
									}
									 ?>
								],
								[],
								{
									dots: false,
									buttons: false,
									interval: 3000,
									expand: true
								}
							);
						</script>
					</div>
				</div>
			</div>
			<div class="col-lg-6  col-sm-12 px-5">
				<div class="container" style="color: #212121; overflow-wrap: break-word;">
					<div style="font-size: 22px; font-family: sans-serif; font-weight: 400;"><?php echo $product_details['name'] ?></div>
				</div>
				<div class="container pt-2">
					<div class="d-flex flex-wrap ratings align-items-center">
						<div>
							<?php 
								$review_count = 0;
								$review_persons = 0;
								$reviews = productReviews($product_details['id']);
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
								}else{
									echo "No reviews yet. ";
								}
							 ?>
						</div>
						<span><?php echo $review_persons; ?> ratings</span>
						<span class="ms-auto">
							<span><?php echo t(56)[$l]; ?>: 
								<?php 
								$categories_of_product =  categories($product_details['category']);
								if (isset($categories_of_product[0]['name'])) {?>
								<a style="color:inherit;" href="categories?id=<?php echo urlencode(base64_encode($categories_of_product[0]['id'])); ?>">
									<b>
										<?php 
										echo ($categories_of_product[0]['name']);
										?>
									</b>
								</a>
								<?php } ?>
							</span>
						</span>
					</div>
				</div>
				<div class="container pt-2">
					<div class="d-flex flex-wrap align-items-center">
						<div style="font-size: 12px;">
							<?php 
							if ($product_details['brand'] == "") {
								echo "No Brand";
							}else{
								echo "Brand: ".$product_details['brand'];
							}
							 ?>.
						</div>
						<div style="padding-left: 8px; font-size: 12px;">
							<?php 
							if ($product_details['writter'] == "") {
								echo "No Brand";
							}else{
								echo "Writter: ".$product_details['writter'];
							}
							 ?>.
						</div>
						<div style="padding-left: 8px; font-size: 12px;">
							Posted By: <?php 
							$add_by = user($product_details['added_by']);
							if (isset($add_by['fname'])) {
								echo $add_by['fname']." ".$add_by['lname']." (".$product_details['added_by'].")";
							}
							 ?>
						</div>
					</div>
				</div>
				<hr class="me-3">
				<div class="container  pt-1" style="color:#f57224;">
					<h2>
						<?php echo $site_currency_icon.$product_details['prize']; ?>
					</h2>
				</div>
				<hr class="me-3">
				<div class="container py-3 text-muted" style="font-size: 12px; font-family: sans-serif;">
					<?php echo $product_details['total'];?>PCS <?php echo t(66)[$l]; ?> <?php echo $product_details['sells'];?>PCS
				</div>
				<div class="container pt-1 text-secondary">
					<?php if ($product_details['COD'] == "1") {
						echo "<i class=\"fas fa-person-booth\"></i> ".t(57)[$l];
					}else{
						echo "<i class=\"fas fa-file-invoice-dollar\"></i> ".t(58)[$l];
					} ?>
				</div>
				<form method="POST" class="container pt-4" action="/pay-now" style="color:#f57224;">
					<div>
						<label class="d-flex flex-wrap align-items-center justify-content-between">
							<span class="col-sm-4"><?php echo t(59)[$l]; ?>: </span>
							<input class="col-sm-8" style="border: 1px solid #f57224;color:#f57224; padding: 4px 16px;" type="number" min="1" required value="1" name="quantity">
						</label>
					</div>
					<div class="pt-2 justify-content-between d-flex align-items-center flex-wrap">
						<button class="add-to-cart-btn btn col-sm-5 me-1" type="submit" name="to_cart" value="<?php echo $product_details['id']; ?>">
							<?php echo t(60)[$l]; ?>
						</button>
						<button class="order-now-btn btn col-sm-6 ms-1" value="<?php echo $product_details['id']; ?>" type="submit" name="to_pay">
							<?php echo t(61)[$l]; ?>
						</button>
					</div>
				</form>
			</div>
		</div>
		<div class="container py-3">
			<span style="font-size:17px;"><?php echo t(62)[$l]; ?></span>
			<hr>
			<div>
				<ul class="d-flex flex-wrap justify-content-between"><?php 
					foreach (explode("\n", $product_details['description']) as $details) {
						?> 
					<li class="col-sm-10"><?php 
						echo "<span style=\"font-size: 13px; color: #f57224;\">".$details."</span><br>";
					 ?></li>
					<?php
					}
				 ?></ul>
			</div>
			<div class="my-3">
				<h6><?php echo t(63)[$l]; ?></h6>
				<hr>
				<?php 
				$reviews = productReviews($product_details['id']);
				if (count($reviews) > 0) {
					echo '<table class="table">
							<tbody>';
					foreach ($reviews as $review) {
						?>
						<tr>
							<td class="pb-3 pt-2">
								<div class="review-user-text">
									<?php
									for ($i=0; $i < $review['review']; $i++) { 
										echo '<i style="color: orange" class="fas fa-star"></i>';
									}
									for ($i=0; $i < (5 - $review['review']); $i++) { 
										echo '<i style="color: orange" class="far fa-star"></i>';
									}
									$this_user = user($review['user_id']);
									 if (isset($this_user['fname'])) {
										echo "<br><i style='font-size: 12px;'>By, ".$this_user['fname']."</i><br>";
									} ?>
									<div class="pt-2">
										<?php echo $review['review_user']; ?>
									</div>
									<div class="py-2" style="font-size: 12px;">
										<?php echo " - ".$review['review_admin']; ?>
									</div>
								</div>
								<div class="review-admin-text"></div>
							</td>
						</tr>	
						<?php
					}
					echo '</tbody>
						</table>';
				}else{
					echo t(65)[$l]."<br><br>";
				}

				 ?>
			</div>
			<h6><?php echo t(64)[$l]; ?></h6>
			<hr>
			<div class="d-flex flex-wrap">
				<?php 
				$audition = 0;
				$count = count($product_details['pics']);
				if ($count%2 == 1) {
					$x3 = true;
				}else{
					$x3 = false;
				}
				foreach ($product_details['pics'] as $pic) {
					if ($x3 && $audition < 3) {
					?>
					<div class="col-lg-4 p-2">
						<img src='<?php echo $pic; ?>'>
					</div>
					<?php
					}else{
					?>
					<div class="col-lg-6 p-2">
						<img src='<?php echo $pic; ?>'>
					</div>
					<?php
					}
					?>
				
				<?php
				if ($audition >= 4) {
					$audition = 0;
				}else{
					$audition++;
				}
				
				}
				?>
			</div>
		</div>
	</div>
</div>


<?php }

