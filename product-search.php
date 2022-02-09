<?php 
if (isset($_GET['search']) && $_GET['search'] !== "") {
	$search = (strtolower(addslashes($_GET['search'])));
?>
<div class="container pt-5 pb-2 text-center" style="color: orange;">
	<h4><?php echo t(55)[$l]; ?> <?php echo ucwords($search); ?></h4>
	<hr>
</div>
<div class="d-flex flex-wrap justify-content-center container">
	
	<?php 
	$resutl = mysqli_query($connect, "SELECT * FROM `products` WHERE `name` LIKE '%{$search}%' OR  `description` LIKE '%{$search}%'  OR  `brand` LIKE '%{$search}%'   OR  `writter` LIKE '%{$search}%' ORDER BY `id` DESC");
	if (mysqli_num_rows($resutl) > 0) {
		foreach ($resutl as $key) {
			if ($key['type'] == "REMOVED") {
				continue;
			}
			$key['pics'] = explode("\n", $key['pics']);
	?>
	<div class="col-lg-2 mx-3  my-2 product-grid col-sm-6" onclick="window.location.assign('/product?id=<?php 
				echo urlencode(base64_encode($key['id']));
			 ?>')" title="<?php echo $key['name']; ?>">
		<div class="product-image">
			<a href="/product?id=<?php 
				echo urlencode(base64_encode($key['id']));
			 ?>">
				<img src="<?php if(isset($key['pics'])){
					echo $key['pics'][0];
				}else{
					echo "now";
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
					}else{
						echo "No reviews yet";
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
		$_POST['code'] = 204;
		$_POST['for_error'] = ucwords($search);
		require_once 'error.php';
	}
	 ?>
</div>
<?php
}else{
	$_POST['code'] = 500;
	require_once 'error.php';
}