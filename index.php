<?php
	include("inc/controllers/display.class.php");
	include("inc/controllers/language.class.php");	
	include("inc/config.php");
	$lang = new Language;
	$l = $lang->load($_GET['lang']);
	$display = new Display;
	$html  =	$display->view('header');
	$html .= 	$display->view('body');
	$html .=	$display->view($_GET['p']);
	$html .=	$display->view('footer');
	?>
