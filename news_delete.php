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
	$id = $_GET['id'];
} 
else {
	Header ("Location: index.php");
}
if (!$truelogin) {
	header ('Location: index.php'); 
}
if ($language == 'en') { 
	$word = take_lang_eng();
	$row = take_read_more_eng($id);
}
if ($language == 'ua') {
	$word = take_lang_ukr();
	$row = take_read_more_ukr($id);
} 
if (!$row) {
	header ("Location: index.php");
}
if (isset($_POST['action'])) { 
	delete_news($id);
	header ("Location: index.php");	
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $word[41][0]; ?></title>
		<meta charset='UTF-8'>
		<link rel='stylesheet' href='style.css'>
	</head>
	<body> 
		<?php echo $word[1][0]; ?>:<?php echo $login; ?><br>
		<a link='#0000ff' href='index.php'><?php echo $word[16][0]; ?></a> 
		<a link='#0000ff' href='index.php?logout=1'><?php echo $word[0][0]; ?></a> 
		<div id='content'>
			<form method='post' action=''>
			  <input size ='50px' type='text' value='<?php echo $row['title']; ?>' name='title' placeholder='<?php echo $word[8][0]; ?>'>
				<textarea name='msg' rows='20'><?php echo $row['msg']; ?></textarea>
				<button type='submit' name='action'><?php echo $word[18][0]; ?></button>
			</form>
		</div>
	</body>
</html>

