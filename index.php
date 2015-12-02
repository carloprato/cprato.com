<?php
	session_start();
	require_once("inc/classes/autoloader.class.php"); 	// Autoload classes
	require_once("data/config/db.config.php"); 			// Database details
    require_once 'vendor/autoload.php'; 				// Composer
	
	$routes	  = new Routes; 							// Router
	
	$core     = new Core; 								// Class with basic functions

	Language::$lang = Language::load(LANG); 			// Loads language
	
	$tpl 	  = new TemplateController;					// Starts template

	echo $tpl -> view(); 								// Let's go!