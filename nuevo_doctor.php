<?php

if( $_POST ){
	

	$especialidad_doctor = $_POST['especialidad_doctor'];
    $nombre_doctor = $_POST['nombre_doctor'];
    $apellidos_doctor = $_POST['apellidos_doctor'];
    $pais_doctor = $_POST['pais_doctor'];
    $estado_doctor = $_POST['estado_doctor'];
    $ciudad_doctor = $_POST['ciudad_doctor'];
 
    $direccion_doctor = $_POST['direccion_doctor'];
  
    $tel_doctor = $_POST['tel_doctor'];
   
    $puntualidad = $_POST['puntualidad'];
    $precio = $_POST['precio'];
    $instalaciones = $_POST['instalaciones'];
    $atencion = $_POST['atencion'];
    $recomendarias = $_POST['recomendarias'];
    $eficiencia = $_POST['eficiencia'];
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



$statement = $link->prepare("INSERT INTO tb_opiniones_doctor(especialidad_doctor,nombre_doctor,apellidos_doctor,direccion_doctor,
		atencion,instalaciones,precio,puntualidad,lo_recomiendas,comentarios,nombre_usuario,email_usuario,ip_usuario,pais_doctor,estado_doctor,
		ciudad_doctor,codigo_verificacion,eficiencia,tel_doctor)
    VALUES(:fespecialidad,:fnombre_doctor,:fapellidos,:fdireccion,:fatencion,:finstalaciones,:fprecio,:fpuntualidad,:flo_recomiendas,
		:fcomentarios,:fnombre_usuario,:femail_usuario,:fip,:fpais,:festado,:fciudad,:fcodigo,:feficiencia,:ftel)");
$statement->execute(array(
		"fespecialidad" => $especialidad_doctor,
		"fnombre_doctor" => $nombre_doctor,
		"fapellidos" => $apellidos_doctor,
		"fdireccion" => $direccion_doctor,
		"fatencion" => $atencion,
		"finstalaciones" => $instalaciones,

		"fprecio" => $precio,
		"fpuntualidad" => $puntualidad,

		"flo_recomiendas" => $recomendarias,

		"fcomentarios" => $comentarios,

		"fnombre_usuario" => $nombre_usuario,
		"femail_usuario" => $email_usuario,
		"fip" => $ipaddress,
		"fpais" => $pais_doctor,
		"festado" => $estado_doctor,
		"fciudad" => $ciudad_doctor,

		"fcodigo" => $codigo,

		"feficiencia" => $eficiencia,
		"ftel" => $tel_doctor,
		
		
));


$statement1 = $link->prepare("INSERT INTO tb_doctores
		(nombre_doctor,apellidos_doctor,pais_doctor,estado_doctor,ciudad_doctor,tel_doctor,
		especialidad_doctor,direccion_doctor,codigo_doctor
		)
    VALUES(:fnombre,:fapellidos,:fpais,:festado,:fciudad,:ftel,
		:fespecialidad,:fdireccion,:fcodigo)");
$statement1->execute(array(
		
		"fespecialidad" => $especialidad_doctor,
		"fnombre" => $nombre_doctor,
		"fapellidos" => $apellidos_doctor,
		"fpais" => $pais_doctor,
		"festado" => $estado_doctor,
		"fciudad" => $ciudad_doctor,
		"ftel" => $tel_doctor,
		"fespecialidad" => $especialidad_doctor,
		"fdireccion" => $direccion_doctor,
		
		"fcodigo" => $codigo,
));





$to = $email_usuario;
$subject = 'Tu opinión ha sido registrada';
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
$message .= '<p style="color:#080;font-size:18px;">Gracias por opinar en herasalud.com</p>';
$message .= '<p>Una vez validada tu dirección email, procederemos a publicar tu opinión en herasalud.com</p><br>';


$message .= '<center><a href="http://herasalud.com/confirmar_email1.php?cod='.$codigo.'"><button type="button">VALIDAR EMAIL</button></a><br>';
$message .= '<p>Saludos</p><br>';
$message .= '<p><strong>El equipo de HeraSalud</strong></p><br>';
$message .= '<a href="herasalud.com"><img width="50px" src="herasalud.com/imagenes/botones/logo_hera.png" ></a></center>';
$message .= '</body></html>';

// Sending email$message .= '<p>Para validar tu dirección email, favor de hacer click en el botón</p><br>';
if(mail($to, $subject, $message, $headers)){
	echo 'Te hemos enviado un email para verificar tu dirección email.';
} else{
	echo 'Unable to send email. Please try again.';
}

$administrador = 'admin@herasalud.com';
$to = $administrador;
$subject = 'OPINION registrada CODIGO:==>'.$codigo;
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
$message .= '<h3 style="color:#f40;">Codigo '.$codigo.' !</h3>';

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
    		<strong>OPINION REGISTRADA</strong>, Gracias por dar tu opinión. En menos de 48 horas validaremos tu email y publicaremos tu opinión.
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
    $message .= '<h1 style="color:#f40;">El usuario '.$nombre_usuario.' ha enviado una opinion a HERA!</h1>';
    $message .= '<h1 style="color:#f40;">CODIGO '.$codigo.' !</h1>';
    
    $message .= '</body></html>';
    
    // Sending email
    if(mail($to, $subject, $message, $headers)){
    
    } else{
    
    }
	
}