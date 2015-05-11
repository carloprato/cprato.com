<?php
	
	class Language {
		
		function load($lang) {
			
			$lang_file = array();
			$lang_file = SITE_ROOT . "lang/" . $lang . ".lang.php";
			$lang_file_default = SITE_ROOT . "lang/en.lang.php";
			if (file_exists($lang_file)) {
				include $lang_file;
				return $lang;	
			} else {	
				include $lang_file_default;						
				return SITE_ROOT . "lang/en.lang.php";
			}
		}
		
		function string($key) {
			
			$current_language = $this->current_language();
			$lang = $this->load($current_language);
			
			if (isset($lang["$key"])) {	
				return $lang["$key"];
			} else if (!isset($lang["key"])) {
				$lang = $this->load('en');

				return $lang["$key"];
			
			} 
		}
		
		function current_language() {
			
			return $_GET['lang'];
		}
		
		function addString() {

			$lang = array();
			$lang = $this->load($this->current_language());
			if (isset($addKey)) {
				$lang[$addKey] = $addValue;
			}
			return $lang;			
		}
		

	}