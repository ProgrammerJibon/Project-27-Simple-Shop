<?php 
require_once 'item-banner.php';
?>
<div class="container py-5 text-center" style="color: orange;">
	<h4><?php echo t(34)[$l]; ?></h4>
	<hr>
</div>
<div class="d-flex flex-wrap justify-content-center container">
	
	<?php 
		foreach (products() as $key) {
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
		<div class="text-center py-2 px-1">
			<a style="text-decoration: none; color: unset;" href="/product?id=<?php 
				echo urlencode(base64_encode($key['id']));
			 ?>">
				<?php echo substr($key['name'], 0, 50); ?>
			</a>
		</div>
		<div class="text-center py-2 fs-5 px-1" style="color: orange;">
			<?php echo $site_currency_icon.substr($key['prize'], 0).".00"; ?>
		</div>
		<div class="text-center pb-2 px-1" style="color: orange;font-size: 11px;">
			<?php 
				$review_count = 0;
				$reviews = productReviews($key['id']);
				if (count($reviews) > 0) {
					foreach ($reviews as $review) {
						$review_count += $review['review'];
					}
					for ($i=0; $i < round($review_count/count($reviews)); $i++) { 
						echo '<i class="fas fa-star"></i>';
					}
					for ($i=0; $i < (5 - round($review_count/count($reviews))); $i++) { 
						echo '<i class="far fa-star"></i>';
					}
				}
			 ?>
		</div>
	</div>
		 							
	<?php
		}
	 ?>
</div>
<div class="container py-5 text-center" style="color: orange;">
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