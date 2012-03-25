<?php
/*
 * Created on Mar 25, 2012.
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
 require "connect.php";
 require "gtd.php";
 Cn::conn();
 Cn::selectdb();
$id = (int)$_GET['id'];

try{

	switch($_GET['action'])
	{
		case 'delete':
			ToDo::delete($id);
			break;
			
		case 'rearrange':
			ToDo::rearrange($_GET['positions']);
			break;
			
		case 'edit':
			ToDo::edit($id,$_GET['text']);
			break;
			
		case 'new':
			ToDo::createNew($_GET['text']);
			break;
	}

}
catch(Exception $e){
	echo $e->getMessage();
	die("0");
}

echo "1";
?>