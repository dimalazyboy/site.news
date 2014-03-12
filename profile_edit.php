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
$error = '';
if (isset($_POST['action'])) {
	if (empty($_POST['name'])) {
	  $error .= $lang['err_name'] . '<br>';
	} 
	if (empty($_POST['password'])) {
		$error .= $lang['err_pass'] . '<br>';
	}
	if (empty($_POST['retype_password'])) {
		$error .= $lang['err_2pass'] . '<br>';
	}
	if (empty($_POST['email'])) {
		$error .= $lang['err_email'] . '<br>';
	}
	if (!strpos($_POST['email'], '@')) {
		$error .= $lang['err_type_email'] . '<br>'; 
	}
	if ($_POST['password'] !== $_POST['retype_password']) {
		$error .= $lang['err_retype'] . '<br>';
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
		<title><?php echo $lang['add_news']; ?></title>
		<meta charset='UTF-8'>
		<link rel='stylesheet' href='style.css'>
	</head>
	<body> 
		<?php echo $lang['welcome']; ?>:<?php echo $login; ?><br>
		<a link='#0000ff'  href='index.php'><?php echo $lang['main']; ?></a> 
		<a link='#0000ff'  href='index.php?logout=1'><?php echo $lang['logout']; ?></a> 
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
			  <input size ='50px'  type='text' value='<?php echo stripslashes($row['name']); ?>' name='name' placeholder='<?php echo $lang['plc_name']; ?>'>
			  <input size ='50px'  type='text' value='<?php echo stripslashes($row['surname']); ?>' name='surname' placeholder='<?php echo $lang['plc_surname']; ?>'>
			  <input size ='50px'  type='text' value='<?php echo stripslashes($row['email']); ?>' name='email' placeholder='<?php echo $lang['plc_change_email']; ?>'>
			  <input size ='50px'  type='password' value='<?php echo stripslashes($row['password']); ?>' name='password' placeholder='<?php echo $lang['plc_change_password']; ?>'>
			  <input size ='50px'  type='password' value='<?php echo stripslashes($row['password']); ?>' name='retype_password' placeholder='<?php echo $lang['plc_2pass']; ?>'>
			  <input size ='50px'  type='hidden' name='role' value='<?php echo ($row['role']); ?>' visible = 'TRUE' placeholder='<?php echo $lang['edit_role']; ?>'>
		  	<?php
			  if ($role =='admin') {
				?> 
				<!-- <input size ='50px'  type='text' name='role' value='<?php echo ($row['role']); ?>' placeholder='<?php echo $lang['edit_role']; ?>'>  -->
				<select name='role' label='<?php echo $lang['edit_role']; ?>'>
				<option value='<?php echo ($row['role']); ?>'><?php echo ($row['role']); ?></option>
				<option value='user'>user</option>
				<option value='editor'>editor</option>
				<option value='ban'>ban</option>
				<option value='admin'>admin</option>	
				</select>
				<button type='submit' name='delete'><?php echo $lang['btn_delete_user']; ?></button>
			  <?php
			 	}
				?> 		
				<button type='submit' name='action'><?php echo $lang['btn_edit_profile']; ?></button>
			</form>
		</div>
	</body>
</html>
