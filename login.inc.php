<?php

/**
 * @file
 * File of check login and password.
 */
$login = clear_data($_POST['login']);
$password = clear_data($_POST['password']);
date_default_timezone_set('Europe/Kiev');
$date_log = date('Y-m-d H:i:s');
$res = check_user($login, $password);
if (is_array($res)) {
	extract($res);
	if (isset($id)) {
		update_date_log($id, $date_log);
		$_SESSION['login'] = $login;
		$_SESSION['id'] = $id;
		$_SESSION['role'] = $role;
		header ('Location: index.php');
	} 
}
else {
	$error = $lang['err_login'];
}
?>
