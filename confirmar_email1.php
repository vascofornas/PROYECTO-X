<?php
	
   
 
    
 $db_host = "localhost";
 $db_name = "herasosj_hera";
 $db_user = "herasosj_hera";
 $db_pass =  "Papa020432";
 
 				


// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$link = new PDO("mysql:host=$db_host;dbname=$db_name",$db_user,$db_pass);
$link -> exec("set names utf8");


// assuming a named submit button
if(isset($_GET['cod']))
{

	try {
		$stmt = $link->prepare('SELECT `codigo_verificacion` FROM `tb_opiniones_doctor` WHERE codigo_verificacion = ?');
		$stmt->bindParam(1, $_GET['cod']);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

		}
	}
	catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HERA</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    

html, body{
  height: 100%;
}
body { 
			background-image: url(imagenes/fondo_hera.png) ;
			background-position: center center;
			background-repeat:  no-repeat;
			background-attachment: fixed;
			background-size:  cover;
			background-color: #999;
			text-align: center;
  			text-shadow: 0 1px 3px rgba(0,0,0,.5);
  
  
}


/* Remove margins and padding from the list, and add a black background color */
ul.topnav {
     list-style-type: none;
    margin: 0;
    padding: 10px;
    width: 100%;
    display: inline-block;
   
}

/* Float the list items side by side */
ul.topnav li {
	margin: 10;
    padding: 10;
    display: inline;
  }

/* Style the links inside the list items */
ul.topnav li a {
    display: inline-block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    transition: 0.3s;
    font-size: 40px;
}

/* Change background color of links on hover */
/* ul.topnav li a:hover {background-color: #fff;}

/* Hide the list item that contains the link that should open and close the topnav on small screens */
ul.topnav li.icon {display: none;}
/* When the screen is less than 680 pixels wide, hide all list items, except for the first one ("Home"). Show the list item that contains the link to open and close the topnav (li.icon) */
@media screen and (max-width:680px) {
  ul.topnav li:not(:first-child) {display: none;}
  ul.topnav li.icon {
  float: right;
    margin-right: 10%;
    display: inline-block !important;
  }
}

/* The "responsive" class is added to the topnav with JavaScript when the user clicks on the icon. This class makes the topnav look good on small screens */
@media screen and (max-width:680px) {
  ul.topnav.responsive {position: relative;}
  ul.topnav.responsive li.icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  ul.topnav.responsive li {
    float: none;
    display: inline;
  }
  ul.topnav.responsive li a {
    display: block;
    text-align: left;
    z-index : 1;
  }

    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<head>
  <title>Hera</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
  function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
          x.className += " responsive";
      } else {
          x.className = "topnav";
      }
  }
  
  </script>
</head>
</head>

<body>

<ul class="topnav" id="myTopnav">
  <li><a href="index.html"><img class="img-responsive" width="60px" src="imagenes/botones/logo_hera.png" /></a></li>
  <li><a href="doctores.html"><img class="img-responsive" width="180px" src="imagenes/botones/doctores_boton.png" /></a></li>
  <li><a href="#news"><img class="img-responsive" width="180px" src="imagenes/botones/hospitales_boton.png" /></a></li>
  <li><a href="#news"><img class="img-responsive" width="180px" src="imagenes/botones/farmacias_boton.png" /></a></li>
  <li><a href="#news"><img class="img-responsive" width="180px" src="imagenes/botones/laboratorios_boton.png" /></a></li>
  
  <li class="icon">
    <a href="javascript:void(0);" onclick="myFunction()">&#9776;</a>
  </li>
</ul>


<div class="container">
  <div class="row">
    
     
      <div class="col-sm-12 col-md-10 col-md-offset-1">
              <div style="color:#ffffff"><h4>
<?
	if($stmt->rowCount() > 0){
		echo "EMAIL VALIDADO. GRACIAS POR OPINAR EN HERASALUD.COM!";
		echo '<a href="index.html"></a>';
		
		$stmt = $link->prepare('UPDATE tb_opiniones_doctor SET  `verificado` = 1 WHERE codigo_verificacion = ?');
		$stmt->bindParam(1, $_GET['cod']);
		$stmt->execute();
		
	} else {
		echo "TU EMAIL NO HA PODIDO SER VALIDADO.";
	}


}
?>

   </H4> </div>
      </div>  
     
  </div>
</div>


       
    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
