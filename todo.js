$(document).ready(function(){
	var dialog, form;

	$('#create_task').click( function() {
		dialog.dialog( "open" );
	});

	$('.delete_task').click( function() {

		var data = { 
			'action': 'delete_task',
			'priority': $(this).attr('data-priority')
		};

                $.ajax({
                        url: '/todo_api.php',
                        type: 'POST',
                        data: data
                }).done(function(data) {
                        location.reload();
                }).fail(function() {
                	alert('Error: task not deleted!');
                });

		return false;
                                                                                
        });

        $('.move_up').click( function() {

                var data = {
                        'action': 'move_task',
                        'priority': $(this).attr('data-priority'),
			'move_direction': 'up'
                };

                $.ajax({
                        url: '/todo_api.php',
                        type: 'POST',
                        data: data
                }).done(function(data) {
                        location.reload();
                }).fail(function() {
                        alert('Error: task not deleted!');
                });

                return false;

        });


        $('.move_down').click( function() {

                var data = {
                        'action': 'move_task',
                        'priority': $(this).attr('data-priority'),
			'move_direction': 'down'
                };

                $.ajax({
                        url: '/todo_api.php',
                        type: 'POST',
                        data: data
                }).done(function(data) {
                        location.reload();
                }).fail(function() {
                        alert('Error: task not deleted!');
                });

                return false;

        });

	dialog = $( "#dialog" ).dialog({
		autoOpen: false,
		height: 450,
		width: 600,
		modal: true,
		buttons: {
			"Create Task": addTask,
			Cancel: function() {
				dialog.dialog( "close" );
			}
		},
		close: function() {
			form[ 0 ].reset();
		}
	});


	form = dialog.find( "form" ).on( "submit", function( event ) {
		event.preventDefault();
		addTask();
	});


	function addTask() {

		if ( isNaN($('#priority').val()) || $('#priority').val() < 1) {
			alert('Invalid Priority! Please enter an integer, 1 or larger.');
			return false;
		}

		if ( $('#title').val() === '') {
                        alert('Invalid Title! Please enter something.');
                        return false;
                }

		var data = {
			'action': 'create_task',
 			'priority': $('#priority').val(),
			'title': $('#title').val(),
			'description': $('#description').val(),
		};

		$.ajax({
			url: '/todo_api.php',
			type: 'POST',
			data: data
		}).done(function(data) {
			location.reload();
		}).fail(function() {
			alert('Error: new task not added!');
		});

		dialog.dialog( "close" );
	}

});
