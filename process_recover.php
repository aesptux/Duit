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
getHeader("Duit | Recuperar contraseña");
/* clean fields to avoid madness ! */
function clean($string) {
	if (get_magic_quotes_gpc())
		$string = stripslashes($string);
	$string = htmlspecialchars($string);
	$string = trim($string);
	return mysql_real_escape_string($string);
}
define ("MAX_LENGTH", 20);
 
function randomPass() {
	$randomStr = '';
	for ($i=0; $i<MAX_LENGTH;$i++) {
		$chr = mt_rand(0, 9);
		$randomStr .= $chr;	
	}
	
	return $randomStr;
}
 
$email = clean($_POST['useremail']);

//echo $usercountry;
/*check if fields are empty */
if (empty($email)) {
	$error .= "No puedes dejar ningún campo vacío<br>";
} 
$res = ereg(
'^[a-z0-9]+([\.]?[a-z0-9_-]+)*@'. // this is the user
'[a-z0-9]+([\.-]+[a-z0-9]+)*\.[a-z]{2,}$', // this is the server
$email);
if (!$res) {
	$error .= "El correo no es correcto<br>";
}  else {
	$host = strstr($email, '@'); // this returns @domain.whatever
	$host = str_replace("@", "", $host); // remove @
	if (!dns_get_mx($host, $mxhosts)) { // check if domain has MX record
		$error .= "El dominio de tu correo no responde<br>";
	} 
		
}

if (isset($error)) {
?>
<div class="container">
	
	<div class="row">
		<div class="six columns centered">			
			<h4>Registrarse en Duit</h4>
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


	$resultemail = Cn::q("SELECT email FROM User WHERE email='$email'");
	$validateemail = Cn::f($resultemail);
	if ($validateuser>0|$validateemail>0) {
		/* generate random pass */
		$randompassword = randomPass();
		$sha1pass = sha1($randompassword);
		
		$update = Cn::q("UPDATE User SET password = '$sha1pass' WHERE email = '$email'");
		$body .= "\n\n\n\nEsta es tu nueva contraseña, se recomienda cambiarla cuanto antes.\n\n\n\n";
		$body .= "Contraseña: $randompassword\n\n\n\n\n";
		$body .= "El administrador de Duit.";
		$from = "From: Duit <duit@aesptux.com>\r\n"; 
		mail($email,"Datos de acceso a Duit",$body,$from) or die ("Falló el envio del correo");
		
	?>
		<div class="container">
	
	<div class="row">
		<div class="six columns centered">			
			<h4>Recuperación de contraseña</h4>
			<p>Se ha enviado un correo con tu nueva contraseña</p>
		</div>
	</div>
</div>
<?php	
	} else {
		$errorbd .= "El email no existe en nuestra base de datos";
	
} 
	
	}
getFooter();
?>