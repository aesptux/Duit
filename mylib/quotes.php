<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
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
/*get random greetings. Some greetings found on meneame.net source code */
function getRandomGreeting() {

	/* create two arrays, on with greetings, other with language */
	$greetingsarray = array();
	$greetingsarray[0] = 'bienvenid@';
	$greetingsarray[1] = 'hola';
	$greetingsarray[2] = 'gñap';
	$greetingsarray[3] = 'aiya';
	$greetingsarray[4] = 'hello';
	$greetingsarray[5] = 'hunga hunga';
	$greetingsarray[6] = 'salut';
	$greetingsarray[7] = 'hallo';
	$greetingsarray[8] = 'moin moin';
	$greetingsarray[9] = 'Dobrý deň';
	$greetingsarray[10] = 'helo';
	$greetingsarray[11] = 'minjhani';
	$greetingsarray[12] = 'ahn nyeong';
	$greetingsarray[13] = 'goedendag';
	$greetingsarray[14] = 'hyvää päivää';
	$greetingsarray[15] = 'hello world';
	$greetingsarray[16] = 'nuqneH';
	$greetingsarray[17] = 'Oel ngati kameie';
	$greetingsarray[18] = 'h3110';
	
	$languagearray = array();
	$languagearray[0] = 'españolo y española ;-)';
	$languagearray[1] = 'español';
	$languagearray[2] = 'gñapés';
	$languagearray[3] = 'quenya';
	$languagearray[4] = 'inglés';
	$languagearray[5] = 'troglodita';
	$languagearray[6] = 'francés';
	$languagearray[7] = 'alemán';
	$languagearray[8] = 'frisón';
	$languagearray[9] = 'eslovaco';
	$languagearray[10] = 'SMTP';
	$languagearray[11] = 'tsonga';
	$languagearray[12] = 'coreano';
	$languagearray[13] = 'neerlandés';
	$languagearray[14] = 'finés';
	$languagearray[15] = 'hola mundo';
	$languagearray[16] = 'klingon';
	$languagearray[17] = 'navi';
	$languagearray[18] = 'l33t';
	
	/*generate random number */
	$random = rand(0, count($greetingsarray)-1);
	//echo "$random";
	/* select random Greeting */

	/* now, as we must return two variables, we push them into an array */
	$greeting = $greetingsarray[$random];
	$language = $languagearray[$random];
	
	global $ql; 
	$ql = array();
 	array_push($ql,$greeting);
	array_push($ql,$language);
 	return $ql;
 }

function getRandomQuote() {

	/* create two arrays, on with quotes, other with authors */
	$quotesarray = array();
	$quotesarray[0] = 'El hombre nada puede aprender sino en virtud de lo que sabe.';
	$quotesarray[1] = 'Llegar juntos es el principio; mantenerse juntos es el progreso; trabajar juntos es el éxito.';
	$quotesarray[2] = 'Todo hombre, por naturaleza, desea saber.';
	$quotesarray[3] = 'Si no cambiamos de rumbo, es muy probable que lleguemos al destino original.';
	$quotesarray[4] = 'Cuando se encuentre en un agujero, deje de cavar.';
	$quotesarray[5] = 'No he fracasado. He encontrado 10 mil formas que no funcionan.';
	$quotesarray[6] = 'Ningún hombre puede subir más alto que las limitaciones que le imponen su propio carácter.';
	$quotesarray[7] = 'Haga del descanso una necesidad, no un objetivo.';
	$quotesarray[8] = 'La disciplina es la fuerza o la capacidad para obligarse a hacer lo ue tiene que hacer, cuando lo tiene que hacer, tanto si tiene ganas como si no.';
	$quotesarray[9] = 'El verdadero heroísmo consiste en persistir más de un momento cuando todo parece perdido';
	$quotesarray[10] = 'El hombre que ha movido montañas comenzó siempre soñando que movería piedrecillas';
	$quotesarray[11] = 'Si el tiempo es lo más caro, la pérdida de tiempo es el mayor de los derroches.';
	$quotesarray[12] = 'Si sigues los modelos clásicos, estas comprendiendo la rutina, la tradición, las sombras, pero no estás comprendiéndote a ti mismo.';
	$quotesarray[13] = 'Un hombre sabio puede aprender más de una pregunta absurda que un tonto puede aprender de una respuesta sabia.';
	$quotesarray[14] = 'Su tiempo es limitado, así que no lo malgasten viviendo la vida de otro.';
	$quotesarray[15] = 'Ser el más rico del cementerio no es lo que más me importa... Acostarme por la noche y pensar que he hecho algo genial. Eso es lo que más me importa.';
	$quotesarray[16] = 'La motivación es lo que te ayuda a empezar. El hábito te mantiene firme en tu camino.';
	
	$authorarray = array();
	$authorarray[0] = 'Aristóteles';
	$authorarray[1] = 'Henry Ford';
	$authorarray[2] = 'Aristóteles';
	$authorarray[3] = 'Proverbio chino';
	$authorarray[4] = 'Anónimo';
	$authorarray[5] = 'Thomas Edison';
	$authorarray[6] = 'John Morely';
	$authorarray[7] = 'Jim Rohn';
	$authorarray[8] = 'Elbert Hubbard';
	$authorarray[9] = 'Grenfel';
	$authorarray[10] = 'Mardel';
	$authorarray[11] = 'Benjamin Franklin';
	$authorarray[12] = 'Bruce Lee';
	$authorarray[13] = 'Bruce Lee';
	$authorarray[14] = 'Steve Jobs';
	$authorarray[15] = 'Steve Jobs';
	$authorarray[16] = 'Jim Ryun';
	
	/*generate random number */
	$random = rand(0, count($quotesarray)-1);
	
	/* now, as we must return two variables, we push them into an array */
	$quote = $quotesarray[$random];
	$author = $authorarray[$random];
	global $qa;
	$qa = array();
 	array_push($qa,$quote);
	array_push($qa,$author);
 	return $qa;
}

?>