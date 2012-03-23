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
define('DBUSER', 'root'); // database user
define('DBNAME', 'duitdb'); // database name
define('DBSERVER', 'localhost'); // database server
define('DBPASS', 'etg11123'); // database password
	
class Cn {
	/* If there is die, there is no exception */
	private $link; // this is the usual link.
	/* CONNECT */
	function conn() {
		if (!mysql_connect(DBSERVER,DBUSER,DBPASS)) {
			return false;
		} else {
			return true;
		}//or die ("No se pudo conectar con la base de datos ". mysql_error());
		
	}
	
	/* SELECT DB */
	function selectdb() {
		if (!mysql_select_db(DBNAME)) {
			return false;
		} else {
			return true;
		}
	}
	
	/* QUERY */
	function q($query) {
		if (!$result= mysql_query($query)) {
			return false;
		} else  {
			return $result;
		}//or die ("Error al realizar la consulta ". mysql_error());
		
	}
	
	/* FETCH RESULTS, CAN PASS MYSQL_ASSOC OR MYSQL_NUM */
	function f($result) {
		$result = mysql_fetch_array($result) ;
		return $result;
	}
	
	function clean($string) {
	if (get_magic_quotes_gpc())
		$string = stripslashes($string);
	$string = htmlspecialchars($string);
	$string = trim($string);
	return mysql_real_escape_string($string);
}
	function ex() {
		mysql_connect('localhost','root','etg1112') or die ("Error al conectar con el log de errores -> ". mysql_error());
		mysql_select_db('duiterrors') or die ("Error al seleccionar el log de errores -> ". mysql_error());
		$fecha = date("Y-m-d H:i:s");
		$file = __FILE__;
		/*we have to clean the string to insert it*/
		$error = Cn::clean($e->getMessage());
		echo $error;
		$errorContent = $error;
		mysql_query("INSERT INTO errorlog (dateError, contentError, archivo) VALUES ('$fecha','$errorContent', '$file')")
		or die ("Error al insertar una linea en el log");
		Header ("Location: /duit/error.html");
	}
	
	
}

?>
