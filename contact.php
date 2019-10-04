<?php

$username = 'chrisliddell78958@gmail.com';
$password = '';
$from = 'chrisliddell78958@gmail.com';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';


//CPT
if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

	//datos del cupon
	$nombre = $_POST['nombre-completo'];	
	$empresa = $_POST['empresa'];
	$productos = $_POST['productos'];
	$info = $_POST['adicional'];	
	$tel = $_POST['telefono'];
	$correo = $_POST['correo'];
	

    $datos = "nombre: " . $nombre.", tel: ".$tel.", correo: ".$correo.", empresa: ".$empresa."\n"."productos: ".$productos." datos adicionales: ".$info."\n";
	/** RESPALDO DE EMAIL **/
	$req_dump = print_r($datos, TRUE);
	$fp = fopen('email.log', 'a+');
	fwrite($fp, "\n".$req_dump."\n");
	fclose($fp);
	/***********************/

    $mail = new PHPMailer;

    $mail->isSMTP(); 
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';                                    
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;      
    $mail->SMTPDebug  = 3;

    $mail->Username = $username;
    $mail->Password = $password;
    $mail->SMTPSecure = 'tls';     
    $mail->Port = 25; 
    $mail->setFrom($from);
    $mail->addAddress('jgranados@imagineercx.com');   
    $mail->isHTML(true);                                 

    $myfile = fopen("dist.html", "r") or die("Unable to open file!");
	$mail->Body = $datos;//fread($myfile,filesize("dist.html"));
	$mail->Subject = "Regalos cueropapel&tijera para tu empresa";

	if(!$mail->Send()) {
	  echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	  echo "Message sent!";
	}
}

?>