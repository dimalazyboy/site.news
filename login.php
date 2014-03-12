<?php

/**
 * @file
 * Login page.
 */
require 'lang.inc.php';
$error = '';
if(isset($_POST['action'])) {
	if (empty($_POST['login'])) {
 		$error .= $lang['err_login'] . '<br>';
  } 		
	if (empty($_POST['password'])) {
	  $error .= $lang['err_pass'] . '<br>';
  }
	if (!$error) {
	require 'login.inc.php';
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?=$lang['login']?></title>
		<meta charset='UTF-8'>
		<link rel='stylesheet' href='style.css'>
	</head>
	<body>
		<a link='#0000ff'  href='index.php'><?=$lang['main']?></a> 
		<div id='content'>
			<form method='post' action=''>
				<p class='error'>
					<?php
				 		if ($error) {
						echo $error; 
						}
					?>
				</p>
				<input type='text' name='login' placeholder='<?=$lang['plc_login']?>'>
				<input type='password' name='password' placeholder='<?=$lang['plc_pass']?>'>
				<button type='submit' name='action'><?=$lang['btn_login']?></button>
			</form>
		</div>
	</body>
</html>