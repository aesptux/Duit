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
define('DBUSER', ''); // database user
define('DBNAME', ''); // database name
define('DBSERVER', ''); // database server
define('DBPASS', ''); // database password
	
class Cn {
	/* If there is die, there is no exception */
	private $link; // this is the usual link.
	/* CONNECT */
	function conn() {
		mysql_connect(DBSERVER,DBUSER,DBPASS) or die ("No se pudo conectar con la base de datos ". mysql_error());
	}
	
	/* SELECT DB */
	function selectdb() {
		mysql_select_db(DBNAME);
	}
	
	/* QUERY */
	function q($query) {
		$result= mysql_query($query) or die ("Error al realizar la consulta ". mysql_error());
		return $result;
	}
	
	/* FETCH RESULTS, CAN PASS MYSQL_ASSOC OR MYSQL_NUM */
	function f($result) {
		$result = mysql_fetch_array($result) ;
		return $result;
	}
	
	
	
}

?>
