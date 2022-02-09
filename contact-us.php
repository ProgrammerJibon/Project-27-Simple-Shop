<?php 
if (isset($_POST['contact_submit']) && isset($_POST['fname']) && isset($_POST['email']) && isset($_POST['message'])) {
	// sent_mail($to = null, $fname = null, $message = null, $subject = null, $reply_to_this = null);
	$new_contact_mail_send = users("WHERE `type` = 'BRAIN'");
	foreach ($new_contact_mail_send as $key) {
		$message = "<h3>Via Contact Us</h3><br> Name: <b>".ucwords(strtolower(addslashes(strip_tags($_POST['fname']))))."</b> <br>Email: <b>".(strtolower(addslashes(strip_tags($_POST['email']))))."</b><br>Message: <i><pre>\t".((addslashes(strip_tags($_POST['message']))))."</pre></i><br><br><b>Just reply to this mail or copy the email for reply<b>";
		if (sent_mail($key['email'], $key['fname'], $message, "User Contact", (strtolower(addslashes(strip_tags($_POST['email'])))))) {
			header("Location: /contact&submited=true");
		}else{
			header("Location: /contact&submited=false");
		}
	}
	exit();
}
else{
	require_once( 'header.php');
}
 ?>
<form class="container form form-group my-5 p-5 card" style="background: white; max-width: 700px;" method="POST" action="/contact">
	<h3>Contact us</h3>
	<div>
		<?php 
		if (isset($_GET['submited'])) {
			if ($_GET['submited'] == "true") {
				echo "An email to owner has been sent. Please wait for reply.";
			}else{
				echo "Email Server is not responsive. Please try again later.";
			}
		}
		 ?>
	</div>
	<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
		<label for="fname" class="col-sm-4 col-form-label col-form-label-sm">Name</label>
		<div class="col-sm-8">
			<input required type="text" class="form-control form-control-sm" autofocus minlength="3" maxlength="40" id="fname" value="<?php if (isset($_POST['fname'])) { echo $_POST['fname'];} ?>" name="fname">
		</div>
	</div>
	<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
		<label for="email" class="col-sm-4 col-form-label col-form-label-sm"><?php echo t(38)[$l]; ?></label>
		<div class="col-sm-8">
			<input required type="email" class="form-control form-control-sm"  value="<?php if (isset($_POST['email'])) { echo $_POST['email'];} ?>" minlength="8" maxlength="40" id="email" name="email">
		</div>
	</div>
	<div class="form-row d-flex flex-wrap mb-2 mx-5 justify-content-between">
		<label for="email" class="col-sm-4 col-form-label col-form-label-sm">Messages</label>
		<div class="col-sm-8">
			<textarea required type="email" class="form-control form-control-sm" minlength="8" name="message" style="min-height: 150px;"></textarea>
		</div>
	</div>
	<div class="form-row d-flex flex-wrap mb-4 mt-3 mx-5 align-items-center justify-content-between">
		<div class="col-sm-4"></div>
		<div class="col-sm-8">
			<button type="submit" name="contact_submit" class="btn col-sm-12 btn-primary">Send</button>
		</div>
	</div>
</form>