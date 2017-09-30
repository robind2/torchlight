<?php

$link = mysql_connect('localhost', 'torchlight', 'torchlightdbpass_659384');
if (!$link) {
    die('Could not connect to the DB: ' . mysql_error());
}

$db_selected = mysql_select_db('torchlight', $link);
if (!$db_selected) {
    die ("Can't use todo database: " . mysql_error());
}

?>
