<?php
/**
 * @file
 * News delete page.
 */
require 'db.inc.php';
require 'lang.inc.php';
require 'logout.inc.php';
require 'func.inc.php';
if (isset($_SESSION['role'])) {
	$role = $_SESSION['role'];	
}
if ($role !== 'admin') {
	header ('Location: index.php'); 
} 
if (isset($_GET['id'])) {
	$id_comm = $_GET['id'];
}
else {
	header ("Location: index.php");
}
if ($language == 'en') {
	$word = take_lang_eng();
	$res = take_one_comment_eng($id_comm);
}
else {
	$word = take_lang_ukr();
	$res = take_one_comment_ukr($id_comm);
}
if (isset($_POST['action'])) { 
	if ($language == 'en') {
		delete_comment_eng($id_comm);	
		header ("Location: news_look.php?id=" . $res['id_news']);
	}
	else {
		delete_comment_ukr($id_comm);
		header ("Location: news_look.php?id=" . $res['id_news']);
	}	
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
			  <input size ='50px' type='text' value='<?php echo $res['title']; ?>' name='title' placeholder='<?php echo $word[8][0]; ?>'>
				<textarea name='msg' rows='20'><?php echo $res['msg']; ?></textarea>
				<button type='submit' name='action'><?php echo $word[18][0]; ?></button>
			</form>
		</div>
	</body>
</html>

