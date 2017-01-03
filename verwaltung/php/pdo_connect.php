<?php
// Connection data (server_address, database, name, poassword)
$hostdb = 'localhost';
$namedb = 'herasosj_hera';
$userdb = 'herasosj_hera';
$passdb = 'Papa020432';

try {
	// Connect and create the PDO object
	$conn = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
	$conn->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8

	
	

	        // Disconnect
}
catch(PDOException $e) {
	echo $e->getMessage();
}
?>