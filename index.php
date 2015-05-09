<?php
	
	include("inc/controllers/display.class.php");
	include("inc/controllers/language.class.php");	
	include("inc/config.php");
	$config = new Config;
	$config->startup();
	$config->checkURI();
	$language = new Language;
	$lang = $language->load($_GET['lang']);
	$language->saveToFile();
	$display = new Display;
	$html  =	$display->view('header');
	$html .= 	$display->view('body');
	$html .=	$display->view($_GET['p']);
	$html .=	$display->view('footer');
	
	print_r($lang);
	?>
