<?php
/*
 * Created on Mar 27, 2012.
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
 
 
 function checkContactData() {
 	if (isset($_POST["sent"])) {
 		putInfo();
 	}
 }
 checkContactData();
 
 function putForm() {
?>


	

		<div class="centered">			
			
			<form id="myform" class="nice" name="contactform" action="mylib/contactform.php" method="post">
				<label>Nombre</label>
				<input id="username" class="oversize input-text" type="text" name="username" placeholder="Introduce tu nombre" />	
				<label>Email</label>
				<input class="oversize input-text" type="text" name="email" id="email" placeholder="Introduce tu email" />
				<label>Motivo de contacto</label>
				<input id="motivo" class="oversize input-text" type="text" name="motivo" placeholder="Introduce un motivo" />
				<label>Comentarios</label>
				<textarea id="standardTexted" name="comentario" rows="5" cols="10"></textarea>
				<input type="hidden" name="sent" value="yes"/>
				<input type="submit" class="nice medium radius white button" name="enviarf" value="Enviar" />
			</form>
			
		</div>



<?php
 }
 function putInfo() {
 	$nombre = $_POST["username"];
 	$email = $_POST["email"];
 	$motivo = $_POST["motivo"];
 	$comentario = $_POST["comentario"];
 	
 	/*Build mail body*/
 	$body = "Email recibido de un usuario\n\n\n";
 	$body .= "Nombre: ".$nombre."\n";
	$body .= "Email: ".$email."\n";
	$body .= "Comentarios: ".$comentario."\n\n";
	$from = "From: $nombre <$email>\r\n"; 
	mail("mortuuslordofdeads@gmail.com","DUIT: ".$motivo,$body,$from) or die ("Falló el envio del correo");
 	Header ("Location: ../mailsent.php");
?>



<?php
 }
?>
