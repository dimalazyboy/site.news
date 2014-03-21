<?php
require 'db.inc.php';
require 'func.inc.php';
require 'lang.inc.php';
if ($language == 'en') {
	$word = take_lang_eng();
}
else {
	$word = take_lang_ukr();
}
?>

<html>
<head>
<script language="JavaScript">
<!-- Скрыть 

function test1(form) {
  if (form.text1.value == "")
    alert(<?php echo $word[19][0]; ?>)
  else { 
   alert("Hi "+form.text1.value+"! Форма заполнена корректно!");
  }
}

function test2(form) {
  if (form.text2.value == "" || 
      form.text2.value.indexOf('@', 0) == -1) 
        alert(<?php echo $word[46][0]; ?>);
  else alert("OK!");
}
// -->
</script>
</head>

<body>
<form name="first">
Введите Ваше имя:<br>
<input type="text" name="text1">
<input type="button" name="button1" value="Проверка" onClick="test1(this.form)">
<P>
Введите Ваш адрес e-mail:<br>
<input type="text" name="text2">
<input type="button" name="button2" value="Проверка" onClick="test2(this.form)">
</body>
</html>






