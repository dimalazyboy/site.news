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
function add_news($title_ukr, $title_eng, $author, $id_author, $date,  $msg_ukr, $msg_eng) {
	global $db;
	$title_ukr = $db->quote($title_ukr);
	$title_eng = $db->quote($title_eng);
	$author = $db->quote($author);
	$id_author = $db->quote($id_author);
	$date = $db->quote($date);
	$msg_ukr = $db->quote($msg_ukr);
	$msg_eng = $db->quote($msg_eng);
	$sql1 = "INSERT INTO news_ukr (title, author, id_author, date, msg) VALUES ($title_ukr, $author, $id_author, $date, $msg_ukr)";
	$sql2 = "INSERT INTO news_eng (title, author, id_author, date, msg) VALUES ($title_eng, $author, $id_author, $date, $msg_eng)"; 
	$db->exec($sql1);
	$db->exec($sql2);
	header ("Location: news_look.php");
}

/**
 * Function which leads to the news of the appearance on the news look.
 */
function take_news_ukr($start, $per_page) {
  global $db;
  $result = $db->query("SELECT id, title, author, id_author, date, msg FROM news_ukr ORDER BY id DESC LIMIT $start, $per_page") or die("asda");
  $res = $result->fetchAll(PDO::FETCH_ASSOC);
  return $res;
}

/**
 * Function which leads to the news of the appearance on the news look.
 */
