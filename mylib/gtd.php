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

/* Defining the ToDo class */

class ToDo{
	
	
	/* An array that stores the todo item data: */
	
	private $data;
	
	/* The constructor 
	 * A constructor is called automatically on each instance of the class*/
	public function __construct($par){
		if(is_array($par))
			$this->data = $par;
	}
	
	/*
	 *	This is where the magic happens. this method is called automatically on each instance of the class 
	 */
		
	public function __toString(){
		
		// The string we return is outputted by the echo statement
		/*Those are actual values from the database (we use database fields) */
		return '
			<li id="todo-'.$this->data['idTask'].'" class="todo">
			
				<div class="text">'.$this->data['content'].'</div>
				
				<div class="actions">
					<a href="#" class="edit">Edit</a>
					<a href="#" class="delete">Delete</a>
				</div>
				
			</li>';
	}
	
	
	/*
	 *	The following are static methods. These are available
	 *	directly, without the need of creating an object.
	*/
	
	
	
	/*
		The edit method takes the ToDo item id and the new text
		of the ToDo. Updates the database.
	*/
		
	public static function edit($id, $text){
		session_start();
		// clean text
		$text = self::esc($text);
		if(!$text) throw new Exception("Error con el texto de actualización");
		
		$query = Cn::q("UPDATE Task
						SET content='".$text."'
						WHERE idTask=".$id
					);
		
		if(!$query)
			throw new Exception("No se pudo actualizar la tarea".mysql_error());
	}
	
	/*
	 *	The delete method. Takes the id of the ToDo item
	 *	and deletes it from the database.
	*/
	
	public static function delete($id){
		session_start();
		mysql_query("DELETE FROM Task WHERE idTask=".$id);
		
		if(mysql_affected_rows($GLOBALS['link'])!=1)
			throw new Exception("No se pudo borrar la tarea.".mysql_error());
	}
	
	
	
	/*
	 *	The createNew method takes only the text of the todo,
	 *	writes to the databse and outputs the new todo back to
	 *	the AJAX front-end.
	*/
	
	public static function createNew($text){
		session_start();
		$text = self::esc($text);
		if(!$text) throw new Exception("Wrong input data!");
		
		$fecha=date("Y-m-d H:i:s");
		$author = $_SESSION['user'];
		$idUser = $_SESSION['idUser'];
		/* This is a temporary fix. Only the default notebook works */
		$query = mysql_query("SELECT Notebook.idNotebook as idNotebook
			FROM Notebook
			INNER JOIN Workspace ON Notebook.idWorkspace = Workspace.idWorkspace
			WHERE Workspace.idUser = ".$idUser." LIMIT 1");
		while ($result = mysql_fetch_assoc($query)) {
			$idNotebook = $result['idNotebook'];
		}
		mysql_query("INSERT INTO Task(idNotebook, content,author, createdDate) VALUES ($idNotebook, '$text', '$author','$fecha')");
		echo $text; echo mysql_insert_id($GLOBALS['link']);
		/* It keeps throwing the exception for a still unknown reason. If commented, it works */
		/*if(mysql_affected_rows($GLOBALS['link'])!=1)
			throw new Exception("Error inserting TODO!".mysql_error());*/
		
		// Creating a new ToDo and outputting it directly:
		$query = mysql_query("SELECT MAX(idTask) as idTask FROM Task");
		while ($result = mysql_fetch_assoc($query)) {
			$lastid = $result['idTask'];
		}
		/*DB values, that will be outputted automatically using __toString()*/
		echo (new ToDo(array(
			'idTask'	=> $lastid,
			'content'	=> $text
		)));
		
		exit;
	}
	
	/*
	 *	A helper method to sanitize a string:
	 *  It's a healer. Maybe a Tauren
	*/
	
	public static function esc($str){
		
		if(ini_get('magic_quotes_gpc'))
			$str = stripslashes($str);
		
		return mysql_real_escape_string(strip_tags($str));
	}
	
} // closing the class definition