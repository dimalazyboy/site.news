<?php
require 'lang.inc.php';
require 'db.inc.php'; 
require 'func.inc.php'; 
require 'logout.inc.php';
if ($language == 'en') {
	$word = take_lang_eng();
}
else {
	$word = take_lang_ukr();
}
if (isset($_GET['logout'])) { 
	unset ($_SESSION['login']); 
	header ('Location: index.php');  
}

if (isset($_SESSION['id'])) {
	$id = $_SESSION['id'];
}
if (isset($_SESSION['role'])) {
	$role = $_SESSION['role'];
}
if ($role !=='admin') {
		header ('Location: index.php');
}
$error = '';

$profile = take_all_profiles();
?>

<!DOCTYPE html>
<html>
	<head>
  	<title><?php echo $word[4][0]; ?></title>
  	<meta charset='UTF-8'>
  	<link rel='stylesheet' href='style.css'>
	</head>
	<body>
    <?php
			if ($role == 'admin') { 
		?>
	  	<span><?php echo $word[1][0]; ?>:</span><a link='#0000ff' href='profile.php?id=<?php echo $id; ?>'><?php echo $login; ?></a><br>
	  	<a link='#0000ff' href='index.php?logout'><?php echo $word[0][0]; ?></a><br> 
			<a link='#0000ff' style='float:right' href='profile.php?id=<?php echo $id; ?>'><?php echo $word[2][0]; ?></a>
			<a link='#0000ff' href='index.php'><?php echo $word[16][0]; ?></a>
		<?php
	    }
		?>

		<div id='content'> 
    	<?php 
    		foreach ($profile as $row) {
			?>
	    <div class='news'>
	    	<p><?php echo $word[31][0]; ?>:</p><img src='img/<?php echo $row['avatar']; ?>.jpg' width="150" height="150" />
	    	<?php 
				if ($role !== 'guest' ) {
				?>
	  		<p><?php echo $word[17][0]; ?>:<?php echo $row['email']; ?></p>
	  		<?php
	  		}
	  		?>
	  		<p><?php echo $word[32][0]; ?>:<?php echo $row['surname']; ?></p>
				<p><?php echo $word[33][0]; ?>:<?php echo $row['name']; ?></p>
				<p><?php echo $word[34][0]; ?>:<?php echo $row['date_reg']; ?></p>
				<p><?php echo $word[35][0]; ?>:<?php echo $row['date_log']; ?></p>
				<p><?php echo $word[36][0]; ?>:<?php echo $row['role']; ?></p>
				<a link='#0000ff' href='profile_edit.php?id=<?php echo $row['id']; ?>'><?php echo $word[37][0]; ?></a>
			</div>	
    		<?php
 					}	 	
   		  ?>
	  </div>
	</body>
</html>