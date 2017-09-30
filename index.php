<html>
<head>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/todo.js"></script>
</head>

<body>
<div id="dialog" title="Create a New Task" style="display: none;">
	<form>
		<fieldset>
			<div class="label">Priority</div>
			<div class="field"><input type="text" name="priority" id="priority" class="text ui-widget-content ui-corner-all"></div>
			<div class="clear"/>
			<div class="label">Title</div>
			<div class="field"><input type="text" name="title" id="title" class="text ui-widget-content ui-corner-all"></div>
			<div class="clear"/>
			<div class="label">Description</div>
			<div class="field"><textarea name="description" id="description" rows="10" cols="30" class="text ui-widget-content ui-corner-all"></textarea></div>
			<div class="clear"/>
		</fieldset>
	</form>
</div>
<div class="center heading">Torchlight ToDo</div>
<div class="clear"/>
<div class="table">
	<div class="tableBody">
		<div class="tableRow">
			<div class="fixedTableCell tableHead">Priority</div>
			<div class="tableCell tableHead">Title</div>
			<div class="tableCell tableHead">Description</div>
			<div class="tableCell tableHead">Delete</div>
		</div>

<?php

include('database_connector.php');
$todo_results = mysql_query('SELECT priority, title, description FROM todo WHERE 1 ORDER BY priority ASC');
$num_todos = mysql_num_rows($todo_results);

for ($i = 0; $i < $num_todos; $i++) {
	$todo = mysql_fetch_assoc($todo_results);	
	$move_up_string = $i == 0 ? '' : '<button class="move_up" class="button" type="button" data-priority=' . $todo['priority'] . '>move up</button><br/>';
	$move_down_string = ($i == $num_todos - 1) ? '' : '<button class="move_down" class="button" type="button" data-priority=' . $todo['priority'] . '>move down</button>';

?>
		<div class="tableRow">
			<div class="fixedTableCell">
				<div class="label"><?php echo $todo['priority']; ?></div>
				<div class="field"><?php echo $move_up_string; ?> <?php echo $move_down_string; ?></div>
			</div>
			<div class="tableCell"><?php echo $todo['title']; ?></div>
			<div class="tableCell"><?php echo $todo['description']; ?></div>
			<div class="tableCell"><button class="delete_task" class="button" type="button" data-priority=<?php echo $todo['priority']; ?>>Delete</button></div>
		</div>
<?php
}

mysql_close($link);
?>

	</div>
</div>

<div class="clear"/>
<div class="center">
	<button id="create_task" class="button" type="button">Create Task</button>
</div>

</body>
</html>
