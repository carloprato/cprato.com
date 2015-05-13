<?php
	
	class Translate {
		
		public static function all() {
			
			$array = include SITE_ROOT . "lang/" . $_GET['lang'] . ".lang.php";
			$english = include SITE_ROOT . "lang/en.lang.php";
			$array['english'] = $english;
			return $array;
		}
		public static function update() {
						
			if (isset($_POST['saveButton']) && 1 == 0) { // Disabling the save feature until issue #3 is fixed.
				
				unset($_POST['saveButton']);
				$lang = $_POST;
				
				$filename = $_SERVER['DOCUMENT_ROOT'] . "/lang/" . $_GET['lang'] . ".lang.php";
				$text = "<?php" . "\r\n";
				$text .= '$lang = array();' . "\r\n";
				foreach($lang as $key => $value) {
				    $text .= '$lang["' . $key.'"] = "'. $value . '";' . "\r\n";
					}
					$text .= 'return $lang;' . "\r\n";
					
				$fh = fopen($filename, "w") or die("Could not open log file.");
				$data = filemtime($_SERVER['DOCUMENT_ROOT'] . "/lang/" . $_GET['lang'] . ".lang.php.bk");
				$time_modified = time() - $data;
	
				if ($time_modified > 600) {
					copy($_SERVER['DOCUMENT_ROOT'] . "/lang/" . $_GET['lang'] . ".lang.php", $_SERVER['DOCUMENT_ROOT'] . "/lang/" . $_GET['lang'] . ".lang.php.bk");
					}
					
				fwrite($fh, $text) or die("Could not write file!");
				fclose($fh);
				}		
		}
		
		function saveToFile() {
			

			$lang = array();
			$lang = $this->addString();
			$filename = $_SERVER['DOCUMENT_ROOT'] . "/lang/" . $this->current_language() . ".lang.php";
			$text = "<?php" . "\r\n";
			$text .= '$lang = array();' . "\r\n";
			foreach($lang as $key => $value)
			{
			    $text .= '$lang["' . $key.'"] = "'. $value . '";' . "\r\n";
			}
				$text .= 'return $lang;' . "\r\n";
				
			$fh = fopen($filename, "w") or die("Could not open log file.");
			/* $data = filemtime($_SERVER['DOCUMENT_ROOT'] . "/lang/" . $this->current_language() . ".lang.php.bk");
			$time_modified = time() - $data;
			echo $time_modified;
			if ($time_modified > 600) {
				copy($_SERVER['DOCUMENT_ROOT'] . "/lang/" . $this->current_language() . ".lang.php", $_SERVER['DOCUMENT_ROOT'] . "/lang/" . $this->current_language() . ".lang.php.bk");
			}
			*/
			fwrite($fh, $text) or die("Could not write file!");
			fclose($fh);
		}
	}