function take_news_eng($start, $per_page) {
  global $db;
  $result = $db->query("SELECT id, title, author, id_author, date, msg FROM news_eng ORDER BY id DESC LIMIT $start, $per_page") or die("asda");
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
function take_read_more_ukr($id) {
	global $db;
	$id = $db->quote($id);
	$result = $db->query("SELECT title, author, date,  msg FROM news_ukr WHERE id = $id ");
	$row = $result->fetch(PDO::FETCH_ASSOC);
	return $row;
}

/**
 * Function which leads to the news of the appearance on the page news reader.
 * 	
 * @param string $id
 *  In the variable $id comes news id.  
 */
function take_read_more_eng($id) {
	global $db;
	$id = $db->quote($id);
	$result = $db->query("SELECT title, author, date,  msg FROM news_eng WHERE id = $id ");
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
function update_news_ukr( $title, $date,  $msg, $id) {
	global $db;
	$title = $db->quote($title);
	$date = $db->quote($date);
	$msg = $db->quote($msg);
	$id = $db->quote($id);
	$sql = "UPDATE news_ukr SET title = $title, date = $date, msg = $msg WHERE id = $id";
	$db->exec($sql);
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
function update_news_eng( $title, $date,  $msg, $id) {
	global $db;
	$title = $db->quote($title);
	$date = $db->quote($date);
	$msg = $db->quote($msg);
	$id = $db->quote($id);
	$sql = "UPDATE news_eng SET title = $title, date = $date, msg = $msg WHERE id = $id";
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
	$sql1 = "DELETE FROM news_ukr WHERE id = $id";
	$sql2 = "DELETE FROM news_eng WHERE id = $id";
	$db->exec($sql1);
	$db->exec($sql2);
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
function add_lang($lang_eng, $lang_ukr) {
	global $db;
	$lang_eng = $db->quote($lang_eng);
	$lang_ukr = $db->quote($lang_ukr);
	$sql1 = "INSERT INTO lang_eng (lang) VALUES ($lang_eng)"; 
	$sql2 = "INSERT INTO lang_ukr (lang) VALUES ($lang_ukr)";	
	$db->exec($sql1);
	$db->exec($sql2);
	// header ("Location: news_look.php");
}

/**
 * Function which leads to the profiles information of the appearance on the page profile.
 */
function take_lang_eng() {
	global $db;
	$result = $db->query("SELECT lang FROM lang_eng");
	$row = $result->fetchAll(PDO::FETCH_NUM);
	return $row;
}

/**
 * Function which leads to the profiles information of the appearance on the page profile.
 */
function take_lang_ukr() {
	global $db;
	$result = $db->query("SELECT lang FROM lang_ukr");
	$row = $result->fetchAll(PDO::FETCH_NUM);
	return $row;
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
function update_lang_eng($lgold, $lgnew) {
	global $db;
	$lgold = $db->quote($lgold);
	$lgnew = $db->quote($lgnew);
	$sql = "UPDATE lang_eng SET lang = $lgnew WHERE lang = $lgold";
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
function update_lang_ukr($lgold, $lgnew) {
	global $db;
	$lgold = $db->quote($lgold);
	$lgnew = $db->quote($lgnew);
	$sql = "UPDATE lang_ukr SET lang = $lgnew WHERE lang = $lgold";
	$db->exec($sql);
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
function add_comment_ukr($id_news, $id_user, $author, $date, $title_comm, $msg_comm) {
	global $db;
	$id_news = $db->quote($id_news);
	$id_user = $db->quote($id_user);
	$author = $db->quote($author);
	$date = $db->quote($date);
	$title_comm = $db->quote($title_comm);
	$msg_comm = $db->quote($msg_comm);
	$sql = "INSERT INTO comment_ukr (id_news, id_user, author, date, title, msg) VALUES ($id_news, $id_user, $author, $date, $title_comm, $msg_comm)";
	$db->exec($sql);
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
function add_comment_eng($id_news, $id_user, $author, $date, $title_comm, $msg_comm) {
	global $db;
	$id_news = $db->quote($id_news);
	$id_user = $db->quote($id_user);
	$author = $db->quote($author);
	$date = $db->quote($date);
	$title_comm = $db->quote($title_comm);
	$msg_comm = $db->quote($msg_comm);
	$sql = "INSERT INTO comment_eng (id_news, id_user, author, date, title, msg) VALUES ($id_news, $id_user, $author, $date, $title_comm, $msg_comm)";
	$db->exec($sql);
}

/**
 * Function which leads to the news of the appearance on the page news reader.
 * 	
 * @param string $id
 *  In the variable $id comes news id.  
 */
function take_all_comment_eng($id, $start, $per_page) {
	global $db;
	$id = $db->quote($id);
	$result = $db->query("SELECT id_comm, id_user, author, date, title, msg FROM comment_eng WHERE id_news = $id ORDER BY id_comm DESC LIMIT $start, $per_page") or die("asda");
	$res = $result->fetchAll(PDO::FETCH_ASSOC);
	return $res;
}

/**
 * Function which leads to the news of the appearance on the page news reader.
 * 	
 * @param string $id
 *  In the variable $id comes news id.  
 */
function take_all_comment_ukr($id, $start, $per_page) {
	global $db;
	$id = $db->quote($id);
	$result = $db->query("SELECT id_comm, id_user, author, date, title, msg FROM comment_ukr WHERE id_news = $id ORDER BY id_comm DESC LIMIT $start, $per_page") or die("asda");
	$res = $result->fetchAll(PDO::FETCH_ASSOC);
	return $res;
}

/**
 * Function which leads to the news of the appearance on the page news reader.
 * 	
 * @param string $id
 *  In the variable $id comes news id.  
 */
function take_one_comment_ukr($id_comm) {
	global $db;
	$id_comm = $db->quote($id_comm);
	$result = $db->query("SELECT id_news, title, msg FROM comment_ukr WHERE id_comm = $id_comm ");
	$row = $result->fetch(PDO::FETCH_ASSOC);
	return $row;
}

/**
 * Function which leads to the news of the appearance on the page news reader.
 * 	
 * @param string $id
 *  In the variable $id comes news id.  
 */
function take_one_comment_eng($id_comm) {
	global $db;
	$id_comm = $db->quote($id_comm);
	$result = $db->query("SELECT id_news, title, msg FROM comment_eng WHERE id_comm = $id_comm ");
	$row = $result->fetch(PDO::FETCH_ASSOC);
	return $row;
}

/**
 * Function delete news.
 *
 * @param string $id
 *  In the variable $id comes news id. 
 */
function delete_comment_ukr($id_comm){
	global $db;
	$id_comm = $db->quote($id_comm);
	$sql = "DELETE FROM comment_ukr WHERE id_comm = $id_comm";
	$db->exec($sql);
}

/**
 * Function delete news.
 *
 * @param string $id
 *  In the variable $id comes news id. 
 */
function delete_comment_eng($id_comm){
	global $db;
	$id_comm = $db->quote($id_comm);
	$sql = "DELETE FROM comment_eng WHERE id_comm = $id_comm";
	$db->exec($sql);
}

function add_mark($id_news, $login_user_mark, $mark) {
	global $db;
	$id_news = $db->quote($id_news);
	$login_user_mark = $db->quote($login_user_mark);
	$mark = $db->quote($mark);
	$sql = "INSERT INTO marks (id_news, login_user_mark, mark ) VALUES ($id_news, $login_user_mark, $mark)";
	$db->exec($sql);
}

/**
 * Function which leads to the news of the appearance on the news look.
 */
function take_mark($login, $id) {
  global $db;
  $id = $db->quote($id);
  $login = $db->quote($login);
  $result = $db->query("SELECT mark, id_mark FROM marks WHERE login_user_mark = $login AND id_news = $id ") or die("asda");
  $res = $result->fetch(PDO::FETCH_ASSOC);
  return $res;
}

/**
 * Function delete news.
 *
 * @param string $id
 *  In the variable $id comes news id. 
 */
function delete_mark($id_mark) {
	global $db;
	$id_mark = $db->quote($id_mark);
	$sql = "DELETE FROM marks WHERE id_mark = $id_mark";
	$db->exec($sql) or die("asda");
}

/**
 * Function which leads to the news of the appearance on the news look.
 */
function take_all_marks($id) {
  global $db;
  $id = $db->quote($id);
  $result = $db->query("SELECT mark FROM marks WHERE id_news = $id ") or die("asda");
  $res = $result->fetchAll(PDO::FETCH_ASSOC);
  return $res;
}

/**
 * Function delete news.
 *
 * @param string $id
 *  In the variable $id comes news id. 
 */
function delete_all_marks($id) {
	global $db;
	$id = $db->quote($id);
	$sql = "DELETE FROM marks WHERE id_news = $id";
	$db->exec($sql) or die("asda");
}


// function id_user() {
//   global $db;
//   $result = $db->query("SELECT u.id FROM users u RIGHT JOIN news n ON u.login = n.author") or die("asda");
//   $res = $result->fetchAll(PDO::FETCH_ASSOC);
//   return $res;
// }

//SELECT u.id FROM users u RIGHT JOIN news n ON u.login = n.author
?>
