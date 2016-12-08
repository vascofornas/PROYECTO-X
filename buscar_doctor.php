<?php
include_once 'funciones.php';
if( $_POST ){
	

	$especialidad_doctor = $_POST['especialidad_doctor'];
   
    $pais_doctor = $_POST['pais_doctor'];
    $estado_doctor = $_POST['estado_doctor'];
    $ciudad_doctor = $_POST['ciudad_doctor'];
 
  
    
   
  
 
    
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
mysqli_set_charset($conn,"utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql1 = "SELECT * FROM tb_doctores WHERE doctor_activo = 1 ";
$result = mysqli_query($conn, $sql1);
if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_array($result))
	{
		$numero=0;
		$sql1 = "SELECT * FROM tb_opiniones_doctor WHERE codigo_verificacion = '".$row['codigo_doctor']."' AND verificado = 1 ";
		$result1 = mysqli_query($conn, $sql1);
		if(mysqli_num_rows($result1) > 0)
		{
			$puntualidad =0;
			$precio = 0;
			$atencion = 0;
			$instalaciones = 0;
			$lo_recomendarias = 0;
			$eficiencia = 0;
			while($row1 = mysqli_fetch_array($result1))
			{
	
				$puntualidad = $puntualidad+$row1['puntualidad'];
				$precio = $precio+$row1['precio'];
				$atencion = $atencion+$row1['atencion'];
				$instalaciones = $instalaciones+$row1['instalaciones'];
				$lo_recomendarias = $lo_recomendarias+$row1['lo_recomendarias'];
				$eficiencia = $eficiencia+$row1['eficiencia'];
				
				
				$numero = $numero+1;
			}
			
			$puntualidad = $puntualidad / $numero;
			$precio = $precio / $numero;
			$atencion = $atencion / $numero;
			$instalaciones = $instalaciones / $numero;
			$lo_recomendarias = $lo_recomendarias / $numero;
			$eficiencia = $eficiencia / $numero;
			$total = ($puntualidad+$precio+$atencion+$instalaciones+$lo_recomendarias+$eficiencia)/6;
			
			$sql2 = "UPDATE tb_doctores SET puntualidad = '".$puntualidad."',precio = '".$precio."',
					atencion = '".$atencion."', instalaciones = '".$instalaciones."',
						lo_recomendarias = '".$lo_recomendarias."',
						eficiencia = '".$eficiencia."',media_puntos =	'".$total."'	WHERE codigo_doctor = '".$row['codigo_doctor']."' ";
			mysqli_query($conn, $sql2);
			
		}
		
	}


}
else
{
	echo 'No se han encontrado doctores que cumplen los criterios';
}

$sql = "SELECT * FROM tb_doctores WHERE especialidad_doctor LIKE '%".$_POST["especialidad_doctor"]."%'
		AND pais_doctor LIKE '%".$_POST["pais_doctor"]."%'
		AND estado_doctor LIKE '%".$_POST["estado_doctor"]."%'
				AND ciudad_doctor LIKE '%".$_POST["ciudad_doctor"]."%' ORDER BY media_puntos DESC";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0)
{
	
		$output .= '<h3>Resultados por *'.$_POST['especialidad_doctor']. '* </h3>';
		$orden = 0;
	while($row = mysqli_fetch_array($result))
	{
		$num_opiniones = get_num_opiniones($row['codigo_doctor']);
		$num_doctores = get_num_doctores($row['ciudad_doctor'],$row['especialidad_doctor']);
		$puntos_doctores = get_puntos_opiniones($row['codigo_doctor']);
		$orden = get_orden($row['especialidad_doctor'],$row['codigo_doctor'],$row['pais_doctor'],$row['ciudad_doctor']);
		$output .= '

				<div class="row text-left col-md-3 col-md-offset-1 ">
				<h5><strong>Doctor '.$row['nombre_doctor'].' '.$row['apellidos_doctor'].'</strong></H5>
               	<h6>'.$row['especialidad_doctor'].'<H6>
               	<h6>'.$orden.' de '.get_num_doctores($row['ciudad_doctor'],$row['especialidad_doctor']).' doctores en '.$row['ciudad_doctor'].'<H6>
               	<h6>'.$puntos_doctores.'<img class="img-responsive" width="150px" src="imagenes/estrellas/0.5_of_5.png" /> '.$num_opiniones.' opiniones <H6><br>
               	</div>  					
           ';
	}
	echo $output;
}
else
{
	echo 'No se han encontrado doctores que cumplen los criterios';
}

}








   

?>
   
   