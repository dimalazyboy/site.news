<?php

/**
 * @file
 * Add news page.
 */
	require 'db.inc.php';
	require 'func.inc.php';
	require 'lang.inc.php';
	require 'logout.inc.php';
  if (!$truelogin) {
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
		if (empty($_POST['title_ukr'])) $error .= $word[23][0] . '<br>';  	
		if (empty($_POST['msg_ukr'])) $error .= $word[24][0] . '<br>';
		if (empty($_POST['title_eng'])) $error .= $word[25][0] . '<br>';  	
		if (empty($_POST['msg_eng'])) $error .= $word[26][0] . '<br>';
		if(!$error) {
		require 'add.inc.php';	
		} 
	}
?>
	
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $word[3][0]; ?></title>
		<meta charset='UTF-8'>
		<link rel='stylesheet' href='style.css'>
	</head>
	<body> 
		<span><?php echo $word[1][0]; ?>:</span><a><?php echo $login; ?></a><br>
		<a link='#0000ff' href='index.php?logout=1'><?php echo $word[0][0]; ?></a><br> 
		<a link='#0000ff' href='index.php'><?php echo $word[16][0] ?></a><br> 
		<div id='content'>
			<form method='post' action=''>
				<p><?php echo $word[23][0];?></p>
				<p class='error'>
					<?php 
						if ($error) {
						echo $error;
						}
			  	?>
			  </p>
			  <input style='padding:2px' size = '60px' type = 'text' name = 'title_ukr' placeholder = '<?php echo $word[8][0];?>'>
				<textarea name = 'msg_ukr' rows = '20'></textarea>
				<p><?php echo $word[24][0];?></p>
			  <input style='padding:2px' size = '60px' type = 'text' name = 'title_eng' placeholder = '<?php echo $word[8][0];?>'>
				<textarea name = 'msg_eng' rows = '20'></textarea>
				<button type = 'submit' name = 'action'><?php echo $word[62][0]; ?></button>
			</form>
		</div>
	</body>
</html>
