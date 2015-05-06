<?php

 	if ($_GET['lang'] == NULL) $_GET['lang'] = 'en';
	if ($_GET['p'] == NULL) $_GET['p'] = 'home';
 
	include("inc/config.php");		
	include("lang/en.lang.php");	
	include("lang/" . $_GET['lang'] .".lang.php");
	include("inc/header.inc.php");
	include("inc/body.inc.php");
	include("inc/". $_GET['p'] . ".inc.php");
	include("inc/footer.inc.php");

	?>
