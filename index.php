<?php

	require_once("inc/classes/core.class.php");
	require_once("data/classes/db.class.php");
	session_start();
	
	$core = new Core;
	$core->startup();
	$core->checkURI();
	
	require_once(SITE_ROOT . "inc/classes/auth.class.php");		
	require_once(SITE_ROOT . "inc/classes/language.class.php");	
	require_once(SITE_ROOT . "inc/routes.php");
	require_once(SITE_ROOT . "inc/controllers/template.controller.php");							
	require_once(SITE_ROOT . "inc/controllers/pages.controller.php");							
	require_once(SITE_ROOT . "inc/controllers/blog.controller.php");							
		
	define( 'WP_USE_THEMES', false); require('./wp/wp-blog-header.php'); 

	$language = new Language;
	$lang     = $language->load($_GET['lang']);
		
	$routes	  = new Routes;
	$routes->call();

	$pages = new PagesController;
	$tpl = new TemplateController;
	echo $tpl->view();