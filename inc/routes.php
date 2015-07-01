<?php
	
	class Routes {
				
		function call() {			
	
			if (isset($_GET['p'])) {
				$controller = $_GET['p'];
			} else {				
				$controller = 'pages';
			}
			
			if (isset($_GET['action'])) {
				$action = $_GET['action'];
			} else $action = 'index';
											
			if (isset($_GET['arg'])) {
				$arg = $_GET['arg'];
			} else $arg = NULL;
					
			if (file_exists(SITE_ROOT . "inc/controllers/" . $controller . ".controller.php")) {
				require_once(SITE_ROOT . "inc/controllers/" . $controller . ".controller.php");
				$class = ucwords($controller)."Controller";				
				${$controller} = new $class;
				${$controller}->{$action}($arg);															
			}				
		}
	}