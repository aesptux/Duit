$(document).ready(function(){
	/* The following code is executed once the DOM is loaded */
	/* jQuery magic! */
	$(".todoList").sortable({
		axis		: 'y',				// Only vertical movements allowed
		containment	: 'window',			// Constrained by the window. This may cause problems. If they arise, comment this line
		update		: function(){		// The function is called after the todos are rearranged
		
			// The toArray method returns an array with the ids of the todos
			var arr = $(".todoList").sortable('toArray');
			
			
			// Striping the todo- prefix of the ids:
			
			arr = $.map(arr,function(val,key){
				return val.replace('todo-','');
			});
			
			// Saving with AJAX
			//$.get('mylib/ajax.php',{action:'rearrange',positions:arr});
		},
		
		/* Opera fix: */
		
		stop: function(e,ui) {
			ui.item.css({'top':'0','left':'0'});
		}
	});
	
	// A global variable, holding a jQuery object 
	// containing the current todo item:
	
	var currentTODO;
	
	// When a double click occurs, just simulate a click on the edit button:
	$('.todo').live('dblclick',function(){
		$(this).find('a.edit').click();
	});
	
	// If any link in the todo is clicked, assign
	// the todo item to the currentTODO variable for later use.

	$('.todo a').live('click',function(e){
									   
		currentTODO = $(this).closest('.todo');
		currentTODO.data('id',currentTODO.attr('id').replace('todo-',''));
		
		e.preventDefault();
	});

	// Listening for a click on a delete button:

	$('.todo a.delete').live('click',function(){
		$.get("mylib/ajax.php",{"action":"delete","id":currentTODO.data('id')},function(msg){
					currentTODO.fadeOut('fast');
				})
	});
//  Listening for key press while editing tasks:

	$('.todo').live('keypress',function(event){
		
	if (event.keyCode == '13') 	//  Listening for a enter key press to save task:
		$(this).find('a.saveChanges').click();
	// Problems with Chrome?
	if (event.keyCode == '27') 	//  Listening for a ESC key press to cancel edit:
		$(this).find('a.discardChanges').click();
	});
	// Listening for blur event. Discard changes
	$('.todo').live('blur', function () {
		$(this).find('a.discardChanges').click();
	});
		
	// Listening for a click on a edit button
	
	$('.todo a.edit').live('click',function(){

		var container = currentTODO.find('.text');
		
		if(!currentTODO.data('origText'))
		{
			// Saving the current value of the ToDo so we can
			// restore it later if the user discards the changes:
			
			currentTODO.data('origText',container.text());
		}
		else
		{
			// This will block the edit button if the edit box is already open:
			return false;
		}
		
		$('<input type="text" id="editing">').val(container.text()).appendTo(container.empty());
		//when editing, select the text
		$('#editing').select();
		
		// Appending the save and cancel links:
		container.append(
			'<div class="editTodo">'+
				'<a class="saveChanges" href="#">Save</a> or <a class="discardChanges" href="#">Cancel</a>'+
			'</div>'
		);
		
	});

	// The cancel edit link:
	// Removes whatever is the 'new' content
	// Set origText as the value
	$('.todo a.discardChanges').live('click',function(){
		currentTODO.find('.text')
					.text(currentTODO.data('origText'))
					.end()
					.removeData('origText');
	});
	
	// The save changes link:
	
	$('.todo a.saveChanges').live('click',function(){
		var text = currentTODO.find("input[type=text]").val();
		
		$.get("mylib/ajax.php",{'action':'edit','id':currentTODO.data('id'),'text':text});
		
		currentTODO.removeData('origText')
					.find(".text")
					.text(text);
	});
	
	
	// Add task
	
	//var timestamp=0;
	$('#addButton').click(function(e){

		// Only one todo per second is allowed:
		//if((new Date()).getTime() - timestamp<1000) return false;
		
		$.get("mylib/ajax.php",{'action':'new','text':'Nueva tarea.','rand':Math.random()},function(msg){

			// Appending the new todo and fading it into view:
			$(msg).hide().appendTo('.todoList').fadeIn();
			
				//$(').find('a.edit').click();
			
		});
		
		// Updating the timestamp:
		//timestamp = (new Date()).getTime();
		
		e.preventDefault();
	});
	
}); // Closing $(document).ready()