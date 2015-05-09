<?php
	
	class Display {
		
		function view($page, $data = NULL) {
			
		 	global $lang;
			global $language;
			return include(SITE_ROOT . "inc/views/" . $page . ".view.php");		
		}
	}