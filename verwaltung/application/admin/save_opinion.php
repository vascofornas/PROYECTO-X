<?php
include "../config.php";

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$especialidad = $_POST['especialidad'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$ciudad = $_POST['ciudad'];
$estado = $_POST['estado'];
$pais = $_POST['pais'];
$atencion = $_POST['atencion'];
$precio = $_POST['precio'];
$instalaciones = $_POST['instalaciones'];
$puntualidad = $_POST['puntualidad'];
$lorecomendarias = $_POST['lorecomendarias'];
$eficiencia = $_POST['eficiencia'];
$comentarios = $_POST['comentarios'];
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$verificado = $_POST['verificado'];





$crud=$_POST['crud'];

if($crud=='N'){
	
	mysqli_query($link,"insert into tb_opiniones_doctor(nombre_doctor,apellidos_doctor,especialidad_doctor,direccion_doctor,
    tel_doctor,ciudad_doctor,estado_doctor,pais_doctor,atencion,precio,instalaciones,puntualidad,lo_recomiendas,eficiencia,
    comentarios, nombre_usuario, email_usuario, verificado) values('$nombre',
    '$apellidos',
    '$especialidad','$direccion','$telefono','$ciudad','$estado','$pais','$atencion','$precio','$instalaciones','$puntualidad','$lorecomendarias',
    '$eficiencia','$comentarios','$usuario','$email','$verificado')");
	if(mysqli_error($link)){
		$result['error']=mysqli_error($link);
		$result['result']=0;
	}else{
		$result['error']='';
		$result['result']=1;
	}
}else if($crud == 'E'){
	mysql_query("update members set nombre='$nombre',apellidos='$apellidos',nivel_usuario='$nivel_usuario',
    agencia_usuario='$agencia_usuario',email='$email',cargo_usuario='$cargo_usuario',licencia_usuario='$licencia_usuario',
    verified='$verified',tel='$tel' where id= '".$id."'");
	if(mysql_error()){
		$result['error']=mysql_error();
		$result['result']=0;
	}else{
		$result['error']='';
		$result['result']=1;
	}
}else{

	$result['error']='Invalid Order';
	$result['result']=0;
}
$result['crud']=$crud;
echo json_encode($result);

?>