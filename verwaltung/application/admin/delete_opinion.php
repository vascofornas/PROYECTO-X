<?php
include "../config.php";

$id = $_POST['id'];

mysqli_query($link,"delete from tb_opiniones_doctor where id_opinion_doctor= '".$id."'");
if(mysqli_error($link)){
	$result['error']=mysql_error($link);
	$result['result']=0;
}else{
	$result['error']='';
	$result['result']=1;
}
echo json_encode($result);

?>