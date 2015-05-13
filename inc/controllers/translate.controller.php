<?php
	
	class Translate {
		
		public static function all() {
			
			$strings = Language::load($_GET['lang']);
			
			return $strings;
		}
		public static function update() {
						
			if (isset($_POST['saveButton'])) {


				$strings = [];
		      	$db = Db::getInstance();
				  $post = array();
				  $post = $_POST;
				  unset($post['saveButton']);
				  // $post[''] = $post['new_key'];
				  //echo "<pre>";
				  //print_r($_POST);
				$lang = $_GET['lang'];
				foreach ($post as $key=>$value) {
					
					$sql = 'SELECT count(*) FROM translations WHERE keyword = ? AND lang = ?';
					$q = $db->prepare($sql);
					$req = $q->execute(array( $key, $lang ));					


			   		if ( $q->fetchColumn() == 1 ) {
						   
							$sql1 = 'UPDATE translations SET string = ? WHERE lang = ? AND keyword = ?';
							$q1 = $db->prepare($sql1);						
							$req1 = $q1->execute(array( $value, $lang, $key));
							

					   } else {

							//$req = $db->query('INSERT INTO `translations`(`id`, `keyword`, `string`, `lang`) VALUES (NULL,\'' . $key . '\',\'' . $value . '\' ,\'' . $lang . '\')');	   
					   }
				}

			
			    foreach($q->fetchAll(PDO::FETCH_ASSOC) as $string) {

					//$strings[$string['keyword']] = $string['string'];

		      		}

				/*	
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
				*/
			}		
		}
		
		function saveToFile() {			


		/*
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
			
			fwrite($fh, $text) or die("Could not write file!");
			fclose($fh);
		*/
		}
		
		

			
		}

	