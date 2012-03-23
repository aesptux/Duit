<?php
/*
 * Created on ${date}.
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
include 'mylib/footer.php';
include 'mylib/header.php';
getHeader("Duit | Recuperar contraseña");
?>

<!-- BEGIN VALIDATION ENGINE   -->
<script>
$(document).ready(function(){
    $("#myform").validationEngine();
   });
</script>
<div class="container">
	
	<div class="row">
		<div class="six columns centered">			
			<h4>Recuperar contraseña</h4>
			<form id="myform" class="nice" name="recoverform" action="process_recover.php" method="post">
				<label>Email</label>
				<input class="oversize input-text validate[required,custom[email],ajax[ajaxRecoverEmailCallPhp]]" type="text" name="useremail" id="email" placeholder="Introduce tu email" />
				<input type="submit" class="nice medium radius white button" name="enviarf" value="Enviar" />
			</form>
			
		</div>
	</div>
</div>


<?php
	getFooter();

?>