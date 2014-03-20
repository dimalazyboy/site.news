<?php

/**
 * @file
 * News look page.
 */
require 'db.inc.php';
require 'lang.inc.php';
require 'logout.inc.php';
require 'func.inc.php';
$role = 'guest';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
if (isset($_SESSION['id'])) {
	$id_login = $_SESSION['id'];
}
$per_page = 10; 
$cur_page = 1; 
if (isset($_GET['num']) && $_GET['num'] > 0) {
	$cur_page = $_GET['num'];
}
$start = ($cur_page - 1) * $per_page;
if ($language == 'en') {
	$word = take_lang_eng();
	$comm = take_all_comment_eng($id,$start, $per_page);
	$sql = $db->query("SELECT count(*) FROM comment_eng WHERE id_news = $id");
}
if ($language == 'ua') {
	$word = take_lang_ukr();
	$comm = take_all_comment_ukr($id,$start, $per_page);
	$sql = $db->query("SELECT count(*) FROM comment_ukr WHERE id_news = $id");
}
$error = '';
if (isset($_POST['action'])) {
	if (empty($_POST['login'])) {
		$error .= $word[19][0] . '<br>';
	}
	if (empty($_POST['password'])) {
	 $error .= $word[20][0] . '<br>';
	}
  if (!$error) {
  	require 'login.inc.php';
	}	
}
if (isset($_SESSION['role'])) {
	$role = $_SESSION['role'];	
} 
if (isset($_GET['logout'])) { 
	unset ($_SESSION['login']); 
	header ('Location: index.php');  
} 
if ($language == 'en') {
	$row = take_read_more_eng($id);
}
else {
	$row = take_read_more_ukr($id);
}
if (!$row) {
	Header ("Location: index.php");
}
if (isset($_POST['add_comm'])) {
	if (empty($_POST['msg_comm'])) {
	  $error .= $word[42][0] . '<br>';
	}
  if (!$error) {
  	if ($language == 'en') {
			require 'add_comment_eng.inc.php';
			header ("Location: news_look.php?id=$id");
		}
		else {
			require 'add_comment_ukr.inc.php';
			header ("Location: news_look.php?id=$id");
		}
 	}	
}
if (isset($_POST['add_mark'])) {
	$mark = $_POST['mark'];
	$id_news = $id;
	$login_user_mark = $login;
	add_mark($id_news, $login_user_mark, $mark);
	header ("Location: news_look.php?id=$id");
}
if ($truelogin) {
	$user_mark = take_mark($login,$id);
}
if (isset($_POST['delete_mark'])) {
	$id_mark = $user_mark['id_mark'];
	delete_mark($id_mark);
	header ("Location: news_look.php?id=$id");
}
if (isset($_POST['delete_all_marks'])) {
	delete_all_marks($id);
	header ("Location: news_look.php?id=$id");
}
$rows = $sql->fetch(PDO::FETCH_NUM);
$rows = $rows[0];
$num_pages = ceil($rows / $per_page);
$page = 0;
$all_marks = take_all_marks($id);
echo $language. '<br>';
$sum=0;

foreach ($all_marks as $eachmark) {
	$sum+=$eachmark['mark'];
}
?>

