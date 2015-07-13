<?php
			$permissions = array(
				"admin"      => 1, // Can do everything
				"translator" => 1, // Can translate
				"editor"	 => 1, // Can add static pages and review blog posts
				"author"	 => 1, // Can add blog posts
				"moderator"  => 1, // Can ban users and discussions in the forum
				"user"       => 1  // Normal user
			);
			
			function authorise($permissions, $role) {
				echo $permissions;
				$test = str_split($permissions);
				//print_r($test);
				if ($test[$role] == 1) { return "Authorized"; } 
				else return "Not authorized";
				
			}
		//echo authorise('10001', 1);
		//echo authorise('00111', 3);			
	require_once("inc/classes/autoloader.class.php"); // Autoload classes
	require_once("data/config/db.config.php"); // Database details
    require_once 'vendor/autoload.php'; // Composer

	$core     = new Core; // Class with basic functions

	$language = new Language; // Translation class
	$lang     = $language->load(LANG); // Loads language

	$routes	  = new Routes; // Router
	
	$tpl 	  = new TemplateController; // Starts template
	echo $tpl -> view(); // Let's go!

