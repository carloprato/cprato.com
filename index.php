<?php

	require_once("inc/classes/autoloader.class.php"); // Autoload classes
	require_once("data/config/db.config.php"); // Database details

	$core     = new Core; // Class with basic functions

	$language = new Language; // Translation class
	$lang     = $language->load(LANG); // Loads language

	$routes	  = new Routes; // Router
	
	$tpl 	  = new TemplateController; // Starts template
	echo $tpl -> view(); // Let's go!