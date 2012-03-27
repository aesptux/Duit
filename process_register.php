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
getHeader("Duit | Registro");
/* clean fields to avoid madness ! */
/* Change this on refactor */
function clean($string) {
	if (get_magic_quotes_gpc())
		$string = stripslashes($string);
	$string = htmlspecialchars($string);
	$string = trim($string);
	return mysql_real_escape_string($string);
} 
 /* values from form*/
$username = clean($_POST['username']);
$email = clean($_POST['useremail']);
$pass1 = clean($_POST['pass1']);
$pass2 = clean($_POST['pass2']);
//echo $usercountry;
/*check if fields are empty */
if (empty($username) || empty($email) || empty($pass1) || empty($pass2) ) {
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
if ($pass1 != $pass2 || strlen($pass1) < 8) {
	$error .= "Las contraseñas deben coincidir y ser de un mínimo de 8 caracteres<br>";
}

/* if error is set, we show error page */
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
/*if error not set, process register */
if (!isset($error)) {
	/* check again whether username or email exist on db */
	$resultuser = Cn::q("SELECT username FROM User WHERE username = '$username'");
	$validateuser = Cn::f($resultuser); 

	$resultemail = Cn::q("SELECT email FROM User WHERE email='$email'");
	$validateemail = Cn::f($resultemail);
	if ($validateuser>0|$validateemail>0) {
		$errorbd .= "El nombre de usuario o el email ya existen";
	} else {
		/* checked. Use SHA1 on password */
		$sha1pass = sha1($pass1);
		$ipuser = $_SERVER['REMOTE_ADDR'];
		$country = getGeo();
		$insert = Cn::q("INSERT INTO User (email, username, password, ipRegister, ipLastAccess, geoRegister, geoNow, signupDate)
						VALUES ('$email', '$username', '$sha1pass', '$ipuser', '$ipuser', '$country', '$country', CURDATE())");
		/*once the user exists, we may create the default workspace and notebook */
		$query = Cn::q("SELECT MAX(idUser) as idUser FROM User");
		while ($result = Cn::f($query)) {
			$idUser = $result['idUser'];
		}
		/* we create default workspace and default notebook
		 * Control errors with exceptions 
		 */
		try {
			
			$defaultw = Cn::q("INSERT INTO Workspace(idUser, createdDate, name)
						VALUES ($idUser, CURDATE(), 'Espacio de $username')");
			if (!$defaultw){
		 		throw new Exception("Fallo workspace ---".mysql_error());
			} 
			
			$query = Cn::q("SELECT MAX(idWorkspace) as idWorkspace FROM Workspace");
				while ($result = Cn::f($query)) {
				$idWorkspace = $result['idWorkspace'];
			}
			$defaultn = Cn::q("INSERT INTO Notebook(idWorkspace, name, createdDate)
						VALUES ($idWorkspace, 'Cuaderno de $username', CURDATE())");
			if (!$defaultn){
		 		throw new Exception("Fallo notebook ---".mysql_error());
			}
		} catch(Exception $e) {
			/* if it fails, we want to record the error to another database*/
		mysql_connect('localhost','root','123456789a') or die ("Error al conectar con el log de errores -> ". mysql_error());
		mysql_select_db('duiterrors') or die ("Error al seleccionar el log de errores -> ". mysql_error());
		$fecha = date("Y-m-d H:i:s");
		$file = __FILE__;
		/*we have to clean the string to insert it*/
		$error = Cn::clean($e->getMessage());
		echo $error;
		$errorContent = $error;
		mysql_query("INSERT INTO errorlog (dateError, contentError, archivo) VALUES ('$fecha','$errorContent', '$file')")
		or die ("Error al insertar una linea en el log");
		Header ("Location: error.html");
		}
		}
		
		/*send email */
		$body = "Usuario: ".$username."\n";
		$body .= "Contraseña: ".$pass1."\n";
		$body .= "\n\n\n\nGracias por registrarte en Duit.\n\n\n\n";
		$body .= "El administrador de Duit.";
		$from = "From: Duit <duit@aesptux.com>\r\n"; 
		//mail($email,"Datos de acceso a Duit",$body,$from) or die ("Falló el envio del correo");
		
		?>
	
	
	<div class="container">
	
	<div class="row">
		<div class="six columns centered">			
			<h4>Registrarse en Duit</h4>
			<p>Gracias por registrarte en Duit</p>
			<p>Se ha enviado un correo con tus datos de acceso</p>
		</div>
	</div>
</div>
	
<?php
		}	
//} 
	
	
getFooter();
?>