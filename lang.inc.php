<?php

/**
 * @file
 * File multilingual of site.
 */
$language = 'en';
session_start();
if (isset($_GET['lang'])) {
	$_SESSION['language'] = $_GET['lang'];
}	
if(isset($_SESSION['language'])) {
	$language=$_SESSION['language'];
}
switch ($language) {
	case 'ru' : include('ru.php'); break;
	case 'ua' : include('ua.php'); break;
	default : include('en.php'); break;
} 
?>
