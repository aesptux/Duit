<?php

/*
 * 
 * Author: Adrián Espinosa
 * This file is part of Duit.
 *
 * Duit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Duit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Duit.  If not, see <http://www.gnu.org/licenses/>.
 */
function getHeader($title) {
	
	include 'mylib/connect.php';
	
	try {
		$c = Cn::conn();
		//echo $c;
		$s = Cn::selectdb();
		//echo $s;
		if (!$c){
		 throw new Exception("Error en la conexion con la BD ---".mysql_error());
		} 
		if (!$s){
		 throw new Exception("Error seleccionar la base de datos ---".mysql_error());
		} 
	}catch( Exception $e ) {
		/* if it fails, we want to record the error to another database*/
		mysql_connect('localhost','root','123456789a') or die ("Error al conectar con el log de errores -> ". mysql_error());
		mysql_select_db('duiterrors') or die ("Error al seleccionar el log de errores -> ". mysql_error());
		$fecha = date("Y-m-d H:i:s");
		$file = __FILE__;
		/*we have to clean the string to insert it*/
		$error = Cn::clean($e->getMessage());
		echo $error;
		$errorContent = $error;
		mysql_query("INSERT INTO errorlog (dateError, contentError, archivo) VALUES ('$fecha','$errorContent', '$file')")
		or die ("Error al insertar una linea en el log");
		Header ("Location: error.html");
		}
		
	

//	Cn::selectdb();
	/*$myuser = 'aesptux1';
	$result = Cn::q("SELECT username FROM User WHERE username = '$myuser'");
	while ($row = Cn::f($result, MYSQL_ASSOC)) {
		$devuelto = $row['username'];
	}
	echo "El valor devuelto es -> $devuelto";*/
	/* geolocalization */
	session_start();

	
?>
<!DOCTYPE html>


<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es"> <!--<![endif]-->
<head>
	<meta charset="ISO-8859-1" />

	<!-- Set the viewport width to device width for mobile -->
	<meta name="description" content="" />
  	<meta name="author" content="Adrian Espinosa" />
  	<meta name="viewport" content="width=device-width; initial-scale=1.0" />
	<meta name="viewport" content="width=device-width" />
	<link rel="shortcut icon" href="res/favicon.ico" />

	<title><?php echo $title; ?></title>
  
	<!-- Included CSS Files -->
	<link rel="stylesheet" href="stylesheets/foundation.css">
	<link rel="stylesheet" href="stylesheets/app.css">
	<link rel="stylesheet" href="stylesheets/validationEngine.jquery.css">

	<!--[if lt IE 9]>
		<link rel="stylesheet" href="stylesheets/ie.css">
	<![endif]-->


	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="javascripts/foundation.js"></script>
	<script src="javascripts/app.js"></script>
	<script src="javascripts/jquery-1.6.min.js"></script>
	<!--<script src="javascripts/jquery.form.js"></script>-->
	<script src="javascripts/jquery.validationEngine.js"></script>
	<script src="javascripts/jquery.validationEngine-es.js"></script>
	<script src="myjs/pomodoro.js"></script>
	<script src="myjs/gtd.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

</head>
<body>
	<div class="row">
			<div class="twelve columns">
				<a style="color: #555;" href="index.php"><p class="title">Duit</p></a> <p class="subtitle">Just a Simple GTD</p>
				<hr />
							
			</div>
		</div>
<?php
}
/* GET GEOLOCALIZATION */
function getGeo() {
	include("lib/geoip.inc");
$gi = geoip_open("lib/GeoIP.dat",GEOIP_MEMORY_CACHE);
$usercountry = geoip_country_name_by_addr($gi, $_SERVER['REMOTE_ADDR']);
geoip_close($gi);
return $usercountry;
}
?>