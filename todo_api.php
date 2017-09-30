<?php
	include('database_connector.php');

	$action = $_POST['action'];

	$results = mysql_query("SELECT MAX(priority) as max_priority FROM todo WHERE 1");
	$row = mysql_fetch_assoc($results);
	$max_priority = $row['max_priority'];

	switch($action) {
		case 'create_task': 
			$priority = mysql_real_escape_string($_POST['priority']);
			$title = mysql_real_escape_string($_POST['title']);
			$description = mysql_real_escape_string($_POST['description']);

			//make sure a large priority gets set to the next highest number instead
			if ($priority > ($max_priority + 1)) {
				$priority = $max_priority + 1;
			}
	
			//increment all priorities that are larger than this one
			$sql = "UPDATE todo SET priority = priority + 1 WHERE priority >= " . $priority;
			mysql_query($sql);

			$sql = "INSERT INTO todo 
					(priority, title, description) 
					VALUES
					('" . $priority . "', '" . $title . "', '" . $description . "')";
			mysql_query($sql);
			break;
	
		case 'delete_task':
			$priority = mysql_real_escape_string($_POST['priority']);

			mysql_query("DELETE FROM todo WHERE priority = " . $priority);
	
			//decrement priorities that are larger than this one
                        $sql = "UPDATE todo SET priority = priority - 1 WHERE priority > " . $priority;
                        mysql_query($sql);

			break;

		case 'move_task':
		        $priority = mysql_real_escape_string($_POST['priority']);
		        $move_direction = mysql_real_escape_string($_POST['move_direction']);

			$results = mysql_query("SELECT id FROM todo WHERE priority = " . $priority);
			$row = mysql_fetch_assoc($results);
			$task_id = $row['id'];

			if ($move_direction == 'up') {
				mysql_query("UPDATE todo SET priority = priority + 1 WHERE priority = " . ($priority - 1) );
				mysql_query("UPDATE todo SET priority = priority - 1 WHERE id = " . $task_id );
			} else if ($move_direction == 'down') {
				mysql_query("UPDATE todo SET priority = priority - 1 WHERE priority = " . ($priority + 1) );
                                mysql_query("UPDATE todo SET priority = priority + 1 WHERE id = " . $task_id );
			}

			break;

		default:
			break;
	}

	mysql_close($link);

	header('Content-Type: application/json');
	echo json_encode(['success' => 'true']);
?>
