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
	mysqli_query($link,"update tb_opiniones_doctor set nombre_doctor='$nombre',apellidos_doctor='$apellidos',
	especialidad_doctor='$especialidad', direccion_doctor ='$direccion',tel_doctor='$telefono',
	ciudad_doctor='$ciudad',estado_doctor='$estado',pais_doctor='$pais',
	atencion='$atencion',precio='$precio',instalaciones='$instalaciones',puntualidad='$puntualidad',lo_recomiendas='$lorecomendarias',
	eficiencia='$eficiencia',comentarios='$comentarios',nombre_usuario='$usuario',email_usuario='$email',
	verificado='$verificado' where id_opinion_doctor= '".$id."'");
	if(mysqli_error($link)){
		$result['error']=mysql_error($link);
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