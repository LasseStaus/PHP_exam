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
$mail->addAddress($recipient, "Email for $recipient");
$mail->SetFrom("postadorawebtest@gmail.com", "Postadora");
$mail->AddReplyTo("reply-to-email", "reply-to-name");
$mail->AddCC("cc-recipient-email", "cc-recipient-name");
$mail->Subject = 'Confirmation test email for webdev';
$mail->Body    = "https://postadora.lassestaus.com/confirm/$user_confirmation_key";
$mail->AltBody = 'Click to confirm';

$mail->send();
if (!$mail->Send()) {
    echo $mail->ErrorInfo;
    var_dump($mail);
} else {
    echo "<div>Message has been sent to $recipient</div>";
    $success_message = "An email has been sent for you to confirm";
    header("Location: /login/success/$success_message");
}
