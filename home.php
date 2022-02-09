<?php 
require_once 'item-banner.php';
?>
<div class="container py-5 text-center" style="color: #c33200">
	<h4><?php echo t(34)[$l]; ?></h4>
	<hr>
</div>
<div class="d-flex flex-wrap justify-content-center container">
	
	<?php 
		foreach (products() as $key) {
			if ($key['type'] == "REMOVED") {
				continue;
			}
	?>
	<div class="col-lg-2 mx-3  my-2 product-grid col-md-3" onclick="window.location.assign('/product?id=<?php 
				echo urlencode(base64_encode($key['id']));
			 ?>')">
		<div class="product-image" style="background: url(<?php if(isset($key['pics'])){
					echo $key['pics'][0];
				}?>);">
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
					<?php echo $key['name']; ?>
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
				<?php echo "<font style='font-size: 15px;'>$site_currency_icon</font><font style='font-size: 30px;'>".substr($key['prize'], 0)."</font>"; ?>
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
						for ($i=0; $i < 5; $i++) { 
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
	 ?>
</div>
<div class="container py-5 text-center" style="color: #c33200">
	<h4><?php echo t(35)[$l]; ?></h4>
	<hr>
</div>
<div class="d-flex flex-wrap justify-content-center container">
	<?php foreach (categories() as $key) {
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
	} ?>
</div>
<div style="background: white;" class="mt-5">
	<div class="container py-5 d-flex flex-wrap justify-content-center align-items-center">
		<div class="col-lg-6">
			<img src="/cdn/old-books-with-a-lamp-PRFVCWX.jpg">
		</div>
		<div class="col-lg-6 row">
			<h6>
				<i style="color:#d78f41; font-size: 20px;">The First In Europe</i>
			</h6>
			<h2 class="py-2">
				<b><?php echo strtoupper(t(2)[$l]); ?></b>
			</h2>
			<span class="text-secondary py-2">
				It is an Arabic book library that was founded in 2016. 
				The aim of the library is to have the Arabic language available in several areas (Arabic and international novels for adults - books on human.
			</span>
			<a href="/about" class ="btn btn-success d-inline w-auto m-3">
				<?php echo t(36)[$l]; ?>
			</a>
		</div>
	</div>
</div>
