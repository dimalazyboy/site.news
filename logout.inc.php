<?php

/**
 * @file
 * File for entry login into the session.
 */
$truelogin = FALSE; 
if (isset($_SESSION['login'])) { 
	$login = $_SESSION['login']; 
	$truelogin = TRUE; 
} 
?>