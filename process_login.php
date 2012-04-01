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
include 'mylib/footer.php';
include 'mylib/header.php';
getHeader("Duit | Login");
/* clean fields to avoid madness ! */
function clean($string) {
	if (get_magic_quotes_gpc())
		$string = stripslashes($string);
	$string = htmlspecialchars($string);
	$string = trim($string);
	return mysql_real_escape_string($string);
} 
 
$email = clean($_POST['email']);
$pass1 = clean($_POST['pass1']);

//echo $usercountry;
/*check if fields are empty */
if (empty($email) || empty($pass1)) {
	$error .= "No puedes dejar ningún campo vacío<br>";
} 

/* if error, show error */
if (isset($error)) {
?>
<div class="container">
	
	<div class="row">
		<div class="six columns centered">			
			<h4>Iniciar sesión en Duit</h4>
			<form>
			<div class='form-field error'>
				<small>Whoaa! Se ha producido un error:<br> <?php echo $error; ?> </small>
			</div>
			</form>
		</div>
	</div>
</div>
<?php	
}
if (!isset($error)) {

	/*retrieve data from db */	
	$result = Cn::q("SELECT idUser,username,email,password FROM User WHERE email='$email'", MYSQL_ASSOC);
	$validate = Cn::f($result);
	

	/* if we have more than one row, user entered wrong data 
	 * If not, user entered inexistent data
	 */
	if ($validate<=0) {
		$errorbd .= "Por favor revisa los datos";
		?>
		<div class="container">
			<div class="row">
				<div class="six columns centered">			
					<h4>Iniciar sesión en Duit</h4><br/>
						<form>
							<div class='form-field error'>
								<small>Whoaa! Se ha producido un error:<br><br> <?php echo $errorbd; ?> </small>
							</div>
						</form>
				</div>
			</div>
		</div>
<?php
	} else {
		/*The user may not remember password. Ask to recover */
		/* checked. Use SHA1 on password */
		$sha1pass = sha1($pass1);
		$ipuser = $_SERVER['REMOTE_ADDR'];
		$country = getGeo();
		if($validate['password'] != $sha1pass) {
			$errorbd .= "La contraseña no es correcta";
			?>
			<div class="container">
			<div class="row">
				<div class="six columns centered">			
					<h4>Iniciar sesión en Duit</h4><br>
						<form>
							<div class='form-field error'>
								<small>Whoaa! Se ha producido un error:<br><br> <?php echo $errorbd; ?> </small>
								<a href="recover.php">¿Has olvidado tu contraseña?</a>
							</div>
						</form>
				</div>
			</div>
		</div>
		<?php
				} else {

					/* should be correct, store data on session */

					$_SESSION['user'] = $validate['username'];
					$_SESSION['email'] = $validate['email'];
					$_SESSION['idUser'] = $validate['idUser'];
					$_SESSION['created'] = time();
					
					/* and update dateLastAccess field */
					$user = $validate['username'];
					
					$update = Cn::q("UPDATE User SET dateLastAccess = CURDATE() WHERE username = '$user'");
					
					 ?>
					 <div class="container">
						<div class="row">
							<div class="six columns centered">			
								<h4>Iniciar sesión en Duit</h4>
									<p>Has accedido correctamente <?php echo $user;   ?></p>
									<p>Haz click <a href="index.php">aquí</a> para ir al inicio</p>
							</div>
						</div>
					</div>
<?php
				//sleep(10);
					//setcookie('userlogged',$validate['username'],time()+30);
					
					Header ("Location: index.php");
				}
		

		}	
} 
	
	
getFooter();
?>