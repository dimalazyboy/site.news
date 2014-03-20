<?php

/**
 * @file
 * File for adding news to base .
 */
	$id_news = $id;
	$id_user = $id_login;
	$author = $login;
	date_default_timezone_set('Europe/Kiev');
	$date = date(' h:i:s, j-m-Y');
	$msg_comm = clear_data($_POST['msg_comm']);
	$title_comm = clear_data($_POST['title_comm']);
	if (empty($_POST['title_comm'])) {
	$title_comm = mb_substr($msg_comm,0,15);	
	}
	add_comment_ukr($id_news, $id_user, $author, $date, $title_comm, $msg_comm);	
?>

