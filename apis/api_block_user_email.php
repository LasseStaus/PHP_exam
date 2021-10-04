
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer();
$mail->IsSMTP();

$mail->SMTPDebug  = 0;
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "postadorawebtest@gmail.com";
$mail->Password   = "#postadora";
$mail->IsHTML(true);
$mail->addAddress($user_email, "Email for $user_email ");
$mail->SetFrom("postadorawebtest@gmail.com", "Postadora");
$mail->AddReplyTo("reply-to-email", "reply-to-name");
$mail->AddCC("cc-recipient-email", "cc-recipient-name");
$mail->Subject = 'YOU HAVE BEEN BLOCKED FROM WEB DEV KEA ';
$mail->Body    = "One of our admins has deemed your behaviour inappropriate and your user has been blocked. 
You should be ashamed of yourself.";
$mail->AltBody = 'Shame, shame, shame on you!';

$mail->send();
if (!$mail->Send()) {
    echo $mail->ErrorInfo;
    var_dump($mail);
} else {
    echo 'success user has been sent an email about being blocked';
    header('Location: /admin-users');
}
