<?php

/**
 * @file
 * Add news page.
 */


require 'db.inc.php';
require 'func.inc.php';
require 'lang.inc.php';
require 'logout.inc.php';


if (isset($_SESSION['role'])) {
	$role = $_SESSION['role'];	
}
if ($role !== 'admin') {
	header ('Location: index.php'); 
}
if (isset($_SESSION['id'])) {
	$id = $_SESSION['id'];
}
if ($language == 'en') {
	$word = take_lang_eng();
}
else {
	$word = take_lang_ukr();
}
$error = ''; 
if (isset($_POST['action'])) { 
	if (empty($_POST['lang_ukr'])) {
	 $error .= $word[28][0] . '<br>';
	} 	
	if (empty($_POST['lang_eng'])) {
	 $error .= $word[29][0] . '<br>';
	}  	
	if (!$error) {
		require 'add_lang.inc.php';	
	} 
}	
?>
	
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo ($word[12][0]); ?></title>
		<meta charset='UTF-8'>
		<link rel='stylesheet' href='style.css'>
	</head>
	<body> 
		<span><?php echo ($word[1][0]); ?>:</span><a><?php echo $login; ?></a><br>
		<a href='index.php?logout=1'><?php echo $word[0][0]; ?></a><br> 
		<a href='index.php'><?php echo $word[16][0]; ?></a>
		<div id='content'>
			<form method='post' action=''>
				<p><?php echo $word[28][0];?></p>
				<p class='error'>
					<?php 
						if ($error) {
						echo $error;
						}
			 	?>
			  </p>
			 <input size = '50px' type = 'text' name = 'lang_ukr' >
				<p><?php echo $word[29][0];?></p>
			 <input size = '50px' type = 'text' name = 'lang_eng' >
				<button type = 'submit' name = 'action'><?php echo $word[18][0]; ?></button>
			</form>
		</div>
	</body>
</html>
