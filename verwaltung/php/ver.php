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


echo "hola";

	$query = 'SELECT * FROM tb_opiniones_doctor ';

	
	// Do the search
	$result = $test_db->query($query);
	while($results = $result->fetch_array()) {
		$result_array[] = $results;
	}
	
	// Check for results
	if (isset($result_array)) {
		foreach ($result_array as $result) {
		// Output strings and highlight the matches
		 $d_name = preg_replace("/".$search_string."/i", "<b>".$search_string."</b>", $result['nombre_usuario']);
		
		 
		
		
		// Replace the items into above HTML
		$o = str_replace('nameString', $d_name, $html);
		$o = str_replace('espString', $d_especialidad, $o);
		$o = str_replace('ciuString', $d_ciudad, $o);
		$o = str_replace('estString', $d_estado, $o);
		$o = str_replace('paiString', $d_pais, $o);
		
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
echo "hola";
?>