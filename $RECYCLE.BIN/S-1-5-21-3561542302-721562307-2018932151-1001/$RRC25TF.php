<?php
if (isset($_POST['code'])) {
	$code = $_POST['code'];
	if ($code == 404) {
		$desc = "page not found";
		$err_style = "color:#363b4a;";
	}elseif ($code == 500) {
		$desc = "Something went wronge";
		$err_style = "color:gray;";
	}elseif ($code == 403) {
		$desc = "Access denied";
		$err_style = "color:red;";
	}elseif ($code == 204) {
		if (!isset($_POST['for_error'])) {
			$the_for = "";
		}else{
			$the_for = " for ".$_POST['for_error'];
		}
		$desc = "Nothing found".$the_for;
		$err_style = "color:orange; margin-top: -120px;";
	}
}else{
	$code = 200;
	$desc = "Everything is okay";
	$err_style = "color:white;";
}
?>
<div class="server_returns_error" style="<?php echo $err_style; ?>; overflow: visible;">
	<div class="error_block">
		<span class="error_code"><?php echo $code; ?></span>
		<span class="error_desc"><?php echo $desc; ?></span>
	</div>
</div>
<style type="text/css">
	.server_returns_error{
		user-select: none;
		pointer-events: none;
	}
	<?php if (isset($_POST['for_error'])) {
		?>
	.server_returns_error .error_block .error_code{
		font-size: 120px;
	}
	.server_returns_error .error_block .error_desc{
		font-size: 15px;
	}
		<?php
	} ?>
</style>