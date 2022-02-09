<div class="container">
	<form method="POST" class="card shadow p-3 mt-5 mb-5 bg-white rounded" style="max-width: 550px; margin: 0 auto;">
		<h5 class="container mt-2"><?php echo t(37)[$l]; ?></h5>
		<div class="container">
			<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
				<?php 
					if (isset($_POST['forgot_send']) && isset($_POST['email'])) {
						$user_data = user($_POST['email']);
						if (isset($user_data['id']) && $user_data['id'] != false) {
							$_SESSION['forgot_email'] = strtolower($user_data['email']);
							$_SESSION['forgot_key'] = rand(10000000, 99999999);
							$message = "Your verfication code for ".$_SESSION['site_name']." is <b>".$_SESSION['forgot_key']."</b>";
							if (sent_mail($user_data['email'], $user_data['fname'], $message, "Verfication Code")) {
								echo "A code has been sent to your email";
							}else{
								echo "Server is unavailable to sent email";
							}
						}else{
							echo "No email found";
						}
					}elseif (isset($_POST['forgot_submit']) && isset($_POST['email']) && isset($_POST['code'])) {
						if (strtolower($_POST['email']) == $_SESSION['forgot_email'] && $_POST['code'] == $_SESSION['forgot_key']) {
							$user_data = user($_POST['email']);
							$sl_pass = bin2hex(openssl_random_pseudo_bytes(4));;
							if (isset($user_data['id']) && $user_data['id'] != false && mysqli_query($connect, "UPDATE `users` SET `pass` = '".md5((strip_tags(addslashes($sl_pass))))."' WHERE `users`.`id` = '".$user_data['id']."'")) {
								$message = "Your new password for ".$_SESSION['site_name']." is <b>".$sl_pass."</b><br>You can change your password on Profile Settings";
								if (sent_mail($user_data['email'], $user_data['fname'], $message, "New Password")) {
									echo "Your new password has been sent to your email";
								}else{
									echo "Server is unavailable to sent email";
								}
							}
						}else{
							echo "invalid code";
						}
					}
				?>
			</div>
			<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
				<label for="email" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(38)[$l]; ?></label>
				<div class="col-sm-8">
					<input required type="email" autocomplete="off" class="form-control form-control-sm"  value="<?php if (isset($_POST['email'])) { echo $_POST['email'];} ?>" minlength="8" maxlength="40" id="email" name="email">
				</div>
			</div>
			<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
				<label for="password" class="col-sm-4 col-form-label col-form-label-sm">Code</label>
				<div class="col-sm-8">
					<input type="pin" autocomplete="off" class="form-control form-control-sm" id="password"  minlength="8" maxlength="64"  name="code">
				</div>
			</div>
			<div class="form-row d-flex flex-wrap mb-4 mt-3 mx-5 align-items-center justify-content-between">
				<div class="col-sm-5">
					<button type="submit" name="forgot_send" class="btn col-sm-12 btn-primary">Send Code</button>
				</div>
				<div class="col-sm-1"></div>
				<div class="col-sm-6">
					<button type="submit" name="forgot_submit" class="btn col-sm-12 btn-primary">Submit</button>
				</div>
			</div>
		</div>
	</form>
	<br>
</div>