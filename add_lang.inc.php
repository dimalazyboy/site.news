<?php

/**
 * @file
 * File for adding news to base .
 */

	$lang_ukr = clear_data($_POST['lang_ukr']);
	$lang_eng = clear_data($_POST['lang_eng']);
	add_lang($lang_eng, $lang_ukr);
?>
