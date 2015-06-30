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
			
	        $db = Db::getInstance();
			
			$strings = [];
			$sql = 'SELECT * FROM translations WHERE lang = ?';
			$q = $db->prepare($sql);
		    $req = $q->execute(array($_GET['lang']));

		    foreach($q->fetchAll(PDO::FETCH_OBJ) as $string) {

				$strings[$string->keyword] = $string->string;
			}

			$sql = "SELECT * FROM translations WHERE lang = en";
			$q = $db->prepare($sql);
		    $req = $q->execute();

		    foreach($q->fetchAll(PDO::FETCH_OBJ) as $string) {

				$strings['english'][$string->keyword] = $string->string;
		    }		
		}

		public static function load($lang) {
			
			// Queries the database for language strings and stores them in an array.
			// Also stores the strings of the default language for fallback in case 
			// the string is not available in the currently selected language.
			//
			
		    $strings = array();
		    $db = Db::getInstance();
		    $req = $db->query('SELECT * FROM translations WHERE lang = \'' . $lang . '\'');
			
			foreach($req->fetchAll(PDO::FETCH_OBJ) as $string) {
				$strings[$string->keyword] = $string->string;
		    }

			if ($_GET['lang'] != 'en') {		  
			  	$req = $db->query('SELECT * FROM translations WHERE lang = "en"');				
				foreach($req->fetchAll(PDO::FETCH_ASSOC) as $string) {
						$strings['english'][$string->keyword] = $string->string;	
		    	}
			}
	    return $strings;
	    }
	}