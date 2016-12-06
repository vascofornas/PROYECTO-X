<?php

if( $_POST ){
	

	
    $comentarios = $_POST['comentarios'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $email_usuario = $_POST['email_usuario'];
    
   
  
 
    
 $db_host = "localhost";
 $db_name = "herasosj_hera";
 $db_user = "herasosj_hera";
 $db_pass =  "Papa020432";
 
 // Function to get the client ip address

 	$ipaddress = '';
 	if (getenv('HTTP_CLIENT_IP'))
 		$ipaddress = getenv('HTTP_CLIENT_IP');
 		else if(getenv('HTTP_X_FORWARDED_FOR'))
 			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
 			else if(getenv('HTTP_X_FORWARDED'))
 				$ipaddress = getenv('HTTP_X_FORWARDED');
 				else if(getenv('HTTP_FORWARDED_FOR'))
 					$ipaddress = getenv('HTTP_FORWARDED_FOR');
 					else if(getenv('HTTP_FORWARDED'))
 						$ipaddress = getenv('HTTP_FORWARDED');
 						else if(getenv('REMOTE_ADDR'))
 							$ipaddress = getenv('REMOTE_ADDR');
 							else
 								$ipaddress = 'UNKNOWN';
 
 								


// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$link = new PDO("mysql:host=$db_host;dbname=$db_name",$db_user,$db_pass);
$link -> exec("set names utf8");


$verificado = 0;

function generateRandomString($length) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

$codigo = generateRandomString(10); 



$statement = $link->prepare("INSERT INTO tb_contacto(comentarios,nombre_usuario,email_usuario,ip_usuario,codigo)
    VALUES(
		:fcomentarios,:fnombre_usuario,:femail_usuario,:fip,:fcodigo)");
$statement->execute(array(
				"fcomentarios" => $comentarios,

		"fnombre_usuario" => $nombre_usuario,
		"femail_usuario" => $email_usuario,
		"fip" => $ipaddress,
		"fcodigo" => $codigo,
		
		
));




$to = $email_usuario;
$subject = 'Tu mensaje ha sido recibido';
$from = 'admin@herasalud.com';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Create email headers
$headers .= 'From: '.$from."\r\n".
		'Reply-To: '.$from."\r\n" .
		'X-Mailer: PHP/' . phpversion();

// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<h1 style="color:#f40;">Hola '.$nombre_usuario.'!</h1>';
$message .= '<p style="color:#080;font-size:18px;">Gracias por contactarnos en herasalud.com</p>';
$message .= '<p>En breve contestaremos tu consulta</p><br>';

$message .= '<p>Saludos</p><br>';
$message .= '<p><strong>El equipo de HeraSalud</strong></p><br>';
$message .= '<a href="herasalud.com"><img width="50px" src="herasalud.com/imagenes/botones/logo_hera.png" ></a></center>';
$message .= '</body></html>';

// Sending email$message .= '<p>Para validar tu dirección email, favor de hacer click en el botón</p><br>';
if(mail($to, $subject, $message, $headers)){
	echo 'Te hemos enviado un email para confirmar el envio de tu consulta.';
} else{
	echo 'Unable to send email. Please try again.';
}

$administrador = 'admin@herasalud.com';
$to = $administrador;
$subject = 'CONTACTO EN HERASALUD.COM';
$from = 'admin@herasalud.com';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Create email headers
$headers .= 'From: '.$from."\r\n".
		'Reply-To: '.$from."\r\n" .
		'X-Mailer: PHP/' . phpversion();

// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<h3 style="color:#f40;">Usuario '.$nombre_usuario.' !</h3>';
$message .= '<h3 style="color:#f40;">Email '.$email_usuario.' !</h3>';
$message .= '<h3 style="color:#f40;">Comentarios: '.$comentarios.' !</h3>';

$message .= '</body></html>';

// Sending email
if(mail($to, $subject, $message, $headers)){
	
} else{
	echo 'Unable to send email. Please try again.';
}




   

?>
    <table class="table table-striped" border="0">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong>FORMULARIO DE CONTACTO RECIBIDO</strong>, Gracias por contactar con nosotros. En breve nos pondremos en contacto contigo.
    	</div>
    </td>
    </tr>
    
  
 
    
    
    
    </table>
    <?php
    
    
    
    $administrador = "admin@herasalud.com";
    $to = $administrador;
    $subject = 'Hay una nueva opinion en HERASALUD.COM';
    $from = 'admin@herasalud.com';
    
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    // Create email headers
    $headers .= 'From: '.$from."\r\n".
    		'Reply-To: '.$from."\r\n" .
    		'X-Mailer: PHP/' . phpversion();
    
    // Compose a simple HTML email message
    $message = '<html><body>';
    $message .= '<h1 style="color:#f40;">El usuario '.$nombre_usuario.' ha enviado el formulario de contacto!</h1>';
    $message .= '<h1 style="color:#f40;">COMENTARIOS '.$comentarios.' !</h1>';
    $message .= '<h1 style="color:#f40;">CODIGO '.$codigo.' !</h1>';
    
    $message .= '</body></html>';
    
  
	
}