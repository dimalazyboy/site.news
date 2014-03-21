<?php

/**
 * @file
 * Login page.
 */


require 'lang.inc.php';
require 'func.inc.php';
require 'db.inc.php';
require 'logout.inc.php';

if (isset($_SESSION['role'])) {
	$role = $_SESSION['role'];	
}
if ($role !== 'admin') {
	header ('Location: index.php'); 
}
if ($language == 'en') {
	$word = take_lang_eng();
}
else {
	$word = take_lang_ukr();
}

$error = '';
if(isset($_POST['action'])) {
	if (empty($_POST['lgold'])) {
		$error .= $word[38][0] . '<br>';  	
	}
	if (empty($_POST['lgnew'])) {
		$error .= $word[39][0] . '<br>';
	}
	if (!$error) {
		$lgold = clear_data($_POST['lgold']);
		$lgnew = clear_data($_POST['lgnew']);
		if ($language == 'en') {
			update_lang_eng($lgold, $lgnew);
			header ('Location: lang_edit.php');
		}
		if ($language == 'ua') {
			update_lang_ukr($lgold, $lgnew);	
			header ('Location: lang_edit.php');
		}
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $word[27][0]; ?></title>
		<meta charset='UTF-8'>
		<link rel='stylesheet' href='style.css'>
	</head>
	<body>
		<span><?php echo ($word[1][0]); ?>:</span><a><?php echo $login; ?></a><br>
		<a href='index.php?logout=1'><?php echo $word[0][0]; ?></a><br>
		<a link='#0000ff'  href='index.php'><?php echo $word[16][0]; ?></a> 
		<div id='content'>
			<form method='post' action=''>
				<p class='error'>
					<?php
				 		if ($error) {
						echo $error; 
						}
					?>
				</p>
				<input type='text' name='lgold' placeholder='<?php echo $word[38][0]; ?>'>
				<input type='text' name='lgnew' placeholder='<?php echo $word[39][0]; ?>'>
				<button type='submit' name='action'><?php echo $word[18][0]; ?></button>
			</form>
		</div>
	</body>
</html>
