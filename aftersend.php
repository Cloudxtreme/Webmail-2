<?php
		date_default_timezone_set('Asia/Chongqing');
		require_once('PHPMailer/PHPMailerAutoload.php');
		//$subject=$_POST["subject"];
		$ct = $_POST['content'];
		//$subject='subject';
		$content='content';
		$mail = new PHPMailer;
		//$mail->SMTPDebug = 3;                               // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.qq.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = '774590565@qq.com';                 // SMTP username
		$mail->Password = 'zsk2aixgp';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    // TCP port to connect to

		$mail->From = '774590565@qq.com';
		$mail->FromName = 'zsk';
		$mail->addAddress('zhaoshikun@foxmail.com', 'Joe User');     // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		$mail->addReplyTo('774590565@qq.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $_POST['subject'];
		$mail->Body    = $ct;
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			echo 'wrong.html';
		} else {
			echo "right.html";
		}
?>
