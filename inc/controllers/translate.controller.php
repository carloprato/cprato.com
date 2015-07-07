<?php
	
	class TranslateController extends BaseController {

		static public function version() {
			
			return "0.0.1";
		}
		
		static public function views_list() {
			
			return array('index', 'update');
		}

		static public function description() {
			
			return "Essential module to display and modify strings for translation.";
		}
							
									
		function index() {
 			
			Auth::protect(100);
			$strings1 = Language::load($_GET['lang']);
			$strings = NULL;	
			foreach ($strings1 as $key=>$value) {
				
                if ($key == 'english') { continue; }
            	$strings .= "			
					<tr>
	                	<td style='width:200px;'>
	                    	" . $key . "
	                    </td>
	                    <td style='width:200px;'>
	                    	" . /* htmlspecialchars($strings1['english'][$key]) */ "
	                    </td>
	                    <td>
	                    	<textarea name='". $key . "' style='width:400px;height:100%;'>" . htmlspecialchars($value) . "</textarea>
						</td>
					</tr>
					";                                                  
			}	
			$this->tpl->set("translation_table", $strings);
			return $strings;
		}
		
		function update() {

			Auth::protect(100);						
			if (isset($_POST['saveButton'])) {

				$strings = [];
				$post = array();
				$post = $_POST;
				unset($post['saveButton']);
				unset($post['new_key']);
				unset($post['new_value']);
				unset($post['new_translation']);
				  
				$lang = $_GET['lang'];
				foreach ($post as $key=>$value) {

					$sql = 'SELECT count(*) FROM translations WHERE keyword = ? AND lang = ?';
					$q = $this->db->prepare($sql);
					$req = $q->execute(array( $key, $lang ));					

			   		if ( $q->fetchColumn() > 0 ) {
						   
						$sql = 'UPDATE translations SET string = ? WHERE lang = ? AND keyword = ?';
						$q = $this->db->prepare($sql);						
						$req = $q->execute(array( $value, $lang, $key));
					} 
				}
				
				if (isset($_POST['new_key']) && $_POST['new_key'] != NULL) {
	
					$key = $_POST['new_key'];
					$value = $_POST['new_value'];
					$lang = $_GET['lang'];
					$sql = 'INSERT INTO `translations`(`id`, `keyword`, `string`, `lang`) VALUES (?, ?, ?, ?)';
					$q = $this->db->prepare($sql);						
					$req = $q->execute(array(NULL, $key, $value, $lang));
				}
			}		
		}					
	}