<?php

include "phpmailer/classphpmailer_helper.php";

$nombre 	= $_POST['nombre'];
$email 		= $_POST['email'];
$mensaje	= $_POST['mensaje'];

$mail = new PHPMailer;

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Mailer = "smtp";
 
//Nuestro servidor smtp. Como ves usamos cifrado ssl
$mail->Host = "ssl://smtp.gmail.com";
 
//Puerto de gmail 465
$mail->Port="465";
 
$mail->SMTPAuth 	= true;                               // Enable SMTP authentication
$mail->Username 	= 'contacto@brium.cl';                            // SMTP username
$mail->Password 	= 'SocialBrium2012';                     // SMTP password
//$mail->SMTPSecure 	= 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From 		= "no-reply@brium.cl";
$mail->FromName 	= 'Brium | Branding Digital';
$mail->AddAddress('contacto@brium.cl', 'Contacto Brium');  // Add a recipient
$mail->AddCC($email);


$mail->IsHTML(true);                                  // Set email format to HTML

$plantilla	= file_get_contents("mail/mail_brium.html");

$body 		= str_replace("{nombre}", $nombre, $plantilla);
$body 		= str_replace("{email}", $email, $body);
$body 		= str_replace("{mensaje}", $mensaje, $body);

$mail->Subject = 'Contacto Brium';
$mail->Body    = utf8_decode($body);


if(!$mail->Send()) {
   echo '<div class="alert alert-error"><i class="icon-exclamation-sign"></i> Ha ocurrido un problema en el envio, por favor intente mas tarde.</div>';
   die();
}

echo '<div class="alert alert-success"><i class="icon-ok"></i> Tu correo ha sido enviado exitosamente.</div>';

?>