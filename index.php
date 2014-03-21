<?php

/**
 * @file
 * Home page.
 */

require 'lang.inc.php'; 
require 'db.inc.php'; 
require 'func.inc.php'; 
require 'logout.inc.php';
$role = 'guest';
$per_page = 10; 
$cur_page = 1; 
if (isset($_GET['page']) && $_GET['page'] > 0) {
$cur_page = $_GET['page'];
}
$start = ($cur_page - 1) * $per_page;
if ($language == 'en') {
	$word = take_lang_eng();
	$news = take_news_eng($start, $per_page);
	$sql = $db->query("SELECT count(*) FROM news_eng");
}
if($language == 'ua') {
	$word = take_lang_ukr();
	$news = take_news_ukr($start, $per_page);
	$sql = $db->query("SELECT count(*) FROM news_ukr");
}

$error = '';
if(isset($_POST['action'])) {
	if (empty($_POST['login'])) {
		$error .= $word[19][0] . '<br>';
	}
	if (empty($_POST['password'])){
	 $error .= $word[20][0] . '<br>';
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

$rows = $sql->fetch(PDO::FETCH_NUM); 
$rows = $rows[0];
$num_pages = ceil($rows / $per_page);
$page = 0;
?>

<!DOCTYPE html>
<html>
	<head>
  	<title><?php echo $word[22][0]; ?></title>
  	<meta charset='UTF-8'>
  	<link rel='stylesheet' href='style.css'>
	</head>
	<body>
		<?php
		if (isset($role)) {
			if ($role=="ban") {
		?>
		<a link='#0000ff' href='index.php?logout'><?php echo $word[0][0]; ?></a><br>
		<span><?php echo $word[21][0]; exit; ?><span>
		<?php
			}
		}	
		?>
			<a link='#0000ff' style='float:right; margin:4px;' href='index.php?lang=ua'><img src="img/Flag_of_Ukraine.png" width="50" height="25"></a> 
			<a link='#0000ff' style='float:right; margin:4px;'href='index.php?lang=en'><img src="img/Flag_of_the_United_Kingdom.png" width="50" height="25"></a>
    <?php
			if ($truelogin and (!$error)) { 
				if ($role =='user') {
		?>
	  	 		<span><?php echo $word[1][0]; ?>:</span><a link='#0000ff' href='profile.php?id=<?php echo $id; ?>'><?php echo $login; ?></a><br>
	  			<a link='#0000ff' href='index.php?logout'><?php echo $word[0][0]; ?></a><br> 
					<a link='#0000ff' style='float:right' href='profile.php?id=<?php echo $id; ?>'><?php echo $word[2][0]; ?></a><br>
		<?php
	  		}
	   		if ($role =='editor'){
	  ?> 	
	  		<span><?php echo $word[1][0]; ?>:</span><a link='#0000ff' href='profile.php?id=<?php echo $id; ?>'><?php echo $login; ?></a><br>
	  		<a link='#0000ff' href='index.php?logout'><?php echo $word[0][0]; ?></a><br> 
	 			<a link='#0000ff' style='float:right' href='add_news.php'><?php echo $word[3][0]; ?></a><br>
				<a link='#0000ff' style='float:right' href='profile.php?id=<?php echo $id; ?>'><?php echo $word[2][0]; ?></a><br>
		<?php 
		 		}
	   		if ($role == 'admin') {
		?>
	  	  <span><?php echo $word[1][0]; ?>:</span><a link='#0000ff' href='profile.php?id=<?php echo $id; ?>'><?php echo $login; ?></a><br>
	  		<a link='#0000ff' href='index.php?logout'><?php echo $word[0][0]; ?></a><br>
	  		<a link='#0000ff' style='float:right' href='add_news.php'><?php echo $word[3][0]; ?></a><br>
				<a link='#0000ff' style='float:right' href='profile.php?id=<?php echo $id; ?>'><?php echo $word[2][0]; ?></a><br>
				<a link='#0000ff' style='float:right' href='all_profiles.php'><?php echo $word[4][0]; ?></a><br>
				<a link='#0000ff' style='float:right' href='add_lang.php'><?php echo $word[12][0]; ?></a><br>
				<a link='#0000ff' style='float:right' href='lang_edit.php'><?php echo $word[27][0]; ?></a><br>
		<?php
				}
			}
			else {
		?>
			<div class='text1'>
    		<a link='#0000ff' href='registration.php'><?php echo $word[5][0]; ?></a>
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
						<input type='text' name='login' placeholder='<?php echo $word[13][0]; ?>'>
						<input type='password' name='password' placeholder='<?php echo $word[14][0]; ?>'>
						<button type='submit' name='action'><?php echo $word[18][0]; ?></button>
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
	  		<p class='author'><?php echo $word[6][0]; ?>:<a link='#0000ff' href='profile.php?id=<?php echo $row['id_author']; ?>'><?php echo $row['author']; ?></a></p>
	  		<p class='date'><?php echo $word[7][0]; ?>:<?php echo $row['date']; ?></p>
	  		<h3><?php echo $word[8][0]; ?>:<?php echo stripslashes($row['title']); ?></h3>
				<p class='msg'>
					<?php 
						$maxlen = 150;
						$string = stripslashes($row['msg']);
						echo cutString($string, $maxlen);
	 					if (mb_strlen($string) > $maxlen) {
	 				?>
						<a link='#0000ff' href='news_look.php?id=<?php echo $row['id']; ?>'><?php echo $word[9][0]; ?></a> 
					<?php
	 					}
	 					else {
					?>
						<a link='#0000ff' href='news_look.php?id=<?php echo $row['id']; ?>'><?php echo $word[10][0]; ?></a>
					<?php
	 					}
					?>	
				</p>
			</div>
    		<?php
 					}	 	
   		  ?>
		<br>
		<?php echo $word[11][0]; ?>:
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
