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

/*KNOWN BUG= YOU CAN SET MORE THAN ONE COUNTDOWN */
var running = 1;
var interval;
var counter = document.getElementById('countdown');
/* Pomodoro start function */
function pomodoroStart() {
var minutes = 25; //this is the standard
var seconds = 00;
    interval = setInterval(function() {
    	/* when both variables == 0, pomodoro's over
    	 * if not, subtract minutes and set seconds to 59 
    	 */
	    if(seconds == 0) {
    	    if(minutes == 0) {
        	    counter.innerHTML = "Pomodoro terminado!";                    
                clearInterval(interval);
                return;
            } else {
   	            minutes--;
                seconds = 59;
       		}
       }
	    /* add the complementary 0 if needed*/
    if(seconds < 10) {
    	seconds = '0'+seconds;
    }
    var second_text = seconds > 1 ? 'seconds' : 'second';
    countdown.innerHTML = minutes + ':' + seconds;
    seconds--;
    }, 1000);
	//}
/* Play sound when finished */	
    
	
	
}

/* Pomodoro stop function */
function pomodoroStop() {
	clearInterval(interval);
	running = 0;
	// haha nice trick
	countdown.innerHTML = "25:00"; 
}
