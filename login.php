<?php 

?>
<div class="container">
	<form method="POST" class="card shadow p-3 mt-5 mb-5 bg-white rounded" style="max-width: 550px; margin: 0 auto;">
		<h5 class="container mt-2"><?php echo t(37)[$l]; ?></h5>
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
				<label for="email" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(38)[$l]; ?></label>
				<div class="col-sm-8">
					<input required type="email" class="form-control form-control-sm"  value="<?php if (isset($email)) { echo $email;} ?>" minlength="8" maxlength="40" id="email" name="email">
				</div>
			</div>
			<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
				<label for="password" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(39)[$l]; ?></label>
				<div class="col-sm-8">
					<input required type="password" class="form-control form-control-sm" id="password"  minlength="8" maxlength="64"  name="password">
				</div>
			</div>
			<div class="form-row d-flex flex-wrap mt-3 mx-5 align-items-center justify-content-between">
				<div class="col-sm-3">
					<a href="/register" class="btn col-sm-12 btn-secondary"><?php echo t(40)[$l]; ?></a>
				</div>
				<div class="col-sm-1" style="text-align: center;">
					<span>or</span>
				</div>
				<div class="col-sm-8">
					<button type="submit" name="login" class="btn col-sm-12 btn-primary"><?php echo t(41)[$l]; ?></button>
				</div>
			</div>
			<div class="form-row text-center p-3 mb-2 flex-wrap" style="font-size: 13px;">
				Did you <a href="forgot-password">forgot</a> your password? 
			</div>
		</div>
	</form>
	<br>
</div>