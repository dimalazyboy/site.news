<?php

/**
 * @file
 * File for update news.
 */
date_default_timezone_set('Europe/Kiev');
$date = date(' h:i:s, j-m-Y');
$msg = clear_data($_POST['msg']);
$title = clear_data($_POST['title']);
update_news_ukr($title, $date, $msg, $id);	
?>