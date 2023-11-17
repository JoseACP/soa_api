<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="0; url=../index.php">
    <link rel="icon" type="image/x-icon" href="img/logo-toro.ico">
    <title>Rincón Ganadero</title>
</head>
<body>
<?php

if(isset($_POST['register'])){
    $nombre= $_POST['n'];
    $email = $_POST['e'];
    $descripcion = $_POST['d'];
    $fecha = $_POST['f'];
    $hora = $_POST['t'];
    

}
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'admin@rinconganadero.org';                     //SMTP username
    $mail->Password   = 'Rincon2023$';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('admin@rinconganadero.org', 'Rincon Ganadero');
    $mail->addAddress($email);
    $mail->addAddress('rinconganadero2023@gmail.com');   
    $mail->addAddress('admin@rinconganadero.org');//Add a recipient campiar por correo de articulos
    
               //Name is optional

    //Attachments
   
    //Content
    $mail->WordWrap = 50; 
    $mail->IsHTML(true);     
    $mail->Subject  =  "INFORME DE RESERVACION";
    $mail->Body = "<br /> Propietario de reservación: $nombre \n<br />".   
    "\n<br /> Correo electronico de reservación: $email \n<br />".    
    "\n<br /> Descripción de ls reservación: $descripcion \n<br />".    
    "\n<br /> Fecha de reservación: $fecha \n<br />".    
    "\n<br /> Hora de reservación: $hora \n<br />";

     $mail->send();   
     echo "<script language='javascript'> alert('El mensaje ha sido enviado')</script>";
 } catch (Exception $e) {
    echo "<script language='javascript'> alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
 }
 
 ?>
</body>
</html>
