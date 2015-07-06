<?php

	require_once("inc/classes/core.class.php");
	require_once("data/db.config.php");	
	require_once("inc/classes/db.class.php");
	session_start();

	$core = new Core;
	$core->startup();
	$core->checkURI();

		
	require_once(SITE_ROOT . "inc/classes/auth.class.php");		
	require_once(SITE_ROOT . "inc/classes/language.class.php");	
	require_once(SITE_ROOT . "inc/routes.php");
	require_once(SITE_ROOT . "inc/controllers/template.controller.php");							
	require_once(SITE_ROOT . "inc/controllers/blog.controller.php");							
	Auth::autologin();

	$language = new Language;
	$lang     = $language->load(LANG);

	$routes	  = new Routes;
	$routes->call();

	$tpl = new TemplateController;
	echo $tpl->view();