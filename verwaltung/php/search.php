<?php
require_once 'db.php';
// Output HTML formats
$html = '<tr>';
$html .= '<td class="small">nameString</td>';
$html .= '<td class="small">espString</td>';
$html .= '<td class="small">ciuString</td>';
$html .= '<td class="small">estString</td>';
$html .= '<td class="small">paiString</td>';
$html .= '<td class="small">codeString</td>';
$html .= '</tr>';

// Get the Search
$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_GET['query']);
$search_string = $test_db->real_escape_string($search_string);

$search_string_esp =  $_GET['esp'];



// Check if length is more than 1 character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
	//Insert Time Stamp
	$time = "UPDATE query_data SET timestamp=now() WHERE name='" .$search_string. "'";
	//Count how many times a query occurs
	$query_count = "UPDATE query_data SET querycount = querycount +1 WHERE name='" .$search_string. "'";
	// Query
	$query = 'SELECT * FROM tb_doctores WHERE especialidad_doctor = "'.$search_string_esp.'" AND  (nombre_doctor LIKE "%'.$search_string.'%" 
			OR apellidos_doctor LIKE "%'.$search_string.'%" 
			OR ciudad_doctor LIKE "%'.$search_string.'%"
			OR estado_doctor LIKE "%'.$search_string.'%"
			OR pais_doctor LIKE "%'.$search_string.'%" 
					)  AND doctor_activo = 1';

	//Timestamp entry of search for later display
	$time_entry = $test_db->query($time);
	//Count how many times a query occurs
	$query_count = $test_db->query($query_count);
	// Do the search
	$result = $test_db->query($query);
	while($results = $result->fetch_array()) {
		$result_array[] = $results;
	}
	
	// Check for results
	if (isset($result_array)) {
		foreach ($result_array as $result) {
		// Output strings and highlight the matches
		 $d_name = preg_replace("/".$search_string."/i", "<b>".$search_string."</b>", $result['nombre_doctor']);
		 $d_apellidos = preg_replace("/".$search_string."/i", "<b>".$search_string."</b>", $result['apellidos_doctor']);
		 $d_especialidad = preg_replace("/".$search_string."/i", "<b>".$search_string."</b>", $result['especialidad_doctor']);
		 $d_ciudad = preg_replace("/".$search_string."/i", "<b>".$search_string."</b>", $result['ciudad_doctor']);
		 $d_estado = preg_replace("/".$search_string."/i", "<b>".$search_string."</b>", $result['estado_doctor']);
		 $d_pais = preg_replace("/".$search_string."/i", "<b>".$search_string."</b>", $result['pais_doctor']);
		 
		 $enlace = '<a href="info_doctor.php?cod='.$result['codigo_doctor'].'"/#doctor role="button" class="btn btn-large btn-primary" data-toggle="modal" data-id="'.$result['codigo_doctor'].'">
  <img src="img/info.png"  style="width:42px;height:42px;border:0">
</a>';
		
		 
		// Replace the items into above HTML
		$o = str_replace('nameString', $d_name." ".$d_apellidos, $html);
		$o = str_replace('espString', $d_especialidad, $o);
		$o = str_replace('ciuString', $d_ciudad, $o);
		$o = str_replace('estString', $d_estado, $o);
		$o = str_replace('paiString', $d_pais, $o);
		$o = str_replace('codeString', $enlace, $o);
		// Output it
		echo($o);
			}
		}else{
		// Replace for no results
		$o = str_replace('nameString', '<span class="label label-danger">NO HAY RESULTADOS</span>', $html);
		$o = str_replace('espString', '', $o);
		$o = str_replace('ciuString', '', $o);
		$o = str_replace('estString', '', $o);
		$o = str_replace('paiString', '', $o);
		// Output
		echo($o);
	}
}
?>