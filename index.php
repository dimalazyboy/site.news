<?php

/**
 * @file
 * Home page.
 */

require 'lang.inc.php';
require 'db.inc.php'; 
require 'func.inc.php'; 
require 'logout.inc.php';
$per_page = 10; 
$cur_page = 1; 
$role = 'guest';
if (isset($_GET['page']) && $_GET['page'] > 0) {
	$cur_page = $_GET['page'];
}
$error = '';
if(isset($_POST['action'])) {
	if (empty($_POST['login'])) {
		$error .= $lang['err_login'] . '<br>';
	}
	if (empty($_POST['password'])){
	 $error .= $lang['err_pass'] . '<br>';
	}
  if (!$error) {
  	require 'login.inc.php';
	}	
	}
if (isset($_SESSION['id'])) {
	$id = $_SESSION['id'];
}
if (isset($_SESSION['role'])) {
	$role = $_SESSION['role'];	
}
if (isset($_GET['logout'])) { 
	unset ($_SESSION['login']); 
	unset ($_SESSION['role']); 
	header ('Location: index.php');  
}
if (isset($role)) {
	if ($role=="ban") {
?>		
	<a link='#0000ff' href='index.php?logout'><?php echo $lang['logout']; ?></a><br>
<?php
		echo $lang['ban']; exit;
	}
}	

$per_page = 10; 
$start = ($cur_page - 1) * $per_page;
$news = take_news($start, $per_page);
$sql = $db->query("SELECT count(*) FROM news");
$rows = $sql->fetch(PDO::FETCH_NUM); 
$rows = $rows[0];
$num_pages = ceil($rows / $per_page);
$page = 0;
?>

<!DOCTYPE html>
<html>
	<head>
  	<title><?php echo $lang['title']; ?></title>
  	<meta charset='UTF-8'>
  	<link rel='stylesheet' href='style.css'>
	</head>
	<body>
			<div class='text2'>
			<a link='#0000ff'  href='index.php?lang=ua'> Українська </a> 
			<a link='#0000ff'  href='index.php?lang=ru'> Русский </a>
			<a link='#0000ff'  href='index.php?lang=en'> English </a>
		</div>
    <?php
			if ($truelogin and (!$error)) { 
				if ($role =='user') {
		?>
	  	 		<?php echo $lang['welcome']; ?>:<a link='#0000ff' href='profile.php?id=<?php echo $id; ?>'><?php echo $login; ?></a><br>
	  			<a link='#0000ff' href='index.php?logout'><?php echo $lang['logout']; ?></a> 
					<a link='#0000ff'  style='float:right' href='profile.php?id=<?php echo $id; ?>'><?php echo $lang['my_profile']; ?></a><br>
		<?php
	  		}
	   		if ($role =='editor'){
	  ?> 	
	  		<?php echo $lang['welcome']; ?>:<a link='#0000ff' href='profile.php?id=<?php echo $id; ?>'><?php echo $login; ?></a><br>
	  		<a link='#0000ff' href='index.php?logout'><?php echo $lang['logout']; ?></a> 
	  		<a link='#0000ff'  style='float:right' href='add_news.php'><?php echo $lang['add_news']; ?></a><br>
				<a link='#0000ff'  style='float:right' href='profile.php?id=<?php echo $id; ?>'><?php echo $lang['my_profile']; ?></a><br>
		<?php 
		 		}
	   		if ($role == 'admin') {
		?>
	  	  <?php echo $lang['welcome']; ?>:<a link='#0000ff' href='profile.php?id=<?php echo $id; ?>'><?php echo $login; ?></a><br>
	  		<a link='#0000ff' href='index.php?logout'><?php echo $lang['logout']; ?></a> 
	  		<a link='#0000ff'  style='float:right' href='add_news.php'><?php echo $lang['add_news']; ?></a><br>
				<a link='#0000ff'  style='float:right' href='profile.php?id=<?php echo $id; ?>'><?php echo $lang['my_profile']; ?></a><br>
				<a link='#0000ff'  style='float:right' href='all_profiles.php'>All profiles</a><br>
		<?php
				}
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
    		foreach ($news as $row) {
			?>
	    <div class='news'>
	  		<p class='author'>Автор:<a link='#0000ff' href='profile.php?id=<?php echo $id; ?>'><?php echo $row['author']; ?></a></p>
	  		<p class='date'>Дата:<?php echo $row['date']; ?></p>
	  		<h3>Заголовок:<?php echo $row['title']; ?></h3>
				<p class='msg'>
					<?php 
						$maxlen = 150;
						$string = $row['msg'];
						echo cutString($string, $maxlen);
	 					if(mb_strlen($string) > $maxlen) {
	 				?>
				<a  link='#0000ff'  href='news_look.php?id=<?php echo $row['id']; ?>'><?php echo $lang['read_more']; ?></a> 
					<?php
	 					}
	 					else {
					?>
						<a link='#0000ff' href='news_look.php?id=<?php echo $row['id']; ?>'><?php echo $lang['news_option']; ?></a>
					<?php
	 					}
					?>	
				</p>
			</div>
    		<?php
 					}	 	
   		  ?>
		<br>
		<?php echo $lang['pages']; ?>:
		<?php
		  while ($page++ < $num_pages) {
				if ($page == $cur_page) {
					echo "<b>" . $page . "</b>";
				} 
				else {
					echo "<a href=\"?page=" . $page . "\">" . $page . "</a>";
					}
				}
		?>
			</div>
	</body>
</html>
