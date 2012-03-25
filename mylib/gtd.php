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

/* Defining the Gtd class */

class ToDo{
	
	/* An array that stores the todo item data: */
	
	private $data;
	
	/* The constructor */
	public function __construct($par){
		if(is_array($par))
			$this->data = $par;
	}
	
	/*
		This is where the magic happens. this method is called automatically on each instance of the class 
	*/
		
	public function __toString(){
		
		// The string we return is outputted by the echo statement
		
		return '
			<li id="todo-'.$this->data['idTask'].'" class="todo">
			
				<div class="text"><div class="panel"><p>'.$this->data['content'].'</p><div class="actions">
					<a href="#" class="edit">Edit</a>
					<a href="#" class="delete">Delete</a>
				</div></div>
				
				
				</div>
			</li>';
	}
	
	
	/*
		The following are static methods. These are available
		directly, without the need of creating an object.
	*/
	
	
	
	/*
		The edit method takes the ToDo item id and the new text
		of the ToDo. Updates the database.
	*/
		
	public static function edit($id, $text){
		session_start();
		$text = self::esc($text);
		if(!$text) throw new Exception("Wrong update text!");
		
		$query = Cn::q("UPDATE Task
						SET content='".$text."'
						WHERE idTask=".$id
					);
		
		if(!$query)
			throw new Exception("Couldn't update item!".mysql_error());
	}
	
	/*
		The delete method. Takes the id of the ToDo item
		and deletes it from the database.
	*/
	
	public static function delete($id){
		session_start();
		mysql_query("DELETE FROM Task WHERE idTask=".$id);
		
		if(mysql_affected_rows($GLOBALS['link'])!=1)
			throw new Exception("Couldn't delete item!".mysql_error());
	}
	
	/*
		The rearrange method is called when the ordering of
		the todos is changed. Takes an array parameter, which
		contains the ids of the todos in the new order.
	*/
	
	/*public static function rearrange($key_value){
		
		$updateVals = array();
		foreach($key_value as $k=>$v)
		{
			$strVals[] = 'WHEN '.(int)$v.' THEN '.((int)$k+1).PHP_EOL;
		}
		
		if(!$strVals) throw new Exception("No data!");
		
		// We are using the CASE SQL operator to update the ToDo positions en masse:
		
		mysql_query("	UPDATE tz_todo SET position = CASE id
						".join($strVals)."
						ELSE position
						END");
		
		if(mysql_error($GLOBALS['link']))
			throw new Exception("Error updating positions!");
	}*/
	
	/*
		The createNew method takes only the text of the todo,
		writes to the databse and outputs the new todo back to
		the AJAX front-end.
	*/
	
	public static function createNew($text){
		session_start();
		$text = self::esc($text);
		/*if(!$text) throw new Exception("Wrong input data!");
		
		$posResult = mysql_query("SELECT MAX(position)+1 FROM tz_todo");
		
		if(mysql_num_rows($posResult))
			list($position) = mysql_fetch_array($posResult);

		if(!$position) $position = 1;*/
		$fecha=date("Y-m-d H:i:s");
		$author = $_SESSION['user'];
		mysql_query("INSERT INTO Task(idNotebook, content,author, createdDate) VALUES (3, '$text', '$author','$fecha')");

		/*if(mysql_affected_rows($GLOBALS['link'])!=1)
			throw new Exception("Error inserting TODO!".mysql_error());*/
		
		// Creating a new ToDo and outputting it directly:
		
		echo (new ToDo(array(
			'id'	=> mysql_insert_id($GLOBALS['link']),
			'text'	=> $text
		)));
		
		exit;
	}
	
	/*
		A helper method to sanitize a string:
	*/
	
	public static function esc($str){
		
		if(ini_get('magic_quotes_gpc'))
			$str = stripslashes($str);
		
		return mysql_real_escape_string(strip_tags($str));
	}
	
} // closing the class definition