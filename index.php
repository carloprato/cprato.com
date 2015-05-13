<?php

	require_once("inc/classes/core.class.php");
	require_once("inc/classes/db.class.php");
	
	$core = new Core;
	$core->startup();
	$core->checkURI();
	
	require_once(SITE_ROOT . "inc/classes/language.class.php");	
	require_once(SITE_ROOT . "inc/routes.php");
	require_once(SITE_ROOT . "inc/controllers/pages.controller.php");							
	
	$language = new Language;
	$lang     = $language->load($_GET['lang']);
		
	$routes	  = new Routes;
	$routes->call();

	$pages	  = new Pages;
	$pages->view();
	

