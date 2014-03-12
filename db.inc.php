<?php

/**
 * @file
 * File connecting to base .
 */
	define('DB_LOGIN', 'root');
	define('DB_PASSWORD', 'root');
	// define('DB_PASSWORD', 'vertrigo');
	 $db = new PDO( 'mysql:host=localhost;dbname=site_news',DB_LOGIN,DB_PASSWORD );
	 $db->exec("SET CHARACTER SET 'utf8'");
	 $db->exec("SET NAMES 'utf8'");
?>
