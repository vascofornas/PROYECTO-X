<?php

if( $_POST ){
	
    $especialidad_doctor = $_POST['especialidad_doctor'];
    $nombre_doctor = $_POST['nombre_doctor'];
    $apellidos_doctor = $_POST['apellidos_doctor'];
    $direccion_doctor = $_POST['direccion_doctor'];
    $pais_doctor = $_POST['countryId'];
    $estado_doctor = $_POST['stateId'];
    $ciudad_doctor = $_POST['cityId'];
    $comentarios_doctor = $_POST['opinion'];
    $puntualidad_doctor = $_POST['puntualidad'];
    $atencion_doctor = $_POST['atencion'];
    $instalaciones_doctor = $_POST['instalaciones'];
    $precio_doctor = $_POST['precio'];
    $recomendarias_doctor = $_POST['recomendarias'];
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

$sql2= "SELECT name FROM countries WHERE id = '".$pais_doctor."'";
$stmt2 = $link->query($sql2);
$row = $stmt2->fetch(PDO::FETCH_ASSOC);
$nombre_pais = $row['name'];
$sql3= "SELECT name FROM states WHERE id = '".$estado_doctor."'";
$stmt3 = $link->query($sql3);
$row = $stmt3->fetch(PDO::FETCH_ASSOC);
$nombre_estado = $row['name'];
$sql4= "SELECT name FROM cities WHERE id = '".$ciudad_doctor."'";
$stmt4 = $link->query($sql4);
$row = $stmt4->fetch(PDO::FETCH_ASSOC);
$nombre_ciudad = $row['name'];
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



$statement = $link->prepare("INSERT INTO tb_opiniones_doctor(especialidad_doctor,nombre_doctor,apellidos_doctor,
		direccion_doctor,pais_doctor,estado_doctor,ciudad_doctor,comentarios,puntualidad,atencion,instalaciones,precio,lo_recomiendas,
		nombre_usuario,email_usuario,ip_usuario,verificado,codigo_verificacion)
    VALUES(:fesp,:fnombre,:fapellidos,:fdireccion,:fpais,:festado,:fciudad,:fcomentarios,:fpuntualidad,:fatencion,:finstalaciones,:fprecio,:flo_recomiendas,
		:fusuario,:femail,:fip,:fverificado,:fcodigo)");
$statement->execute(array(
    "fesp" => $especialidad_doctor,
    "fnombre" => $nombre_doctor,
	"fapellidos" => $apellidos_doctor,
	"fdireccion" => $direccion_doctor,
	"fpais" => $nombre_pais,
	"festado" => $nombre_estado,
	"fciudad" => $nombre_ciudad,
		"fcomentarios" => $comentarios_doctor,
		"fpuntualidad" => $puntualidad_doctor,
		"fatencion" => $atencion_doctor,
		"finstalaciones" => $instalaciones_doctor,
		"fprecio" => $precio_doctor,
		"flo_recomiendas" => $recomendarias_doctor,
		"fusuario" => $nombre_usuario,
		"femail" => $email_usuario,
		"fip" => $ipaddress,
		"fverificado" => $verificado,
		"fcodigo" => $codigo	
		
));


$statement1 = $link->prepare("INSERT INTO tb_doctores
		(nombre_doctor,apellidos_doctor,
		direccion_doctor,especialidad_doctor,codigo_doctor
		)
    VALUES(:fnombre,:fapellidos,:fdireccion,:fespecialidad,:fcodigo)");
$statement1->execute(array(
		
		"fnombre" => $nombre_doctor,
		"fapellidos" => $apellidos_doctor,
		"fdireccion" => $direccion_doctor,
		"fespecialidad" => $especialidad_doctor,

		"fcodigo" => $codigo

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

$message .= '<p>Para validar tu dirección email, favor de hacer click en el botón</p><br>';
$message .= '<a href="http://herasalud.com/confirmar_email.php?cod='.$codigo.'"><button type="button">VALIDAR EMAIL</button></a>';
$message .= '<a href="herasalud.com"><img src="img/herasaludlogo.png" ></a>';
$message .= '</body></html>';

// Sending email
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
$message .= '<h1 style="color:#f40;">Hola '.$nombre_usuario.'!</h1>';
$message .= '<p style="color:#080;font-size:18px;">Gracias por opinar en herasalud.com</p>';
$message .= '<p>Una vez validada tu dirección email, procederemos a publicar tu opinión en herasalud.com</p><br>';

$message .= '<p>Para validar tu dirección email, favor de hacer click en el botón</p><br>';
$message .= '<a href="http://herasalud.com/confirmar_email.php?cod='.$codigo.'"><button type="button">VALIDAR EMAIL</button></a>';
$message .= '<a href="herasalud.com"><img src="img/herasaludlogo.png" ></a>';
$message .= '</body></html>';

// Sending email
if(mail($to, $subject, $message, $headers)){
	echo 'Te hemos enviado un email para verificar tu dirección email.';
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
    
    <tr>
    <td><strong>ESPECIALIDAD: </strong></td>
    <td><?php echo $especialidad_doctor ?></td>
    </tr>
    
    <tr>
    <td><strong>NOMBRE DEL DOCTOR: </strong></td>
    <td><?php echo $nombre_doctor ?></td>
    </tr>
 <tr>
    <td><strong>APELLIDOS DEL DOCTOR: </strong></td>
    <td><?php echo $apellidos_doctor ?></td>
    </tr>
 
     <tr>
    <td><strong>DIRECCION DEL DOCTOR: </strong></td>
    <td><?php echo $direccion_doctor ?></td>
    </tr>
 <tr>
    <td><strong>TU OPINION: </strong></td>
    <td><?php echo $comentarios_doctor ?></td>
    </tr>
     <tr>
    <td><strong>PUNTUALIDAD: </strong></td>
    <td><?php echo $puntualidad_doctor ?></td>
    </tr>
     <tr>
    <td><strong>ATENCION: </strong></td>
    <td><?php echo $atencion_doctor ?></td>
    </tr>
     <tr>
    <td><strong>INSTALACIONES: </strong></td>
    <td><?php echo $instalaciones_doctor ?></td>
    </tr>
     <tr>
    <td><strong>PRECIO: </strong></td>
    <td><?php echo $precio_doctor ?></td>
    </tr>
     <tr>
    <td><strong>LO RECOMENDARIAS?: </strong></td>
    <td><?php echo $recomendarias_doctor ?></td>
    </tr>
    <tr>
    
    
    
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