<?php 
if (!isset($user_data) || $user_data['email'] == false) {
	$user_data = user($_SESSION['user_id']);
}
if (isset($user_data['status']) && $user_data['status'] != "VERIFIED") {

	
?>
<div class="container">
	<form method="POST" class="card shadow p-3 mt-5 mb-5 bg-white rounded" style="max-width: 600px; margin: 0 auto;">
		<h5 class="container mt-2"><?php echo t(20)[$l]; ?></h5>
		<div class="container">
			<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
			<?php 
				if ($error != "") {
					$error = '<ol style="list-style: square;" class="alert alert-danger col-sm-12 px-5">'.$error.'</ol>';
					echo $error;
				}
				if (isset($_POST['resent_code'])) {
					if (send_code()) {
						echo "A code has been sent";
					}else{
						echo "Server is busy now. Try again later.";
					}
				}	

			 ?>
			</div>
			<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
				<label for="email" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(16)[$l]; ?></label>
				<div class="col-sm-8">
					<input disabled type="email" class="form-control form-control-sm"  value="<?php if (isset($user_data['email']) && $user_data['email'] != false) { echo $user_data['email'];} ?>" id="email" name="email">
				</div>
			</div>
			<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
				<label for="code" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(21)[$l]; ?></label>
				<div class="col-sm-8">
					<input type="number" class="form-control form-control-sm" id="code" minlength="6" maxlength="7"  name="code">
				</div>
			</div>
			<div class="form-row d-flex flex-wrap mb-4 mt-3 mx-5 align-items-center justify-content-between">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-3">
					<button type="submit" name="resent_code" class="btn col-sm-12 btn-secondary"><?php echo t(22)[$l]; ?></button>
				</div>
				<div class="col-sm-4">
					<button type="submit" name="submit_code" class="btn col-sm-12 btn-primary"><?php echo t(23)[$l]; ?></button>
				</div>
			</div>
		</div>
	</form>
	<br>
</div>
<?php }else{
	if (isset($user_data) && ($user_data['type'] == "ADMIN"  || $user_data['type'] == "BRAIN")) {
		require_once 'panel_admin.php';
	}else{
		require_once 'panel_user.php';
	}
} ?>