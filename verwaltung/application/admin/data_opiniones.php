<?php
include "../config.php";
$query=mysqli_query($link,"SELECT @rownum := @rownum + 1 AS urutan,t.*,r.*
	FROM tb_opiniones_doctor t LEFT JOIN tb_especialidades r ON t.id_especialidad = r.id_especialidad ") ;
$data = array();
while($r = mysqli_fetch_assoc($query)) {
	$data[] = $r;
}
$i=0;
foreach ($data as $key) {
		// add new button
	$data[$i]['button'] = '<button type="submit" id="'.$data[$i]['id_opinion_doctor'].'" class="btn btn-primary btnedit" ><i class="fa fa-edit"></i></button> 
							   <button type="submit" id="'.$data[$i]['id_opinion_doctor'].'" nombre="'.$data[$i]['nombre_doctor'].'" class="btn btn-primary btnhapus" ><i class="fa fa-remove"></i></button>';
	$i++;
}
$datax = array('data' => $data);
echo json_encode($datax);
?>