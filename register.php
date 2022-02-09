<?php 

?>
<div class="container">
	<form method="POST" class="card shadow p-3 mt-5 mb-5 bg-white rounded" style="max-width: 550px; margin: 0 auto;">
		<h5 class="container mt-2"><?php echo t(67)[$l]; ?></h5>
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
				<label for="fname" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(48)[$l]; ?></label>
				<div class="col-sm-8">
					<input required type="text" class="form-control form-control-sm" autofocus minlength="3" maxlength="15" id="fname" value="<?php if (isset($_POST['fname'])) { echo $_POST['fname'];} ?>" name="fname">
				</div>
			</div>
			<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
				<label for="lname" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(49)[$l]; ?></label>
				<div class="col-sm-8">
					<input required type="text" class="form-control form-control-sm"  value="<?php if (isset($_POST['lname'])) { echo $_POST['lname'];} ?>" minlength="3" maxlength="15"  id="lname" name="lname">
				</div>
			</div>
			<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
				<label for="sex" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(54)[$l]; ?></label>
				<div class="col-sm-8 form-group">
					<select type="select" class="form-select form-select-sm" id="sex" required name="sex">
						<option disabled value="0"> <?php if (!isset($_POST['sex'])) { echo "selected";} ?>>Select</option>
						<option <?php if (isset($_POST['sex']) && $_POST['sex'] == "1") { echo "selected";} ?> value="1"><?php echo t(50)[$l]; ?></option>
						<option <?php if (isset($_POST['sex']) && $_POST['sex'] == "2") { echo "selected";} ?>  value="2"><?php echo t(51)[$l]; ?></option>
						<option <?php if (isset($_POST['sex']) && $_POST['sex'] == "3") { echo "selected";} ?>  value="3"><?php echo t(52)[$l]; ?></option>
					</select>
				</div>
			</div>
			<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
				<label for="birth" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(53)[$l]; ?></label>
				<div class="col-sm-8">
					<input required type="date" value="<?php if (isset($birth)) { echo $birth;}else{echo date("Y-m-d", (time() - (18*365.25*24*60*60)));} ?>" class="form-control form-control-sm" id="birth" name="birth">
				</div>
			</div>
			<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
				<label for="email" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(38)[$l]; ?></label>
				<div class="col-sm-8">
					<input required type="email" class="form-control form-control-sm"  value="<?php if (isset($_POST['email'])) { echo $_POST['email'];} ?>" minlength="8" maxlength="40" id="email" name="email">
				</div>
			</div>
			<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
				<label for="password" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(39)[$l]; ?></label>
				<div class="col-sm-8">
					<input required type="password" class="form-control form-control-sm" id="password"  minlength="8" maxlength="64"  name="password">
				</div>
			</div>
			<div class="form-row d-flex flex-wrap  mx-5 justify-content-between">
				<div class="d-flex align-items-center">
					<input value="1" required type="checkbox" class="mx-1" id="radio" name="radio">
				</div>
				<label for="radio" class="col-form-label col-form-label-sm">
					<small><?php echo t(68)[$l]; ?></small>
				</label>
			</div>
			<div class="form-row d-flex flex-wrap mb-4 mt-3 mx-5 align-items-center justify-content-between">
				<div class="col-sm-3">
					<a href="/login" class="btn col-sm-12 btn-secondary"><?php echo t(41)[$l]; ?></a>
				</div>
				<div class="col-sm-1" style="text-align: center;">
					<span>or</span>
				</div>
				<div class="col-sm-8">
					<button type="submit" name="register" class="btn col-sm-12 btn-primary"><?php echo t(40)[$l]; ?></button>
				</div>
			</div>
		</div>
	</form>
	<br>
</div>