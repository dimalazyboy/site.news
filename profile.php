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
	$id=$_GET['id'];
}
$row = take_profile($id);
?>

<!DOCTYPE html>
<html>
	<head>
  	<title><?php echo $lang['title']; ?></title>
  	<meta charset='UTF-8'>
  	<link rel='stylesheet' href='style.css'>
	</head>
	<body>
		<a link='#0000ff'  href='index.php'><?php echo $lang['main']; ?></a> 
    <?php
			if ($truelogin) { 
		?>
  	<?php echo $lang['welcome']; ?>:<?php echo $login; ?><br>
  	<a link='#0000ff' href='index.php?logout'><?php echo $lang['logout']; ?></a><br>
  	<a link='#0000ff'  style='float:right' href='profile_edit.php?id=<?php echo $id; ?>'><?php echo $lang['edit_profile']; ?></a>
		<?php
	  }
	  ?>   		
		<div id='content'> 
	    <div class='news'>
	    	<p><?php echo $lang['avatar']; ?>:</p><img src='img/<?php echo $row['avatar']; ?>.jpg' width="150" height="150" >
	  		<p><?php echo $lang['plc_email']; ?>:<?php echo $row['email']; ?></p>
	  		<p><?php echo $lang['plc_surname']; ?>:<?php echo $row['surname']; ?></p>
				<p><?php echo $lang['plc_name']; ?>:<?php echo $row['name']; ?></p>
				<p><?php echo $lang['date_reg']; ?>:<?php echo $row['date_reg']; ?></p>
				<p><?php echo $lang['date_log']; ?>:<?php echo $row['date_log']; ?></p>
				<p><?php echo $lang['role']; ?>:<?php echo $row['role']; ?></p>
			</div>
		</div>
	</body>
</html>