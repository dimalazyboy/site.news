<?php

/**
 * @file
 * File for adding news to base .
 */

	require 'db.inc.php';
	require 'func.inc.php';
	$author = $login;
	date_default_timezone_set('Europe/Kiev');
	$date = date(' h:i:s, j-m-Y');
	$msg = clear_data($_POST['msg']);
	$title = clear_data($_POST['title']);
	add_news($title, $author, $date, $msg);	
?>
