<?php
	
	function autoloader($class) {
		$class = strtolower($class);
		$class = str_replace('controller', '', $class);
		$classes = array(
				'inc/classes/' . $class . '.class.php',
				'inc/controllers/' . $class . '.controller.php',
				'inc/' . $class . '.php'
				);
		foreach ($classes as $single_class) {
	    	if (file_exists($single_class)) {
				require_once($single_class);
			}
		}
	}	
	spl_autoload_register('autoloader');