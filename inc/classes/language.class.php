<?php
	
	class Language {
		
		function string($key) {

			// Loads string from array defined in function Language->load().
			// If the string is not found, the default language is loaded (English).
			// 
			//
			
			global $lang;					
			if (isset($lang["$key"])) {	
				return $lang["$key"];
			} else if (!isset($lang["key"])) {

				return $lang['english']["$key"];
			
			} 
		}
		
		function current_language() {
			
			return $_GET['lang'];
		}
		
		function addString() {

		      $strings = [];
		      $db = Db::getInstance();
		      $req = $db->query('SELECT * FROM translations WHERE lang = \'' . $lang . '\'');
			
		      foreach($req->fetchAll(PDO::FETCH_ASSOC) as $string) {

				$strings[$string['keyword']] = $string['string'];

		      }

		      $req = $db->query('SELECT * FROM translations WHERE lang = \'en\'');
			
		      foreach($req->fetchAll(PDO::FETCH_ASSOC) as $string) {

				$strings['english'][$string['keyword']] = $string['string'];

		      }		
		}
		
		public static function load($lang) {
			
			// Queries the database for language strings and stores them in an array.
			// Also stores the strings of the default language for fallback in case 
			// the string is not available in the currently selected language.
			//
			
		      $strings = [];
		      $db = Db::getInstance();
		      $req = $db->query('SELECT * FROM translations WHERE lang = \'' . $lang . '\'');
			
		      foreach($req->fetchAll(PDO::FETCH_ASSOC) as $string) {

				$strings[$string['keyword']] = $string['string'];

		      }
			  // You can ignore this if the language is already English.
			  
		      $req = $db->query('SELECT * FROM translations WHERE lang = \'en\'');
			
		      foreach($req->fetchAll(PDO::FETCH_ASSOC) as $string) {

				$strings['english'][$string['keyword']] = $string['string'];

		      }

		      return $strings;
		    }
	}