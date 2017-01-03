<?php

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







$sql = "SELECT * FROM tb_doctores WHERE especialidad_doctor LIKE '%".$_POST["especialidad_doctor"]."%'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<h3>Resultados por * '.$_POST['especialidad_doctor']. '*</h3>';
	
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
				
				
				<div class="row text-left col-md-3 col-md-offset-1"><h4>Doctor '.$row['nombre_doctor'].' '.$row['apellidos_doctor'].'</H4>
               <h5>'.$row['especialidad_doctor'].'<H5>
               		<h5>1 de 45 doctores<H5><br>
               		
               		</div>
                     	
                     					
           </div>';
	}
	echo $output;
}
else
{
	echo 'Data Not Found';
}

}








   

?>
   
   