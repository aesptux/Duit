<?php
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