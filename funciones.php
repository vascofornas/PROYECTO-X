<?php 

  
// Function to get the client IP address
function get_client_ip() {
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
    return $ipaddress;
}
function add_log ($texto, $usuario, $codigo){
	
	$ip = get_client_ip();
	
	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');
    $stmt = $mysqli->prepare("INSERT INTO tb_historico (texto,usuario,ip,codigo) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $texto, $usuario, $ip,$codigo);
$stmt->execute();
	  
}
function get_email_superadmin(){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop = mysqli_query($mysqli, "SELECT * FROM tb_datos_configuracion")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_usua = mysqli_fetch_array($loop))
	{
		$email_del_usuario = $row_usua['superadmin_email'];
	}
	return $email_del_usuario;

}
function get_email($usuario){
	
	$email_del_usuario = "modestovasco@gmail.com";
	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');
	 
	$loop = mysqli_query($mysqli, "SELECT * FROM tbl_users WHERE userID = '".$usuario."'")
	or die (mysqli_error($dbh));
	
	
	
	//display the results
	while ($row_usua = mysqli_fetch_array($loop))
	{ 
	 	$email_del_usuario = $row_usua['userEmail'];
	}
	return $email_del_usuario;
	
}
function get_idioma($usuario){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tbl_users WHERE userID = '".$usuario."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$idioma_del_usuario = $row_usua['idioma_usuario'];
	}
	return $idioma_del_usuario;

}
function get_num_opiniones($usuario){

	$mysqli = new mysqli('localhost', 'herasosj_hera', 'Papa020432', 'herasosj_hera');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tb_opiniones_doctor
			WHERE codigo_verificacion = '".$usuario."' AND verificado = 1")
	or die (mysqli_error($dbh));


 $num = 0;
	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$num=$num+1;
	}
	return $num;

}
function get_puntos_opiniones($usuario){

	$mysqli = new mysqli('localhost', 'herasosj_hera', 'Papa020432', 'herasosj_hera');
	mysqli_set_charset($mysqli,"utf8");
	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tb_opiniones_doctor
			WHERE codigo_verificacion = '".$usuario."' AND verificado = 1")
			or die (mysqli_error($dbh));


			$num = 0;
			$doctores =0;
			//display the results
			while ($row_usua = mysqli_fetch_array($loop_idioma))
			{
				$num=$num+$row_usua['atencion'];
				$num=$num+$row_usua['puntualidad'];
				$num=$num+$row_usua['precio'];
				$num=$num+$row_usua['instalaciones'];
				$num=$num+$row_usua['lo_recomiendas'];
				$num=$num+$row_usua['eficiencia'];
				$doctores = $doctores +1;
			}
			if ($doctores > 0){
				$resultado =$num/$doctores/6;
				
				return number_format((float)$resultado, 2, '.', '');
			}
			else {
				return $num;
			}

}
function get_num_doctores($usuario,$espec){

	$mysqli = new mysqli('localhost', 'herasosj_hera', 'Papa020432', 'herasosj_hera');
	mysqli_set_charset($mysqli,"utf8");
	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tb_doctores
			WHERE ciudad_doctor = '".$usuario."'and especialidad_doctor = '".$espec."' AND doctor_activo = 1")
			or die (mysqli_error($dbh));


			$num = 0;
			//display the results
			while ($row_usua = mysqli_fetch_array($loop_idioma))
			{
				$num=$num+1;
			}
			return $num;

}
function get_orden($especialidad,$codigo,$pais,$ciudad){

	$mysqli = new mysqli('localhost', 'herasosj_hera', 'Papa020432', 'herasosj_hera');
	mysqli_set_charset($mysqli,"utf8");
	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tb_doctores
			WHERE pais_doctor = '".$pais."' AND ciudad_doctor = '".$ciudad."' AND especialidad_doctor = '".$especialidad."' AND doctor_activo = 1
			ORDER BY media_puntos DESC")
			or die (mysqli_error($dbh));


			$num = 0;
			$res = 0;
			//display the results
			while ($row_usua = mysqli_fetch_array($loop_idioma))
			{
				$num=$num+1;
				if ($row_usua['codigo_doctor'] == $codigo){
					$res = $num;
				}
			}
			return $res;

}


?>
