<?php 

function sent_mail($to = null, $fname = null, $message = null, $subject = null){
	$fname = ucwords(strtolower(addslashes($fname)));
	$to = (strtolower(addslashes(strip_tags($to))));
	$website_title = "K5392";
	// $website_url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'];
	$website_url = "https://instagram.com/ProgrammerJibon";
	$web_mail = "ProgrammerJibon@gmail.com";
	$logo = "http://auiplay.com/mailer/logo.png";

	if ($subject == null) {
		$subject = "Notification from $website_title";
	}
	$header = '';
	$headerX['Content-Type'] = 'text/html;charset: ISO-8859-1';
	$headerX['MIME-Version'] = '1.0';
	$headerX['X-Priority'] = '1';
	$subject = ucwords(strtolower(addslashes(strip_tags($subject))));
	// $headerX['Priority'] = 'Urgent';
	// $headerX['Importance'] = 'High';
	// $headerX['X-MSMail-Priority'] = 'High';
	$headerX['Return-Path'] = 'ProgrammerJibon@gmail.com';
	$headerX['Reply-To'] = $web_mail;
	$headerX['X-Mailer'] = 'PHP/'.phpversion();
	$headerX['From'] = "$website_title <$web_mail>";

	$header = $headerX;
	$mail_body = '
	<body style="margin: 0; padding: 0;">
		<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing: border-box;font-size: 14px;width: 100%;background: #f6f6f6;margin: 0;padding: 0;user-select: none;">
			<tbody>
				<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing: border-box;font-size: 14px;margin: 0;padding: 0;">
					<td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;display: block!important;max-width: 600px!important;clear: both!important;margin: 0 auto;padding: 0;min-width:400px;">
						<div style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing: border-box;max-width: 600px;display: block;margin: 0 auto;padding: 20px;padding-top: 50px">
							<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing: border-box;font-size: 12px;border-radius: 3px;background: #fff;margin: 0;padding: 0;border: 1px solid #e9e9e9; width: 100%; padding: 16px;color: #8d8d8d;">
								<tbody>
									<tr>
										<td><br></td>
									</tr>
									<tr>
										<td style="margin: 0 auto;display: flex;align-items: center;justify-content: space-between;">
											<a target="_blank" href="'.$website_url.'">
												<img style="width: auto;height: 70px;pointer-events: none;" src="'.$logo.'">
											</a>
											<div  style="display: flex;justify-content: center;margin-left: auto;">
												'.date("H:i:s A").'<br>
												'.date("d M, Y").'
											</div>
										</td>
									</tr>
									<tr>
										<td><br></td>
									</tr>
									<tr>
										<td>Hi <b>'.$fname.'</b>,</td>
									</tr>
									<tr>
										<td><br></td>
									</tr>
									<tr style="font-size: 14px;color:#444444;">
										<td>'.$message.'</td>
									</tr>
									<tr>
										<td><br>Please keep in mind that if this mail contain any crediatials, don\'t share these or this email with anyone. Not even with your girlfriend. Never share your email and password. Keep your privacy safe.</td>
									</tr>
									<tr>
										<td><br></td>
									</tr>
									<tr>
										<td>Thank you for your time.</td>
									</tr>
									<tr>
										<td><br></td>
									</tr>
									<tr>
										<td>From, <br>'.$website_title.' team.</td>
									</tr>
									<tr>
										<td><br></td>
									</tr>
								</tbody>
							</table>
							<div style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px;width:100%;clear:both;color:#999;margin:0;padding:20px">
								<table width="100%" style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px;margin:0;padding:0; color: #cfcfcf;">
									<tbody><tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px;margin:0;padding:0">
										<td style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:12px;vertical-align:top;text-align:center;margin:0;padding:0 0 5px" align="center" valign="top">You are receiving this email to protect and verify users crediatials and personal informations.</td>
									</tr>
									<tr style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px;margin:0;padding:0">
										<td style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:12px;vertical-align:top;text-align:center;margin:0;padding:0 0 5px" align="center" valign="top">
											© 2021-'.date('y').' All rights reserved by <a target="_blank" style="color: lightpink;" href="'.$website_url.'">'.$website_title.'</a>.Programmed by <a target="_blank" style="color: lightpink;" href="https://instagram.com/ProgrammerJibon">ProgrammerJibon</a>
										</td>
									</tr>
								</tbody></table>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</body>
	';
	if (mail($to, $subject, $mail_body, $header)) {
		return $to;
	}else{
		return false;
	}
}
if (isset($_GET['send_code'])) {
	$mailer = sent_mail($_GET['email'], $_GET['fname'], $_GET['send_code'], "Verification code");
	if ($mailer) {
		echo "true";
	}else{
		echo "false";
	}
}
