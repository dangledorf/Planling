<?php
include("PHPMailerAutoload.php");
global $config;
$mail = new PHPMailer;

$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = $config["email_host"];      // sets GMAIL as the SMTP server
$mail->Port       = $config["email_port"];                   // set the SMTP port for the GMAIL server
$mail->Username   = $config["email_username"];  // GMAIL username
$mail->Password   = $config["email_password"];            // GMAIL password*/

$mail->AddReplyTo( $config["email_replyto_email"], $config["email_replyto_name"] );
$mail->SetFrom( $config["email_replyto_email"], $config["email_replyto_name"] ); 

//$mail->SMTPDebug = 3;
?>