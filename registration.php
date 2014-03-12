<?php

/**
 * @file
 * Registration page.
 */
require 'db.inc.php';
require 'func.inc.php';
require 'lang.inc.php';
$error = '';
if (isset($_POST['action'])) {
	if (empty($_POST['login'])) {
	  $error .= $lang['err_login'] . '<br>';
	} 
	if (empty($_POST['password'])) {
		$error .= $lang['err_pass'] . '<br>';
	}
	if (empty($_POST['retype_password'])) {
		$error .= $lang['err_2pass'] . '<br>';
	}
	if (empty($_POST['email'])) {
		$error .= $lang['err_email'] . '<br>';
	}
	if (!strpos($_POST['email'], '@')) {
		$error .= $lang['err_type_email'] . '<br>'; 
	}
	if ($_POST['password'] !== $_POST['retype_password']) {
		$error .= $lang['err_retype'] . '<br>';
	}
	if (!$error){ 
	require 'reg.inc.php';
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $lang['reg']; ?></title>
		<meta charset='UTF-8'>
		<link rel='stylesheet' href='style.css'>
	</head>
	<body>
		<a link='#0000ff'  href='index.php'><?php echo $lang['main']; ?></a> 
		<div id='content'>
			<form method='post' action=''>
				<p class='error'>
					<?php 
					if ($error) {
						echo $error; 
					}
					?>
				</p>
				<input type='text' name='login' placeholder='<?php echo $lang['plc_login']; ?>'>
				<input type='password' name='password' placeholder='<?php echo $lang['plc_pass']; ?>'>
				<input type='password' name='retype_password' placeholder='<?php echo $lang['plc_2pass']; ?>'>
				<input type='text' name='email' placeholder='<?php echo $lang['plc_email']; ?>'>
				<button type='submit' name='action'><?php echo $lang['btn_confirm']; ?></button>
			</form>
		</div>
	</body>
</html>
