<?php

/**
 * @file
 * File for registration new user.
 */

$login = clear_data($_POST['login']);
$password = clear_data($_POST['password']);
$email = clear_data($_POST['email']);
date_default_timezone_set('Europe/Kiev');
$date_reg = date('Y-m-d H:i:s');
if (check_user_reg($login, $email)) {
$error = $lang['err_login_email'];
} 
else {
add_user ($login, $password, $email, $date_reg);
require 'login.inc.php';
}	
?>