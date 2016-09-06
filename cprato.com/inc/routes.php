<?php
	
	class Routes {
		
		static $lang;
		static $controller;
		static $action;
		static $arg;
		static $arg2;
		static $page;
		
		function __construct() {	

			if (isset($_GET['lang'])) {
				// Defines action not to incur in the undefined variable later on
				
				self::$lang = $_GET['lang'];
			}	else self::$lang = 'en';

			if (isset($_GET['arg'])) {
				// Defines action not to incur in the undefined variable later on
				
				self::$arg = $_GET['arg'];
			}	else self::$arg = NULL;	

			if (isset($_GET['arg2'])) {
				// Defines action not to incur in the undefined variable later on
				
				self::$arg2 = $_GET['arg2'];
			}	else self::$arg2 = NULL;	
									
			if (isset($_GET['action'])) {
				// Defines action not to incur in the undefined variable later on
				
				self::$action = $_GET['action'];
			}	else self::$action = NULL;	
			 
			if (isset($_GET['action']))  {
				// If there is an action there is a controller as well, so both are set
				
				self::$action   = $_GET['action'];
				self::$controller = $_GET['p'];	
								
			} else if (!isset($_GET['action']) && isset($_GET['p']) && !file_exists("data/views/pages/" . $_GET['p'] . ".view.php")) {
				// If there is not action and the view file with the same name 
				// does not exist the index() method will be called
				
				self::$action = 'index';
				self::$controller = $_GET['p'];
				
			} else if (!isset($_GET['action']) && !isset($_GET['p']) && !file_exists("data/views/pages/" . PAGE . ".view.php")) {

				header("Location: /en/home");			
				
			} else if (file_exists("data/views/pages/" . PAGE . ".view.php")) {
				// If the view file exists the default controller pages will be called

				self::$controller = 'home';	
				self::$action   = PAGE;
				
			}
			
			$class = ucwords(self::$controller)."Controller";				

			if (class_exists($class)) {
														
				${self::$controller} = new $class;
				
				${self::$controller}->{self::$action}(self::$arg, self::$arg2);	
				}
		}
	}