<?php

	require_once("inc/classes/autoloader.class.php");
	require_once("data/config/db.config.php");	

	$core = new Core;
	$core->startup();
	$core->checkURI();

	$language = new Language;
	$lang     = $language->load(LANG);

	$routes	  = new Routes;
	$routes->call();

	$tpl = new TemplateController;
	echo $tpl->view();