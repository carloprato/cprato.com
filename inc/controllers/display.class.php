<?php
	
	class Display {
		
		function view($page, $data = NULL) {

		 	global $l;
			return include(SITE_ROOT . "inc/views/" . $page . ".view.php");		
		}
	}