<?php
	
	function autoloader($class) {
		$class = strtolower($class);
		$class = str_replace('controller', '', $class);
		$class = str_replace('model', '', $class);
		$classes = array(
				'inc/classes/' . $class . '.class.php',
				'inc/controllers/' . $class . '.controller.php',
				'inc/' . $class . '.php',
				'inc/models/' . $class . '.model.php'
				);
		foreach ($classes as $single_class) {
	    	if (file_exists($single_class)) {
				require_once($single_class);
				//echo "Loaded " . $single_class . "<br/>";
			}
		}
	}	
	spl_autoload_register('autoloader');