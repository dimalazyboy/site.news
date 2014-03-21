<?php
require 'db.inc.php';
require 'func.inc.php';
require 'lang.inc.php';
if ($language == 'en') {
 $word = take_lang_eng();
} else {
 $word = take_lang_ukr();
}
$error = '';
?>
<html>
<head>
 <title><?php echo($word[5][0]); ?></title>
 <meta charset='UTF-8'>
 <script type="text/javascript">
  function Validate(obj) {
   var login = obj.login.value;
   var password = obj.password.value;
   var retype_password = obj.retype_password.value;
   var email = obj.email.value;
   var errors = "";
   var reg = /^\w+@\w+\.\w{2,4}$/i;
   if (login == "") {
    alert("<?php echo $word[19][0]; ?>");
    return false;
   }
   if (password == "") {
    alert("<?php echo $word[20][0]; ?>");
    return false;
   }
   if (retype_password == "") {
    alert("<?php echo $word[20][0]; ?>");
    return false;
   }
   if (email == "") {
    alert("<?php echo $word[46][0]; ?>");
    return false;
   }
   if (password !== retype_password) {
    errors += "<?php echo $word[48][0]; ?>";
   }
   if (!reg.test(email)) {
    errors += "<?php echo $word[47][0]; ?>";
   }
   if (errors == "") {
    return true;
   }
   else {
    alert(errors);
    return false;
   }
  }
 </script>
 <link rel='stylesheet' href='style.css'>
</head>
<body>
<?php
if (isset($_POST['action'])) {
	if (!$error) { 
		require 'reg.inc.php';
	}
}
?>
<a link='#0000ff' href='index.php'><?php echo($word[16][0]); ?></a>
<div id='content'>
 <form method='post' action='registration.php' OnSubmit="return Validate(this);">
 		<p class='error'>
			<?php 
				if ($error) {
						echo $error; 
				}
			?>
		</p>
  <input type='text' name='login' placeholder='<?php echo($word[13][0]); ?>'>
  <input type='password' name='password' placeholder='<?php echo($word[14][0]); ?>'>
  <input type='password' name='retype_password' placeholder='<?php echo($word[15][0]); ?>'>
  <input type='text' name='email' placeholder='<?php echo($word[17][0]); ?>'>
  <button type='submit' name='action'><?php echo($word[18][0]); ?></button>
 </form>
</div>
</body>
</html>