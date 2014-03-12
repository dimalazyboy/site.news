<?php

/**
 * @file
 * News edit page.
 */
require 'db.inc.php';
require 'lang.inc.php';
require 'logout.inc.php';
require 'func.inc.php';
if (isset($_GET['id'])) {
	$id=$_GET['id'];
	
} 
else {
	header ("Location: index.php");
}
if (!$truelogin) {
	header ('Location: index.php'); 
}
$error = ''; 
if (isset($_POST['action'])) { 
	if (empty($_POST['msg'])) {
	  $error .= $lang['err_msg'] . '<br>';
	}
	if(!$error) {
		require 'upd_news.inc.php';	
		header ("Location: news_look.php?id=$id"); 
	} 
}
$row = take_read_more($id);
if (!$row) {
  header ("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $lang['add_news']; ?></title>
		<meta charset='UTF-8'>
		<link rel='stylesheet' href='style.css'>
	</head>
	<body> 
		<?php echo $lang['welcome']; ?>:<?php echo $login; ?><br>
	<a link='#0000ff'  href='index.php'><?php echo $lang['main']; ?></a> 
	<a link='#0000ff'  href='index.php?logout=1'><?php echo $lang['logout']; ?></a> 
		<div id='content'>
			<form method='post' action=''>
				<p class='error'>
					<?php 
						if ($error) {
						echo $lang['err_msg'];
						}
			  	?>
			  </p>
			  <input size ='50px' type='text' value='<?php echo stripslashes($row['title']); ?>' name='title' placeholder='<?php echo $lang['plc_title']?>'>
				<textarea name='msg'  rows='20'><?php echo stripslashes($row['msg']); ?></textarea>
				<button type='submit' name='action'><?php echo $lang['btn_add_news']; ?></button>
			</form>
		</div>
	</body>
</html>
