<?php

/**
 * @file
 * News look page.
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
if (isset($_SESSION['id'])) {
	$id_login=$_SESSION['id'];
} 
$error = '';
if(isset($_POST['action'])) {
	if (empty($_POST['login'])) {
		$error .= $lang['err_login'] . '<br>';
	}
	if (empty($_POST['password'])) {
		$error .= $lang['err_pass'] . '<br>';
	}
	if (!$error) {
		require 'login.inc.php';
}	
}
if (isset($_SESSION['role'])) {
	$role = $_SESSION['role'];	
} 
if (isset($_GET['logout'])) { 
	unset ($_SESSION['login']); 
	header ('Location: index.php');  
} 
$row = take_read_more($id);
if (!$row) {
	Header ("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
  	<title><?php echo $lang['title']; ?></title>
  	<meta charset='UTF-8'>
  	<link rel='stylesheet' href='style.css'>
	</head>
	<body>
    <?php
		if ($truelogin) { 
			if ($role =='user') {
		?>
	  		<?php echo $lang['welcome']; ?>:<a link='#0000ff' href='profile.php?id=<?php echo $id; ?>'><?php echo $login; ?></a><br>
	  		<a link='#0000ff' href='index.php?logout'><?php echo $lang['logout']; ?></a><br> 
	  		<a link='#0000ff'  href='index.php'><?php echo $lang['main']; ?></a> 
				<a link='#0000ff'  style='float:right' href='profile.php?id=<?php echo $id; ?>'><?php echo $lang['my_profile']; ?></a><br>
		<?php
	  		}
	  	if ($role =='editor'){
	  ?> 	
	    <?php echo $lang['welcome']; ?>:<a link='#0000ff' href='profile.php?id=<?php echo $id_login; ?>'><?php echo $login; ?></a><br>
  		<a link='#0000ff' href='index.php?logout'><?php echo $lang['logout']; ?></a><br>
  		<a link='#0000ff'  href='index.php'><?php echo $lang['main']; ?></a> 
  	<?php 	
  			if ($login == $row['author']) {
  	?>		
  				<a link='#0000ff'  style='float:right' href='news_edit.php?id=<?php echo $id; ?>'><?php echo $lang['news_edit']; ?></a><br>
					<a link='#0000ff'  style='float:right' href='news_delete.php?id=<?php echo $id; ?>'><?php echo $lang['news_delete']; ?></a>
		<?php
  			}
  		}
			if ($role =='admin'){
	  ?> 	
  		<?php echo $lang['welcome']; ?>:<a link='#0000ff' href='profile.php?id=<?php echo $id_login; ?>'><?php echo $login; ?></a><br>
  		<a link='#0000ff' href='index.php?logout'><?php echo $lang['logout']; ?></a><br>
  		<a link='#0000ff'  href='index.php'><?php echo $lang['main']; ?></a> 
			<a link='#0000ff'  style='float:right' href='news_edit.php?id=<?php echo $id; ?>'><?php echo $lang['news_edit']; ?></a><br>
			<a link='#0000ff'  style='float:right' href='news_delete.php?id=<?php echo $id; ?>'><?php echo $lang['news_delete']; ?></a>
		<?php
	  	}
		}
			else {
		?>
			<div class='text1'>
    		<a  link='#0000ff'  href='registration.php'><?php echo $lang['reg']; ?></a><br>
    		<a link='#0000ff'  href='index.php'><?php echo $lang['main']; ?></a> 
    	</div>	
    	<div class='login'>
					<form method='post' action=''>
						<p class='error'>
							<?php
						 		if ($error) {
								echo $error; 
							}
							?>
						</p>
						<input type='text' name='login' placeholder='<?php echo $lang['plc_login']?>'>
						<input type='password' name='password' placeholder='<?php echo $lang['plc_pass']?>'>
						<button type='submit' name='action'><?php echo $lang['btn_login']?></button>
					</form>
				</div>
		<?php
	    }
    ?>
		<div id='content'> 
	    <div class='news'>
	  		<p class='author'>Автор:<?php echo $row['author']; ?></p>
	  		<p class='date'>Дата:<?php echo $row['date']; ?></p>
	  		<h3>Заголовок:<?php echo $row['title']; ?></h3>
				<p class='msg'><?php echo $row['msg']; ?></p>
			</div>
		</div>
	</body>
</html>
