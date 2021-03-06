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
include 'mylib/quotes.php';
require 'mylib/gtd.php';
/*in order to use both values, we use list() */
//list ($gr, $language) = getRandomGreeting();
//list ($qu, $author) = getRandomQuote();
/* well, it seems that php doesn't like list(), I can't get it working, don't know where is the error.
 * So I've decided to make a global variable.
 */
getHeader("Duit");
getRandomGreeting();
getRandomQuote();
$idUser = $_SESSION['idUser'];


?>
<script>
$(document).ready(function() {
$("#quote").hide();	 
$('#showquote').click(function() {
      $('#quote').fadeIn('slow', function() {
        // Animation complete
      });
    });
  });
</script>

	<!-- container -->
	<div class="container">
		
		<?php  if(isset($_SESSION['email'])){
			 
$query = mysql_query("SELECT *
					FROM Task
					INNER JOIN Notebook ON Task.idNotebook = Notebook.idNotebook
					INNER JOIN Workspace ON Notebook.idWorkspace = Workspace.idWorkspace
					WHERE Workspace.idUser =".$idUser);

$tasks = array();

// Filling the $tasks array with new ToDo objects:

while($row = mysql_fetch_assoc($query)){
	$todos[] = new ToDo($row);
}
			?>
			
			<!-- first part. user logged in -->
		<div class="row">
			<div class="three columns">
			<a href="logout.php">Salir</a>
			<!-- greetings part. get a random greeting. Function call is on top-->
			<h5>¡<?php echo "<span title='Duit te saluda en $ql[1]'> $ql[0] "; echo $_SESSION['user']; ?> !</h5>
			<div id="showquote"><p>Haz click aquí para mostrar tu frase aleatoria</p></div>
			<div id="quote"><p><?php echo $qa[0];   ?></p>
					<p><b><?php echo $qa[1];   ?></b></p>	
			</div>
						
				<h4>Notebooks</h4>
				<p>Listado de notebooks aqui</p>
			<?php
			
			$allnotebooks = Cn::q("SELECT Notebook.name
								FROM Notebook
								INNER JOIN Workspace ON Notebook.idWorkspace = Workspace.idWorkspace
								WHERE Workspace.idUser =".$idUser);
			while ($row = Cn::f($allnotebooks)) {
				echo $row['name']."<br>";
			}

			?>
				
			</div>
			<div class="nine columns">
				


				<!--<p>(quizas tener en cuenta su última visita para decirle que no es productivo)</p>-->
				<div class="row">
					<div class="twelve columns">
						<dl class="nice tabs">
							<dd><a href="#simple1" class="active">Tareas</a></dd>
							<dd><a href="#simple2">Pomodoro</a></dd>
						</dl>
						<div class="main">
						<ul class="tabs-content">
							<li class="active" id="simple1Tab">
							
							<div id="main">

	<ul class="todoList">
		<a id="addButton" class="radius blue button" href="#">Añadir tarea</a>
        <?php
		
		// Looping and outputting the $todos array. The __toString() method
		// is used internally to convert the objects to strings:
		
		foreach($todos as $item){
			echo $item;
		}
		
		?>

    </ul>



</div>
							</li>
							
							
							<li id="simple2Tab">

							<div id="pomodoro">
								<h1 id="countdown">25:00</h1>
								<a href="#" class="large radius blue button" onclick="pomodoroStart();" name="start"/>Iniciar</a>
								<a href="#" class="large radius blue button" onclick="pomodoroStop();" name="start"/>Detener</a>
							</div>
							</li>
							
						</ul>
						</div>
					</div>
				</div>
				
				<?php } else {?>
				
				<!-- second part. user not logged in -->
				
				<div class="row">
				
				<div class="eight columns">
					<div class="row">
						<div class="eight columns centered">
								<h2 class="subtitlecontent">¿Qué es Duit?</h2>
								<p style="text-align: justify;">Duit es un gestor de tareas, basado en la técnica GTD.</p>
								<p style="text-align: justify;">Getting Things Done, cuyas siglas son GTD, es un método de gestión de las actividades y el título de un libro de David Allen.
								GTD se basa en el principio de que una persona necesita borrar de su mente todas las tareas que tiene pendientes guardándolas en un lugar específico. De este modo, se libera a la mente del trabajo de recordar todo lo que hay que hacer, y se puede concentrar en la efectiva realización de aquellas tareas.</p>
						</div>
					</div>
					
					<center><div class="row">
						<div class="eight columns centered">
							<h2 class="subtitlecontent">¿Qué me aportaría?</h2>
							<div class="row">
							<div class="six columns">
								<div class="panel">
									
									<ul class="disc">
										<li>Fácil de utilizar</li>
										<li>Ayuda a la organización</li>
										<li>Gestión del tiempo </li>
									</ul>
									
								</div>
							</div>
							<div class="six columns">
								<div class="panel">
									<ul class="disc">
										<li>Interfaz limpia</li>
										<li>Mejora de la productividad</li>
										<li><a href="#" style="color: #555555;" data-reveal-id="free" data-animation="fadeAndPop" data-animationspeed="300" data-closeonbackgroundclick="true" data-dismissmodalclass="close-reveal-modal">¡Es gratis!</a></li>
									</ul>
								</div>
							</div>
						</div>
						</div>
						
					</div></center>
					
										
					<!-- an easter egg. funny -->
					<div id="free" class="reveal-modal">
				    	<h2>¡It's free!</h2>
				     	<img src="res/img/free.jpg" />
				     	<a class="close-reveal-modal">&#215;</a>
					</div>
					

				</div>
				<script>
					$(document).ready(function(){
    				$("#loginform").validationEngine();
   					});
				</script>

				<div class="four columns">			
					<h4>Login</h4>
					<form id="loginform" class="nice" name="login" action="process_login.php" method="post">
						<label>Email</label>
						<input id="username" class="oversize input-text validate[required,custom[email],maxSize[45]] text-input" type="text" name="email" placeholder="Introduce tu email" />
						<label>Contraseña</label>
						<input id="pass1" class="oversize input-text validate[required,min[8]]" type="password" name="pass1" placeholder="Introduce tu contraseña" />
						<input type="submit" class="nice medium radius white button" name="enviarf" value="Enviar" />
					</form>
					<br/><br/><br/><br/><br/><br/>
					<p>¿No estás registrado?</p>
					<p>No dudes más, regístrate y empieza a ahorrar tiempo y aumentar tu productividad.</p>
					<a href="register.php" class="nice large radius white button" name="registrar"/>Registrarse</a>
				</div>
			<script src="myjs/gtd.js"></script>	
		</div>
		
		
			<?php }
			 getFooter(); ?>
