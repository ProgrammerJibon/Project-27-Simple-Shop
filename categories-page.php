<?php 
if (isset($_GET['id'])) {
	$id = addslashes(base64_decode($_GET['id']));
	if (isset(categories($id)[0]['name'])) {
		?><h1 class="text-center py-5">
			<?php echo categories($id)[0]['name']; ?>
		</h1><?php
	}

 ?>
<div class="d-flex flex-wrap justify-content-center container">
	
	<?php 
		
		$products = products(" WHERE `category` = '$id' ");
		if (count($products) > 0) {
			
		foreach ($products as $key) {
	?>
	<div class="col-lg-2 mx-3  my-2 product-grid col-sm-6" onclick="window.location.assign('/product?id=<?php 
				echo urlencode(base64_encode($key['id']));
			 ?>')">
		<div class="product-image">
			<a href="/product?id=<?php 
				echo urlencode(base64_encode($key['id']));
			 ?>">
				<img src="<?php if(isset($key['pics'])){
					echo $key['pics'][0];
				}?>">
			</a>
		</div>
		<div class="product-details">
			<div class="text-center py-2 px-1" style="font-weight: bold; font-size: 14px;">
				<a style="text-decoration: none; color: unset;" href="/product?id=<?php 
					echo urlencode(base64_encode($key['id']));
				 ?>">
					<?php echo substr($key['name'], 0, 50); ?>
				</a>
			</div>
			<div class="text-center px-1" style="font-size: 11px; color: gray;">
				<?php 
				if (isset($key['writter']) && $key['writter'] != "") {
					echo "Written By: ".$key['writter'];
				}

				 ?>
			</div>
			<div class="text-center py-2 fs-5 px-1" style="color: orange;">
				<?php echo $site_currency_icon.substr($key['prize'], 0).".00"; ?>
			</div>
			<div class="text-center pb-2 px-1" style="color: orange;font-size: 11px;">
					<?php 
					$review_count = 0;
					$reviews = productReviews($key['id']);
					foreach ($reviews as $review) {
						$review_count += $review['review'];
					}
					if ($review_count > 0) {
						for ($i=0; $i < round($review_count/count($reviews)); $i++) { 
							echo '<i class="fas fa-star"></i>';
						}
						for ($i=0; $i < (5 - round($review_count/count($reviews))); $i++) { 
							echo '<i class="far fa-star"></i>';
						}
					}
						
				 ?>
			</div>
			<?php if ($key['description'] !== "") {
				$key['description'] = substr($key['description'], 0, 261);
   				$key['description'] = substr($key['description'], 0, strrpos($key['description'], ' '));
				echo '<div class="product_floating_desc">'.filter_namex("\n", "<br>", strip_tags($key['description']))."...</div>";
			} ?>
		</div>
	</div>
		 							
	<?php
		}
		}else{
			?>
				<div class="container text-center pb-5">
					<?php echo t(28)[$l]; ?>
				</div>
			<?php
		}
	 ?>
</div>
<?php 
		} ?>


<h3 class="text-center pt-5"><?php echo t(29)[$l]; ?></h3>
<div class="d-flex flex-wrap justify-content-center container">
	<?php 
	$counter_attack = 0;
	$cat = mysqli_query($connect, "SELECT * FROM `categories` ORDER BY RAND() LIMIT 6");
	foreach ($cat as $key) {
		if ($counter_attack >= 6) {
			break;
		}
		?>
		<div class="col-sm-4 p-3">
			<a href="/categories?id=<?php 
				echo urlencode(base64_encode($key['id']));
			 ?>" target="_top" style="width: 100%; height: 100%">
				<img src="<?php 
					echo $key['cover'];
	 			?>">				
			</a>
		</div>
		<?php
		$counter_attack++;
	} ?>
</div>