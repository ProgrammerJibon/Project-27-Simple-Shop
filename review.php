<?php 
if (isset($user_data) && isset($_GET['on'])) {
$datas = orders("WHERE `id` = '".addslashes($_GET['on'])."'");
if (isset($_POST['post_review']) && ($user_data['type'] == "BRAIN" || $user_data == "ADMIN")) {
	if (mysqli_query($connect, "UPDATE `orders` SET `review_admin` = '".$_POST['review']."' WHERE `orders`.`id` = '".addslashes($_GET['on'])."'")) {
		header("Location: /review?on=".$_GET['on']);
	}
}elseif (isset($_POST['post_review'])) {
	if (mysqli_query($connect, "UPDATE `orders` SET `review_user` = '".$_POST['review']."', `review_star` = '".$_POST['stars']."', `review_time` = '".time()."' WHERE `orders`.`id` = '".addslashes($_GET['on'])."'")) {
		header("Location: /review?on=".$_GET['on']);
	}
}
require_once( 'header.php');
?>
<div class=" container py-5">
<table class="table  table-striped">
	<tbody>
		<?php 
		$my_odrers = $datas;
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
										<div><?php echo t(44)[$l]; ?>: <b><?php echo $site_currency_icon.$key['product_price']; ?></b></div>
										<div><?php echo t(59)[$l]; ?>: <b><?php echo "x".$key['quantity']; ?></b></div>
										<div><?php echo t(45)[$l]; ?>: <b><?php echo $site_currency_icon.$key['product_price']*$key['quantity']; ?></b></div>
										<div>Ordered on: <b><?php echo date("M d, Y - H:iA",$key['time']); ?></b></div>
									</div>
								</div>
							</div>
						</div>
						<?php 
						if ($key['review_user'] == "" && $user_data['type'] == "USER") {
							
						
						?>

						<div>
							<form method="POST" class="container py-5 d-flex flex-wrap align-items-center justify-content-center">
								<div style="color:orange; font-size: 30px; padding-right: 16px;">
									<i onclick="starClicked(0)" class="startsReview fas fa-star"></i>
									<i onclick="starClicked(1)" class="startsReview fas fa-star"></i>
									<i onclick="starClicked(2)" class="startsReview fas fa-star"></i>
									<i onclick="starClicked(3)" class="startsReview fas fa-star"></i>
									<i onclick="starClicked(4)" class="startsReview fas fa-star"></i>
								</div>
								<div>
									<input class="startsReviewClass" type="hidden" name="stars" value="5">
									<input required type="text" maxlength="255" name="review" placeholder="Leave your review">
								</div>
								<div>
									<button type="submit" name="post_review" value="<?php echo $key['id']; ?>" class="btn btn-outline-primary w-100">POST</button>
							</form>
							<script type="text/javascript">
								function starClicked(upto){
									var startsReview = document.querySelectorAll("form .startsReview");
									var startsReviewClass = document.querySelector("form .startsReviewClass");
									startsReview.forEach((item, id)=>{
										if (upto < id) {
											item.classList.add("far");
											item.classList.remove("fas");
										}else{
											item.classList.remove("far");
											item.classList.add("fas");
										}
									});
									startsReviewClass.value = upto+1;
								}
							</script>
							<style type="text/css">
								.startsReview{
									cursor: pointer;
								}
							</style>
						</div>
						<?php
						}else{
							echo "<div style='color: orange'>";
							for ($i=0; $i < $key['review_star']; $i++) { 
								echo '<i class="fas fa-star"></i>';
							}
							for ($i=0; $i < (5-$key['review_star']); $i++) { 
								echo '<i class="far fa-star"></i>';
							}
							if ($user_data['type'] == "USER" && $key['review_user'] != "") {
								echo "<div>Your review: <b>".$key['review_user']."</b></div>";
								echo "<div>Seller review: <b>".$key['review_admin']."</b></div>";
							}elseif ( $key['review_user'] != "") {
								echo "<div>Customer review: <b>".$key['review_user']."</b></div>";
								echo "<div>Your review: <b>".$key['review_admin']."</b></div>";
							}
							echo "</div>";
						}
						if (($user_data['type'] == "BRAIN" || $user_data == "ADMIN")) {
							if ($key['review_user'] != "") {
							?>
							<form method="POST" class="container py-5 d-flex flex-wrap align-items-center justify-content-center">
								<div>
									<input required type="text" maxlength="255" name="review" placeholder="Leave your review">
								</div>
								<div>
									<button type="submit" name="post_review" value="<?php echo $key['id']; ?>" class="btn btn-outline-primary w-100">POST</button>
							</form>

							<?php
								
							}else{
								echo "You will avail to leave your review reply once user post their review.";
							}
						}
						 ?>
					</td>
				<?php
				echo "</tr>";
			}}else{
				echo "You didn't make this order";
			} ?>
	</tbody>
</table>
</div>

<?php
require_once( 'footer.php');
}else{
	$_POST['code'] = 404;
	require_once 'error.php';
}