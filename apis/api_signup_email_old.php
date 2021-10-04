<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function




require('PHPMailer/src/PHPMailer.php');
require('PHPMailer/src/Exception.php');
require('PHPMailer/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;





//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    /*  $mail->SMTPDebug = SMTP::DEBUG_SERVER;  */                     //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'testwebdevelopment1@gmail.com';                     //SMTP username
    $mail->Password   = '#testtest1';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('testwebdevelopment1@gmail.com', 'Web Class KEA');
    $mail->addAddress('testwebdevelopment1@gmail.com', "Email for you");     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('testwebdevelopment1@gmail.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');
    $mail->isHTML(true);
    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    //Set email format to HTML
    $mail->Subject = 'Confirmation test email for webdev';
    $mail->Body    = "Welcome to Postadora. Please click on this link to confirm your account: <a href='https://postadora.lassestaus.com/confirm/$user_confirmation_key'> CONFIRM </a>";
    $mail->AltBody = 'https://postadora.lassestaus.com/confirm';

    $mail->send();

    // Top


    echo "<div>Message has been sent to $recipient</div>";
    $success_message = "An email has been sent for you to confirm";
    header("Location: /login/success/$success_message");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
