<?php
	
	class Language {
		
		function load($lang) {

			return include(SITE_ROOT . "lang/" . $_GET['lang'] . ".lang.php");
		}
	}