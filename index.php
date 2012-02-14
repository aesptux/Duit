<?php
include 'mylib/footer.php';
include 'mylib/header.php';
include 'mylib/quotes.php';
/*in order to use both values, we use list() */
//list ($gr, $language) = getRandomGreeting();
//list ($qu, $author) = getRandomQuote();
/* well, it seems that my php doesn't like list(), I can't get it working, don't know where is the error.
 * So I've decided to make a global variable.
 */
getHeader("Duit");
getRandomGreeting();
getRandomQuote();


?>
	<script>

</script>

	<!-- container -->
	<div class="container">
		
		<?php  if(isset($_SESSION['email'])){ ?>
			<!-- first part. user logged in -->
		<div class="row">
			<div class="three columns">
			<a href="logout.php">Salir</a>
			<!-- greetings part. get a random greeting. Function call is on top-->
			<h5>¡<?php echo "<span title='Duit te saluda en $ql[1]'> $ql[0] "; echo $_SESSION['user']; ?> !</h5>				
				<h4>Getting Started</h4>
				<p>We're stoked you want to try Foundation! To get going, this file (index.html) includes some basic styles you can modify, play around with, or totally destroy to get going.</p>

				<h4>Other Resources</h4>
				<p>Once you've exhausted the fun in this document, you should check out:</p>
				<ul class="disc">
					<li><a href="http://foundation.zurb.com/docs">Foundation Documentation</a><br />Everything you need to know about using the framework.</li>
					<li><a href="http://github.com/zurb/foundation">Foundation on Github</a><br />Latest code, issue reports, feature requests and more.</li>
					<li><a href="http://twitter.com/foundationzurb">@foundationzurb</a><br />Ping us on Twitter if you have questions. If you build something with this we'd love to see it (and send you a totally boss sticker).</li>
				</ul>
			</div>
			<div class="nine columns">
				<div class="alert-box [success]">
					<!-- Show random quote. Cool stuff -->
					<h4><?php echo $qa[0];   ?></h4>
					<p><b><?php echo $qa[1];   ?></b></p>
					<a href="" class="close">&times;</a>
				</div>


				<p>(quizas tener en cuenta su última visita para decirle que no es productivo)</p>
				<div class="row">
					<div class="twelve columns">
						<dl class="nice tabs">
							<dd><a href="#simple1" class="active">Tareas</a></dd>
							<dd><a href="#simple2">Pomodoro</a></dd>
						</dl>

						<ul class="tabs-content">
							<li class="active" id="simple1Tab">
								<div class="panel">
									<p>Tarea 1. Reducir panel</p>
								</div>
								<div class="panel">
									<p>Tarea 2. Que bonito</p>
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
					
					
					
					<!--<h3>Buttons</h3>
	
					<p><a href="#" class="small white button">Small Blue Button</a></p>
					<p><a href="#" class="blue button">Medium Blue Button</a></p>
					<p><a href="#" class="large blue button">Large Blue Button</a></p>
	
					<p><a href="#" class="nice radius small blue button">Nice Blue Button</a></p>
					<p><a href="#" class="nice radius blue button">Nice Blue Button</a></p>
					<p><a href="#" class="nice radius large blue button">Nice Blue Button</a></p>
					-->
					
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
				
		</div>
		
		
			<?php }
			 getFooter(); ?>
