<?php require_once 'header.php'; ?>
<div class="my-5 container">
	<h3><?php echo t(24)[$l]; ?> </h3>
	<span style="color: red;"><?php echo t(25)[$l]; ?></span>
	<br><br>
	<form method="POST" class="add-addreess col-sm-12 w-100">
		<div class="col-sm-5  d-flex flex-wrap">
			<div>
				<select required name="country" class="btn btn-primary col-sm-6 form-control" onchange="add_city(this.value)" style="text-align: left;">
					<option selected disabled value="0"><?php echo t(26)[$l]; ?></option>
					<?php 
						foreach (mysqli_query($connect, "SELECT * FROM `countries` ORDER BY `countries`.`id` ASC") as $key) {
							echo '<option value="'.$key['id'].'">'.$key['name'].'</option>';
						}

					 ?>
				</select>
			</div>
			<div>
				<select required name="city" onchange="" class="select-city btn btn-primary col-sm-5 form-control" style="display: none;text-align: left;">
				<option selected disabled value="0"><?php echo t(27)[$l]; ?></option>
			</select>
			</div>
		</div>
		<div class="py-2 col-sm-5 d-none">
			<input class="col-sm-6" name="product_quantity" title="quantity" value="<?php echo $quantity_count; ?>" style="text-align: left;">
			<input class="col-sm-5" name="product_id" title="product id" value="<?php echo $product_id; ?>"  style="text-align: left;">
		</div>
		<div class="py-2 col-sm-5">
			<textarea class="col-sm-11 form-control" required placeholder="<?php echo t(13)[$l]; ?>" name="addreess"></textarea>
		</div>
		<div class="col-sm-5 d-flex flex-wrap">
			<div class="col-sm-8">
				<input class="form-control" name="number" required title="<?php echo t(15)[$l]; ?>" placeholder="<?php echo t(15)[$l]; ?>"  style="text-align: left;">
			</div>
			<div class="col-sm-4">
				<input class="form-control" name="post_code" required title="Post code" placeholder="Post Code" style="text-align: left;">
			</div>			
			
		</div>

		<div class="py-2 col-sm-5">
			<input class="col-sm-11 form-control" type="text" name="voucher" title="Coupon Code"  placeholder="Coupon code (Optional)*">
		</div>
		<div class="py-2 col-sm-5">
			<button class="btn btn-warning col-sm-12 mt-3" type="submit" value="<?php if(isset($_POST['cart_number'])){echo $_POST['cart_number'];} ?>"><?php echo t(32)[$l]; ?></button>
		</div>
		<div class="col-sm-5">
			<font color="#950318" style="font-family: sans-serif;">*Note that order total ammount (price x quantity) must be x1.5 times bigger than coupon value.</font>
		</div>
	</form>
</div>
<script type="text/javascript">
function add_city(id){
	var selectCity = document.querySelector('.add-addreess .select-city');
	loadLink('/manage.php', [['cities',id],['bool','false']]).then(result=>{
		if (result.cities) {
			var dataState = result.cities;
			selectCity.style.display = 'inline';
			selectCity.innerHTML = '<option selected disabled value="0">Select your state</option>';
			dataState.forEach(cityState=>{
				selectCity.innerHTML += `<option value="${cityState.name}">${cityState.name}</option>`;
			})
		}		
	});
}
</script>
<?php require_once 'footer.php'; ?>