<?php

/**
 * @file
 * The file containing the description of all functions.
 */

/**
 * The function of clearing the data of superfluous.
 *
 * @param string $data
 * 	In the variable $data comes information entered by the user in the form.
 *
 * @return string $data
 *  In the variable $data returned are formatted information.
 */
function clear_data($data) {
	return strip_tags(addslashes(trim((string)$data, "'., ")));
}

/**
 * The function of adding a new user.
 *
 * @param string $login
 *	In the variable $login the user specifies his login.
 *  
 * @param string $password
 *  In the variable $password the user specifies his password.
 *
 * @param string $email
 *  In the variable $email the user specifies his email.
 */
function add_user($login, $password, $email, $date_reg) {
	global $db;
	$login = $db->quote($login);
	$password = $db->quote($password);
	$email = $db->quote($email);
	$date_reg = $db->quote($date_reg);
	$sql = "INSERT INTO users (login, password,	email, date_reg, role, avatar) VALUES ($login, $password,	$email, $date_reg, 'user', '00')";
	$db->exec($sql);
}

/**
 * Function of check username and password.
 *
 * @param string $password
 *  In the variable $password the user specifies his password.
 *
 * @param string $login
 *	In the variable $login the user specifies his login. 	
 */
function check_user($login, $password) {
	global $db;
	$login = $db->quote($login);
	$password = $db->quote($password);
  $result = $db->query("SELECT id, role FROM users WHERE login = $login AND password = $password ");
	$res = $result->fetch(PDO::FETCH_ASSOC);
  return $res;
}

/**
 * Function add news to a database.
 *
 * @param string $title
 *	In the variable $title comes news title.
 *  
 * @param string $author
 *  In the variable $author comes news author.
 *
 * @param string $date
 *  In the variable $date comes the date of news creating.
 *
 * @param string $msg
 *  In the variable $msg comes the msg which user specifies.
 */
function add_news($title, $author, $date,  $msg) {
	global $db;
	$title = $db->quote($title);
	$author = $db->quote($author);
	$date = $db->quote($date);
	$msg = $db->quote($msg);
	$sql = "INSERT INTO news (title, author, date, msg) VALUES ($title, $author, $date, $msg)";
	$db->exec($sql);
	header ("Location: news_look.php");
}

/**
 * Function which leads to the news of the appearance on the news look.
 */
function take_news($start, $per_page) {
  global $db;
  $result = $db->query("SELECT id, title, author, date, msg FROM news ORDER BY id DESC LIMIT $start, $per_page") or die("asda");
  $res = $result->fetchAll(PDO::FETCH_ASSOC);
  return $res;
}

/**
 * Function which leads to the news of the appearance on the homepage.
 */
function cutString($string, $maxlen) {
	if (mb_strlen($string) > $maxlen) {
	$len = mb_strripos(mb_substr($string, 0, $maxlen), ' ');
	}
	else {
	$len = $maxlen;
	}
	$cutStr = mb_substr($string, 0, $len);
	if (mb_strlen($string) > $maxlen) {
	return '"' . $cutStr . '..."';
	} 
	else {
	return '"' . $cutStr . '"';
	}
}

/**
 * Function which leads to the news of the appearance on the page news reader.
 * 	
 * @param string $id
 *  In the variable $id comes news id.  
 */
function take_read_more($id) {
	global $db;
	$id = $db->quote($id);
	$result = $db->query("SELECT title, author, date,  msg FROM news WHERE id = $id ");
	$row = $result->fetch(PDO::FETCH_ASSOC);
	return $row;
}

/**
 * Function update news.
 *
 * @param string $title
 *	In the variable $title comes news title.
 * 
 * @param string $date
 *  In the variable $date comes the date of news creating.
 *
 * @param string $msg
 *  In the variable $msg comes the msg which user specifies.
 *
 * @param string $id
 *  In the variable $id comes news id. 
 */
function update_news( $title, $date,  $msg, $id) {
	global $db;
	$title = $db->quote($title);
	$date = $db->quote($date);
	$msg = $db->quote($msg);
	$id = $db->quote($id);
	$sql = "UPDATE news SET title = $title, date = $date, msg = $msg WHERE id = $id";
	$db->exec($sql);
}

/**
 * Function delete news.
 *
 * @param string $id
 *  In the variable $id comes news id. 
 */
function delete_news($id){
	global $db;
	$id=$db->quote($id);
	$sql = "DELETE FROM news WHERE id = $id";
	$db->exec($sql);
	header ("Location: index.php");
}

/**
 * Function check login and password in register.	
 *
 * @param string $login
 *	In the variable $login the user specifies his login
 *
 * @param string $email
 *  In the variable $email the user specifies his email. 
 */
function check_user_reg($login, $email) {
	global $db;
	$login = $db->quote($login);
	$email = $db->quote($email);	
  $result = $db->query("SELECT login, email FROM users WHERE login = $login AND email = $email");
	$res = $result->fetch(PDO::FETCH_ASSOC);
  if ($res) {
  	return TRUE;
  }
}

/**
 * Function which leads to the profiles information of the appearance on the page profile.
 */
function take_profile($id) {
	global $db;
	$id = $db->quote($id);
	$result = $db->query("SELECT avatar, email, surname, name, date_reg, date_log, role, password FROM users WHERE id = $id ");
	$row = $result->fetch(PDO::FETCH_ASSOC);
	return $row;
}

/**
 * Function which leads to the profiles information of the appearance on the page all_profiles.
 */
function take_all_profiles() {
  global $db;
  $result = $db->query("SELECT avatar, email, surname, name, date_reg, date_log, role, id FROM users ORDER BY login DESC");
  $row = $result->fetchAll(PDO::FETCH_ASSOC);
  return $row;
}

/**
 * Function profile_edit.
 *
 * @param string $avatar
 *	In the variable $title comes news title.
 * 
 * @param string $email
 *  In the variable $email comes the email which user specifies.
 *
 * @param string $surname
 *  In the variable $surname comes the surname which user specifies.
 *
 * @param string $name
 *  In the variable $name comes the name which user specifies.
 *
 * @param string $role
 *  In the variable $name comes the user role.
 *
 * @param string $password
 *  In the variable $password the user specifies his password.
 *
 * @param string $id
 *  In the variable $id comes user id. 
 */
function profile_edit( $avatar, $email, $surname,  $name, $role, $password, $id) {
	global $db;
	$avatar = $db->quote($avatar);
	$email = $db->quote($email);
	$surname = $db->quote($surname);
	$name = $db->quote($name);
	$role = $db->quote($role); 
	$password = $db->quote($password);
	$id = $db->quote($id);
	$sql = "UPDATE users SET avatar = $avatar, email = $email, surname = $surname, name = $name, role = $role, password = $password   WHERE id = $id";
	$db->exec($sql);
}

/**
 * Function update_date_log.
 *
 * @param string $id
 *  In the variable $id comes user id. 
 *
 * @param string $date_log
 *  In the variable $date_log comes the last login date of user.
 *
 */
function update_date_log($id, $date_log) {
	global $db;
	$id = $db->quote($id);
	$date_log = $db->quote($date_log);
	$sql = "UPDATE users SET date_log = $date_log WHERE id = $id";
	$db->exec($sql);
}

/**
 * Function delete user.
 *
 * @param string $id
 *  In the variable $id comes news id. 
 */
function delete_user($id){
	global $db;
	$id=$db->quote($id);
	$sql = "DELETE FROM users WHERE id = $id";
	$db->exec($sql);
	header ("Location: all_profiles.php");
}

?>
