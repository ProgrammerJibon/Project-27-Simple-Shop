<?php 
$edit_product_id = $_POST['edit_product'];
$product_details = products(" WHERE `id` LIKE '".$edit_product_id."' ")[0];
?>
<div class="container my-5">
	<h5>Edit product</h5>
	<div class="editor_category pb-5">
		<form method="POST" class="form form-group " enctype="multipart/form-data">
			<div class="flex-wrap">
				<font style="color: gray; font-size: 12px; font-family: sans-serif;">
					Product Name:
				</font>
				<div class="col-sm-12 pb-2">
					<input class="form-control" autocomplete="off" value="<?php echo $product_details['name']; ?>" placeholder="Product Name" type="text"  name="name">
				</div>
				<div class="col-sm-12 pb-2">
					<font style="color: gray; font-size: 12px; font-family: sans-serif;">
						Category:
					</font>
					<select class="form-control"  autocomplete="off" name="category">
						<option selected disabled value="0">Select Category</option>
						<?php 
						foreach (categories() as $key) {
							?>
						<option value="<?php echo $key['id']; ?>" <?php 
						if ($product_details['category'] == $key['id']) {
							echo "selected";
						}
						 ?>><?php echo $key['name']; ?></option>
							<?php
						}
						 ?>
					</select>
				</div>
				<div class="col-sm-12 pb-2">
					<div>
						<font style="color: gray; font-size: 12px; font-family: sans-serif;">
							Images:
						</font>
					</div>
					<div>
						<?php foreach ($product_details['pics'] as $key) {
							echo '<img style="height: 200px; width: auto;border:1px solid lightgray; margin: 8px;" src="'.$key.'">';
						} ?>
					</div>
					<input class="form-control" autocomplete="off" placeholder="" type="file" multiple name="pics[]">
					<font style="color: red; font-size: 12px; font-family: sans-serif;">
						* note that, if you select image, old images will be replaced with new images
					</font>
				</div>
				<div class="col-sm-12 pb-2">
					<div>
						<font style="color: gray; font-size: 12px; font-family: sans-serif;">
							Price and Quantity:
						</font>
					</div>
					<div class="col-sm-12 w-75 d-flex flex-wrap">
						<div class="col-sm-6">
							<input class="form-control" autocomplete="off" placeholder="Price" type="number" step="0.0000001"  name="price" value="<?php echo $product_details['prize']; ?>">
						</div>
						<div class="col-sm-6">
							<input class="form-control" autocomplete="off" placeholder=" pieces" type="number"  name="stock"  value="<?php echo $product_details['total']; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 flex-wrap">
				<div>
					<font style="color: gray; font-size: 12px; font-family: sans-serif;">
						Product description:
					</font>
				</div>
				<div class="col-sm-8 pb-2">
					<textarea style="min-height: 200px" name="desc" placeholder="Description &#10; Example: &#10; Cover: cotton &#10; For: child &#10; More Desc: ..." class="form-control"><?php echo $product_details['description']; ?></textarea>
				</div>
				<div>
					<font style="color: gray; font-size: 12px; font-family: sans-serif;">
						Library (Optional):
					</font>
				</div>
				<div class="col-sm-4">
					<div class="col-sm-6">
						<input class="form-control" autocomplete="off" placeholder=" Library (Optional)" type="text"  name="by_company"  value="<?php echo $product_details['brand']; ?>">
					</div>
				</div>
				<div>
					<font style="color: gray; font-size: 12px; font-family: sans-serif;">
						Writter Name (Optional):
					</font>
				</div>
				<div class="col-sm-4 pb-5">
					<div class="col-sm-6">
						<input class="form-control" autocomplete="off" placeholder=" Writter (Optional)" type="text"  name="writter"  value="<?php echo $product_details['writter']; ?>">
					</div>
				</div>
			</div>
			<div class="d-flex pb-2">
				<div class="col-sm-2 d-flex">
					<button type="submit" value="<?php echo $edit_product_id; ?>" name="edit_submit_product" class="btn col-sm-12 btn-success me-2">
						Update
					</button>
					<button type="submit" value="<?php echo $edit_product_id; ?>" name="cancel_edit_product" class="btn col-sm-12 btn-outline-warning">
						Cancel
					</button>
				</div>
			</div>
		</form>
	</div>
</div>