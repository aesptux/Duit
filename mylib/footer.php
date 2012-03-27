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
    function getFooter() {
    	
?>
<div class="row footer">
				<div id="acerca" class="reveal-modal">
			    	<h2>Acerca de</h2>
			     	<p class="subtitlecontent">Más información sobre Duit</p>
			     	<p>Duit es un sitio web destinado a servir como GTD.
			     		Actualmente, se encuentra en fase beta.</p>
			     	<p>Nació como un proyecto de 2º de Ciclo Formativo de Grado Superior de
			     		Administración de Sistemas Informáticos en Red.</p>
			     	<p>Si deseas realizar alguna donación, puedes hacerlo desde aquí.</p>
			     	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_donations">
						<input type="hidden" name="business" value="mortuuslordofdeads@gmail.com">
						<input type="hidden" name="lc" value="ES">
						<input type="hidden" name="item_name" value="Duit">
						<input type="hidden" name="no_note" value="0">
						<input type="hidden" name="currency_code" value="EUR">
						<input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_SM.gif:NonHostedGuest">
						<input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
						<img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
					</form>

			     	<a class="close-reveal-modal">&#215;</a>
				</div>	
				
				<div id="contacto" class="reveal-modal">
			    	<h2>Contacto</h2>
			     	<p>Para contactar con el desarrollador:</p>
			     	<a class="close-reveal-modal">&#215;</a>
				</div>	
				 <a href="faq.php" class="spaces">FAQ</a>
				 <a href="#" class="spaces" data-reveal-id="acerca" data-animation="fadeAndPop" data-animationspeed="300" data-closeonbackgroundclick="true" data-dismissmodalclass="close-reveal-modal">Acerca de</a>
				 <a href="#" class="spaces" data-reveal-id="contacto" data-animation="fadeAndPop" data-animationspeed="300" data-closeonbackgroundclick="true" data-dismissmodalclass="close-reveal-modal">Contacto</a>
			</div>
					
					
		


	
</body>
</html>
<?php
}

?>