<?php
	
	class Routes {
				
		function call() {
						
			if (isset($_GET['action'])) {
				
					$controller = $_GET['p'];
					$action = $_GET['action'];
					require_once(SITE_ROOT . "inc/controllers/" . $controller . ".controller.php");
					$class = ucwords($controller);				
					${$controller} = new $class;
					${$controller}->{$action}();	
				}	
				
		}
	}