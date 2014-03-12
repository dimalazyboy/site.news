<?php
/**
 * @file
 * News delete page.
 */
require 'db.inc.php';
require 'lang.inc.php';
require 'logout.inc.php';
require 'func.inc.php';
if (isset($_GET['id'])) {
	$id=$_GET['id'];
} 
else {
	Header ("Location: index.php");
}
if (!$truelogin) {
	header ('Location: index.php'); 
}
if (isset($_POST['action'])) { 
	delete_news($id);	
} 
$row = take_read_more($id);
if (!$row) {
	Header ("Location: index.php");
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
			  <input size ='50px' type='text' value='<?php echo $row['title']; ?>' name='title' placeholder='<?php echo $lang['plc_title']?>'>
				<textarea name='msg'  rows='20'><?php echo $row['msg']; ?></textarea>
				<button type='submit' name='action'><?php echo $lang['btn_delete_news']; ?></button>
			</form>
		</div>
	</body>
</html>
