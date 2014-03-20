<?php

/**
 * @file
 * Registration page.
 */
require 'db.inc.php';
require 'func.inc.php';
require 'lang.inc.php';
if ($language == 'en') {
	$word = take_lang_eng();
}
else {
	$word = take_lang_ukr();
}
$error = '';
if (isset($_POST['action'])) {
	if (empty($_POST['login'])) {
	  $error .= $word[19][0] . '<br>';
	} 
	if (empty($_POST['password'])) {
		$error .= $word[20][0] . '<br>';
	}
	if (empty($_POST['retype_password'])) {
		$error .= $word[20][0] . '<br>';
	}
	if (empty($_POST['email'])) {
		$error .= $word[46][0] . '<br>';
	}
	if (!strpos($_POST['email'], '@')) {
		$error .= $word[47][0] . '<br>'; 
	}
	if ($_POST['password'] !== $_POST['retype_password']) {
		$error .= $word[48][0] . '<br>';
	}
	if (!$error){ 
	require 'reg.inc.php';
	}
}
if ($language == 'en') {
$word = take_lang_eng();
}
else {
$word = take_lang_ukr();
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo ($word[5][0]); ?></title>
		<meta charset='UTF-8'>
		<link rel='stylesheet' href='style.css'>
	</head>
	<body>
		<a link='#0000ff'  href='index.php'><?php echo ($word[16][0]); ?></a> 
		<div id='content'>
			<form method='post' action=''>
				<p class='error'>
					<?php 
					if ($error) {
						echo $error; 
					}
					?>
				</p>
				<input type='text' name='login' placeholder='<?php echo ($word[13][0]); ?>'>
				<input type='password' name='password' placeholder='<?php echo ($word[14][0]); ?>'>
				<input type='password' name='retype_password' placeholder='<?php echo ($word[15][0]); ?>'>
				<input type='text' name='email' placeholder='<?php echo ($word[17][0]); ?>'>
				<button type='submit' name='action'><?php echo ($word[18][0]); ?></button>
			</form>
		</div>
	</body>
</html>
