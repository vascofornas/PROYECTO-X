<?php
include "../config.php";

$id=$_POST['id'];
$query=mysqli_query($link,"select * from tb_opiniones_doctor where id_opinion_doctor= '".$id."'");
$array = array();
while($data = mysqli_fetch_array($query)){
	$array['id_opinion_doctor']= $data['id_opinion_doctor'];
	$array['nombre_doctor']= $data['nombre_doctor'];
	$array['apellidos_doctor']= $data['apellidos_doctor'];
	$array['direccion_doctor']= $data['direccion_doctor'];
	$array['especialidad_doctor']= $data['especialidad_doctor'];
	$array['ciudad_doctor']= $data['ciudad_doctor'];
	$array['estado_doctor']= $data['estado_doctor'];
	$array['pais_doctor']= $data['pais_doctor'];
	$array['tel_doctor']= $data['tel_doctor'];
	$array['atencion']= $data['atencion'];
	$array['precio']= $data['precio'];
	$array['instalaciones']= $data['instalaciones'];
	$array['lo_recomiendas']= $data['lo_recomiendas'];
	$array['eficiencia']= $data['eficiencia'];
	$array['comentarios']= $data['comentarios'];
	$array['puntualidad']= $data['puntualidad'];
	$array['nombre_usuario']= $data['nombre_usuario'];
	$array['email_usuario']= $data['email_usuario'];
	$array['verificado']= $data['verificado'];


}
echo json_encode($array);

?>