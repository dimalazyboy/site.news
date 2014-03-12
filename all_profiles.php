<?php
require 'lang.inc.php';
require 'db.inc.php'; 
require 'func.inc.php'; 
require 'logout.inc.php';

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
  	<title><?php echo $lang['title']; ?></title>
  	<meta charset='UTF-8'>
  	<link rel='stylesheet' href='style.css'>
	</head>
	<body>
		<a link='#0000ff'  href='index.php'><?php echo $lang['main']; ?></a><br>
    <?php
			if ($truelogin) { 
		?>
	  	<?php echo $lang['welcome']; ?>:<a link='#0000ff' href='profile.php?id=<?php echo $id; ?>'><?php echo $login; ?></a><br>
	  	<a link='#0000ff' href='index.php?logout'><?php echo $lang['logout']; ?></a> 
			<a link='#0000ff'  style='float:right' href='add_news.php'><?php echo $lang['add_news']; ?></a><br>
			<a link='#0000ff'  style='float:right' href='profile.php?id=<?php echo $id; ?>'><?php echo $lang['my_profile']; ?></a>
		<?php
	  }
			else {
		?>
			<div class='text1'>
    		<a  link='#0000ff'  href='registration.php'><?php echo $lang['reg']; ?></a>
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
						<input type='text' name='login' placeholder='<?php echo $lang['plc_login']; ?>'>
						<input type='password' name='password' placeholder='<?php echo $lang['plc_pass']; ?>'>
						<button type='submit' name='action'><?php echo $lang['btn_login']; ?></button>
					</form>
				</div>
		<?php
	    }
    ?>
		<div id='content'> 
    	<?php 
    		foreach ($profile as $row) {
			?>
	    <div class='news'>
	    	<p><?php echo $lang['avatar']; ?>:</p><img src='img/<?php echo $row['avatar']; ?>.jpg' width="150" height="150" />
	    	<?php 
				if ($role !== 'guest' ) {
				?>
	  		<p><?php echo $lang['plc_email']; ?>:<?php echo $row['email']; ?></p>
	  		<?php
	  		}
	  		?>
	  		<p><?php echo $lang['plc_surname']; ?>:<?php echo $row['surname']; ?></p>
				<p><?php echo $lang['plc_name']; ?>:<?php echo $row['name']; ?></p>
				<p><?php echo $lang['date_reg']; ?>:<?php echo $row['date_reg']; ?></p>
				<p><?php echo $lang['date_log']; ?>:<?php echo $row['date_log']; ?></p>
				<p><?php echo $lang['role']; ?>:<?php echo $row['role']; ?></p>
				<a  link='#0000ff'  href='profile_edit.php?id=<?php echo $row['id']; ?>'><?php echo $lang['edit_profile']; ?></a>
			</div>	
    		<?php
 					}	 	
   		  ?>
	  </div>
	</body>
</html>