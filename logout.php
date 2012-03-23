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
include 'mylib/header.php';
include 'mylib/footer.php';
getHeader("Duit | Cerrar sesión");
if(!isset($_SESSION['email'])){
	$error .= "No has iniciado sesión."  
	?>
	
	<div class="container">
			<div class="row">
				<div class="six columns centered">			
					<h4>Cerrar sesión en Duit</h4><br>
						<form>
							<div class='form-field error'>
								<small>Whoaa! Se ha producido un error:<br><br> <?php echo $error; ?> </small>
								<a href="index.php">Ir al inicio</a>
							</div>
						</form>
				</div>
			</div>
		</div>
<?php  
} else {
	/* literally, destroy the user! */  
	session_unset();   
	session_destroy();  
?>
<div class="container">
	
	<div class="row">
		<div class="six columns centered">			
			<h4>Cerrar sesión en Duit</h4>
			<p>Gracias por utilizar Duit</p>
			<p>Esperamos volver a verte pronto</p>
		</div>
	</div>
</div>

<?php
}  	

getFooter();


?>