<!DOCTYPE html>
<html>
	<head>
  	<title><?php echo $word[44][0]; ?></title>
  	<meta charset='UTF-8'>
  	<link rel='stylesheet' href='style.css'>
	</head>
	<body>
    <?php
		if ($truelogin) { 
			if ($role =='user') {
		?>
	  		<?php echo $word[1][0]; ?>:<a link='#0000ff' href='profile.php?id=<?php echo $id; ?>'><?php echo $login; ?></a><br>
	  		<a link='#0000ff' href='index.php?logout'><?php echo $word[0][0]; ?></a><br> 
	  		<a link='#0000ff'  href='index.php'><?php echo $word[16][0]; ?></a> 
				<a link='#0000ff'  style='float:right' href='profile.php?id=<?php echo $id; ?>'><?php echo $word[2][0]; ?></a><br>
		<?php
	  		}
	  	if ($role =='editor'){
	  ?> 	
	    <?php echo $word[1][0]; ?>:<a link='#0000ff' href='profile.php?id=<?php echo $id_login; ?>'><?php echo $login; ?></a><br>
  		<a link='#0000ff' href='index.php?logout'><?php echo $word[0][0]; ?></a><br>
  		<a link='#0000ff'  href='index.php'><?php echo $word[16][0]; ?></a> 
  	<?php 	
  			if ($login == $row['author']) {
  	?>		
  				<a link='#0000ff'  style='float:right' href='news_edit.php?id=<?php echo $id; ?>'><?php echo $word[43][0]; ?></a><br>
					<a link='#0000ff'  style='float:right' href='news_delete.php?id=<?php echo $id; ?>'><?php echo $word[41][0]; ?></a>
		<?php
  			}
  		}
			if ($role =='admin'){
	  ?> 	
  		<?php echo $word[1][0]; ?>:<a link='#0000ff' href='profile.php?id=<?php echo $id_login; ?>'><?php echo $login; ?></a><br>
  		<a link='#0000ff' href='index.php?logout'><?php echo $word[0][0]; ?></a><br>
  		<a link='#0000ff'  href='index.php'><?php echo $word[16][0]; ?></a> 
			<a link='#0000ff'  style='float:right' href='news_edit.php?id=<?php echo $id; ?>'><?php echo $word[43][0]; ?></a><br>
			<a link='#0000ff'  style='float:right' href='news_delete.php?id=<?php echo $id; ?>'><?php echo $word[41][0]; ?></a>
		<?php
	  	}
		}
			else {
		?>
			<div class='text1'>
    		<a  link='#0000ff'  href='registration.php'><?php echo $word[5][0]; ?></a><br>
    		<a link='#0000ff'  href='index.php'><?php echo $word[16][0]; ?></a> 
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
						<input type='text' name='login' placeholder='<?php echo $word[14][0]; ?>'>
						<input type='password' name='password' placeholder='<?php echo $word[15][0]; ?>'>
						<button type='submit' name='action'><?php echo $word[18][0]; ?></button>
					</form>
				</div>
		<?php
	    }
    ?>
		<div id='content'> 
	    <div class='news'>
	  		<p class='author'><?php echo $word[6][0]; ?>:<?php echo $row['author']; ?></p>
	  		<p class='date'><?php echo $word[7][0]; ?>:<?php echo $row['date']; ?></p>
	  		<h3><?php echo $word[8][0]; ?>:<?php echo $row['title']; ?></h3>
	  <?php
	  		if (!empty($all_marks)) {
 		?>
	  			<p><?php echo $word[52][0]; ?> : <?php echo round($sum/count($all_marks),1); ?></p>
	  			<p><?php echo $word[53][0]; ?>: <?php echo count($all_marks); ?></p>
	  <?php		
	  		}
	  		else {
	  ?>
	  			<p><?php echo $word[54][0]; ?>.</p>
	  <?php
	  	  }
	  ?>	  
				<p class='msg'><?php echo $row['msg']; ?></p>
			</div>
 			<div>
 		<?php		
 			if ($role == 'admin' OR $role == 'editor' OR $role == 'user') {
 				if (!empty($user_mark)) {
 		?>
		 			<p><?php echo $word[55][0]; ?></p>
		 			<p><?php echo $word[56][0]; ?> : <?php echo $user_mark['mark']; ?></p>
		 			<form class='mark1'  method='POST' action=''>
		 				<button type = 'submit' name = 'delete_mark'><?php echo $word[57][0]; ?></button>
		<?php
						if ($role =='admin'){
		?>	
							<button type = 'submit' name = 'delete_all_marks'><?php echo $word[60][0]; ?></button>	
		<?php				
					}			
	  ?> 	
	  			</form>
		<?php 				
 				}
 		  else {
 		?>
 				<form class='mark1' method='POST' action=''>
					<p><?php echo $word[58][0]; ?></p>
			    <input class='mark' type="radio" name="mark" value="1"> 1 <input class='mark' type="radio" name="mark" value="2"> 2 <input class='mark' type="radio" name="mark" value="3"> 3 <input class='mark' type="radio" name="mark" value="4"> 4 <input class='mark' type="radio" name="mark" value="5"> 5 <br>
					<button type = 'submit' name = 'add_mark'><?php echo $word[59][0]; ?></button>
				</form>
			<?php 				
 				}
 		 	?>
				<form method='POST' action=''>
					<p class='error'>
						<?php
					 	if ($error) {
							echo $error; 
						}
						?>
					</p>
			  <input size = '50px' type = 'text' name = 'title_comm' placeholder = '<?php echo $word[8][0];?>'>
				<textarea name = 'msg_comm' rows = '20'></textarea>
				<button type = 'submit' name = 'add_comm'><?php echo $word[18][0]; ?></button>
				</form>
		<?php
	    }
    ?>
			<?php 
    		foreach ($comm as $res) {
			?>
			<div class='comment'>
	  		<p class='author'><?php echo $word[6][0]; ?>:<a link='#0000ff' href='profile.php?id=<?php echo $res['id_user']; ?>'><?php echo $res['author']; ?></a></p>
	  		<p class='date'><?php echo $word[7][0]; ?>:<?php echo $res['date']; ?></p>
	  		<h3><?php echo $word[8][0]; ?>:<?php echo $res['title']; ?></h3>
				<p class='msg'><?php echo $res['msg']; ?></p>
			<?php
			 if ($role =='admin') {
			?> 
				<a link='#0000ff' href='comment_delete.php?id=<?php echo $res['id_comm']; ?>'><?php echo $word[51][0]; ?></a> 
			<?php
			  }
			?>
			</div><br>
		 	<?php
 				}	 	
   	  ?>
		<?php echo $word[11][0]; ?>:
		<?php
		  while ($page++ < $num_pages) {
				if ($page == $cur_page) {
					echo "<b>" . $page . "</b>";
				} 
				else {
					echo "<a href=news_look.php?id=$id&num=" . $page . ">" . $page . "</a>";
					}
				}
		?>
		</div>
	</body>
</html>
