

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
$mail->addAddress($_POST['user_email'], "Email for {$_POST['user_email']}");
$mail->SetFrom("postadorawebtest@gmail.com", "Postadora");
$mail->AddReplyTo("reply-to-email", "reply-to-name");
$mail->AddCC("cc-recipient-email", "cc-recipient-name");
$mail->Subject = 'Reset password request for Postadora';
$mail->Body    = "Please click on this link to create new password for your account: <a href='https://postadora.lassestaus.com/create-new-password/{$_POST['user_email']}'> RESET PASSWORD </a>";
$mail->AltBody = 'https://postadora.lassestaus.com/create-new-password';


$mail->send();
if (!$mail->Send()) {
    echo $mail->ErrorInfo;
    var_dump($mail);
} else {
    echo "<div>Message has been sent to $recipient</div>";
    $success_message = "An email has been sent for you to reset your password";
    header("Location: /lost-password/success/$success_message");
}
