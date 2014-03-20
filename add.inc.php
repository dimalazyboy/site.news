<?php

/**
 * @file
 * File for adding news to base .
 */

	$title_ukr = clear_data($_POST['title_ukr']);
	$title_eng = clear_data($_POST['title_eng']);
	$author = $login;
	$id_author = $id;
	date_default_timezone_set('Europe/Kiev');
	$date = date(' h:i:s, j-m-Y');
	$msg_ukr = clear_data($_POST['msg_ukr']);
	$msg_eng = clear_data($_POST['msg_eng']);
	add_news($title_ukr, $title_eng, $author, $id_author, $date, $msg_ukr, $msg_eng);	
?>
