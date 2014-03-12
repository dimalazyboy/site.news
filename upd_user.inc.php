<?php

/**
 * @file
 * File for update news.
 */
if (isset($_FILES["load"])) {
	// move_uploaded_file($_FILES["load"]["tmp_name"], "C:/Program Files (x86)/VertrigoServ/www/img/".$id.".jpg");
	move_uploaded_file($_FILES['load']['tmp_name'], 'img/'.$id.'.jpg');
}
$avatar = $id;
$email = clear_data($_POST['email']);
$surname = clear_data($_POST['surname']);
$name = clear_data($_POST['name']);
$role = clear_data($_POST['role']);
$password = clear_data($_POST['password']);
$id = $id;
profile_edit($avatar, $email, $surname,  $name, $role, $password, $id);	
?>