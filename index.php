<?php
	
  	$params     	= split("/", $_SERVER['REQUEST_URI']);
	$_GET['lang'] 	= $params['1'];
	$_GET['p'] 		= $params['2'];
 	if ($_GET['lang'] == NULL) $_GET['lang'] = 'en';
	if ($_GET['p'] == NULL) $_GET['p'] = 'home';
	include("lang/en.lang.php");	
	include("lang/" . $_GET['lang'] .".lang.php");
	include("inc/header.inc.php");
	include("inc/body.inc.php");
	include("inc/". $_GET[p] . ".inc.php");
	include("inc/footer.inc.php");
	
	?>