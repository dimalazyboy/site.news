<?php
/**
 * @file
 * Profile edit page.
 */
require 'db.inc.php';
require 'lang.inc.php';
require 'func.inc.php';
require 'logout.inc.php';
if (!$truelogin) {
	header ('Location: index.php'); 
}
if (isset($_GET['id'])) {
	$id=$_GET['id'];
}
else {
	header ('Location: index.php');
}
if (isset($_SESSION['role'])) {
	$role = $_SESSION['role'];
}
if ($language == 'en') {
	$word = take_lang_eng();
}
else {
	$word = take_lang_ukr();
}
$error = '';
if (isset($_POST['action'])) {
	if (empty($_POST['name'])) {
	  $error .= $word[45][0] . '<br>';
	} 
	if (empty($_POST['password'])) {
		$error .= $word[20][0] . '<br>';
	}
	if (empty($_POST['retype_password'])) {
		$error .= $word[15][0] . '<br>';
	}
	if (empty($_POST['email'])) {
		$error .= $word[46][0] . '<br>';
	}
	if (!strpos($_POST['email'], '@')) {
		$error .= $word[47][0] . '<br>'; 
	}
	if ($_POST['password'] !== $_POST['retype_password']) {
		$error .= $word[48][0] . '<br>';
	}
	if(!$error) {
		require 'upd_user.inc.php';
		header ("Location: profile.php?id=$id"); 
	} 
}
if (isset($_POST['delete'])) { 
	delete_user($id);	
}
$row = take_profile($id);
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $word[37][0]; ?></title>
		<meta charset='UTF-8'>
		<link rel='stylesheet' href='style.css'>
	</head>
	<body> 
		<span><?php echo $word[1][0]; ?>:</span><a><?php echo $login; ?></a><br>
		<a link='#0000ff'  href='index.php'><?php echo $word[16][0]; ?></a><br>
		<a link='#0000ff'  href='index.php?logout=1'><?php echo $word[0][0]; ?></a> 
		<div id='content'>
			<form method='post' action='' enctype="multipart/form-data">
				<p class='error'>
					<?php 
						if ($error) {
						echo $error ;
						}
			  	?>
			  </p>
			  <input  type="file" value='<?php echo stripslashes($row['avatar']); ?>' name="load" size="50" >
			  <input size ='50px'  type='text' value='<?php echo stripslashes($row['name']); ?>' name='name' placeholder='<?php echo $word[33][0]; ?>'>
			  <input size ='50px'  type='text' value='<?php echo stripslashes($row['surname']); ?>' name='surname' placeholder='<?php echo $word[32][0]; ?>'>
			  <input size ='50px'  type='text' value='<?php echo stripslashes($row['email']); ?>' name='email' placeholder='<?php echo $word[17][0]; ?>'>
			  <input size ='50px'  type='password' value='<?php echo stripslashes($row['password']); ?>' name='password' placeholder='<?php echo $word[14][0]; ?>'>
			  <input size ='50px'  type='password' value='<?php echo stripslashes($row['password']); ?>' name='retype_password' placeholder='<?php echo $word[15][0]; ?>'>
			  <input size ='50px'  type='hidden' name='role' value='<?php echo ($row['role']); ?>' visible = 'TRUE' placeholder='<?php echo $word[36][0]; ?>'>
		  	<?php
			  if ($role =='admin') {
				?> 
				<select name='role' label='<?php echo $word[36][0]; ?>'>
				<option value='<?php echo ($row['role']); ?>'><?php echo ($row['role']); ?></option>
				<option value='user'>user</option>
				<option value='editor'>editor</option>
				<option value='ban'>ban</option>
				<option value='admin'>admin</option>	
				</select>
				<button type='submit' name='delete'><?php echo $word[49][0]; ?></button>
			  <?php
			 	}
				?> 		
				<button type='submit' name='action'><?php echo $word[37][0]; ?></button>
			</form>
		</div>
	</body>
</html>
