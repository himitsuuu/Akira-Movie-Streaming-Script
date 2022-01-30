<?php
require_once('../db/config.php');
require_once('../const/mail.php');
require_once('../const/web-info.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../mail/src/Exception.php';
require '../mail/src/PHPMailer.php';
require '../mail/src/SMTP.php';

$first_name = ucwords($_GET['first_name']);
$email = $_GET['email'];
$message = $_GET['message'];
$mail_subject = ucwords($_GET['subject']);
$mail_message = '<div style="font-family:segoe ui;"><p style="font-family:segoe ui;">'.$message.'<br><hr><b>Sender Information</b><br>Name : '.$first_name.'<br>Email : '.$email.'</p></div>';

$mail = new PHPMailer;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$mail->isSMTP();
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Host = $mymail_server;
$mail->SMTPAuth = true;
$mail->Username = $mymail_user;
$mail->Password = $mymail_password;
$mail->SMTPSecure = $mymail_conn;
$mail->Port = $mymail_port;

$mail->setFrom($mymail_user, AppName);
$mail->addAddress(AppEmail);

$mail->isHTML(true);

$mail->Subject = $mail_subject;
$mail->Body    = $mail_message;
$mail->AltBody = $mail_message;

if(!$mail->send()) {
print '
<div class="alert alert-danger" role="alert">
Mailer Error: ' . $mail->ErrorInfo.';
</div>
';
} else {
print '
<div class="alert alert-success" role="alert">
Your message was sent.
</div>
';
}

?>
