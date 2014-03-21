<?php

/**
 * @file
 * Profile page.
 */
require 'db.inc.php';
require 'lang.inc.php';
require 'func.inc.php';
require 'logout.inc.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
if (isset($_SESSION['id'])) {
	$id_login = $_SESSION['id'];
} 
if ($language == 'en') {
	$word = take_lang_eng();
}
else {
	$word = take_lang_ukr();
}
$row = take_profile($id);
?>

<!DOCTYPE html>
<html>
	<head>
  	<title><?php echo $word[2][0]; ?></title>
  	<meta charset='UTF-8'>
  	<link rel='stylesheet' href='style.css'>
	</head>
	<body>
    <?php
			if ($truelogin) { 
		?>
  	<span><?php echo $word[1][0]; ?>:</span><a><?php echo $login; ?></a><br>
  	<a link='#0000ff' href='index.php?logout'><?php echo $word[0][0]; ?></a><br>
  	<a link='#0000ff'  style='float:right' href='profile_edit.php?id=<?php echo $id; ?>'><?php echo $word[37][0]; ?></a>
		<?php
	  }
	  ?> 
	  <a link='#0000ff'  href='index.php'><?php echo $word[16][0]; ?></a><br>  		
		<div id='content'> 
	    	<p><?php echo $word[31][0]; ?>:</p><img src='img/<?php echo $row['avatar']; ?>.jpg' width="150" height="150" >
	  		<p><?php echo $word[17][0]; ?>:<?php echo $row['email']; ?></p>
	  		<p><?php echo $word[32][0]; ?>:<?php echo $row['surname']; ?></p>
				<p><?php echo $word[33][0]; ?>:<?php echo $row['name']; ?></p>
				<p><?php echo $word[34][0]; ?>:<?php echo $row['date_reg']; ?></p>
				<p><?php echo $word[35][0]; ?>:<?php echo $row['date_log']; ?></p>
				<p><?php echo $word[36][0]; ?>:<?php echo $row['role']; ?></p>
		</div>
	</body>
</html>