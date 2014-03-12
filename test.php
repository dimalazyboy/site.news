<?php

	define('DB_LOGIN', 'root');
	define('DB_PASSWORD', 'root');
	// define('DB_PASSWORD', 'vertrigo');
	 $db = new PDO( 'mysql:host=localhost;dbname=site_news',DB_LOGIN,DB_PASSWORD );
	 $db->exec("SET CHARACTER SET 'utf8'");
	 $db->exec("SET NAMES 'utf8'");

if(isset($_POST['action'])){
$login = $_POST['login'];
$password = $_POST['password'];
}

function check_user_ban($login, $password) {
	global $db;
	$login = $db->quote($login);
	$password = $db->quote($password);	
  $result = $db->query("SELECT role FROM users WHERE login = $login AND password = $password");
	$res = $result->fetch(PDO::FETCH_ASSOC);
	  if ($res) {
  	return $res;
  	}
  }	




$re = check_user_ban($login, $password);

print_r ($login);
print_r ($password);
print_r ($re) ;
?>
					<form method='post' action=''>
						<input type='text' name='login' placeholder='login'>
						<input type='password' name='password' placeholder='password'>
						<button type='submit' name='action'>ok</button>
					</form>




