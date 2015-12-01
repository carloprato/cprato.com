<?php

	class TemplateController extends BaseController {

		public $action;
		public $controller;
		public $arg;
		public $arg2;
		public static $values;
		public $lang;
		function __construct() {
			
			$this->controller = Routes::$controller;
			$this->page = Routes::$controller;
			$this->action = Routes::$action;
			$this->arg = Routes::$arg;
			$this->arg2 = Routes::$arg2;
			$this->lang = Routes::$lang;
		}

		function load($page, $type = 'view') {

			if (isset($this->page) && isset($this->lang)) {

				if (file_exists(SITE_ROOT . "data/views/" . $page . ".view.php")) {

					return $this->template .= file_get_contents(SITE_ROOT . "data/views/" . $page . ".view.php");
					
				} else if (file_exists(SITE_ROOT . "inc/views/" . $page . ".view.php")) {

					return $this->template .= file_get_contents(SITE_ROOT . "inc/views/" . $page . ".view.php");
				}
				
				else {

			// !!! Needs to go in the model
					$this->db = Db::getInstance();
					$sql = '
						SELECT *						
						FROM pages 
						WHERE name = ?
						OR name = ?
						LIMIT 1
					';
					$q = $this->db->prepare($sql);

					$req = $q->execute(array($page, explode('/', $page)[0]));
					foreach($q->fetchAll(PDO::FETCH_OBJ) as $page) {

						return $this->template .= $page->content;
					}
										
				}
				/*} else if (file_exists(SITE_ROOT . "inc/views/" . $page . ".view.php")) {

					return $this->template .= file_get_contents(SITE_ROOT . "inc/views/" . $page . ".view.php");
										
				} else {
					header("HTTP/1.0 404 Not Found");
					return $this->template .= file_get_contents(SITE_ROOT . "inc/views/errors/404.view.php");					
				}*/
			}	
		}
		
		public static function set($var, $content) {

			TemplateController::$values[$var] = $content;
		}

		public static function remove($template_value) {

			unset(TemplateController::$values[$template_value]);
		}
				
		function replace() {
			
			$this->replace_foreach();
			$this->replace_if();
			$this->replace_translation();	
			$this->replace_auth();		
			$this->replace_layout();
			
			foreach (TemplateController::$values as $key=>$value) {
				// !!! Kind of wrong...

				if (!is_array(TemplateController::$values[$key]) && !is_object(TemplateController::$values[$key])) { // Excluding arrays which will be converted as foreach loops

					$this->template = str_replace("{{" . $key . "}}", $value, $this->template);
				}
			}
		}
		
		function replace_foreach() {

			if( preg_match_all('~\{foreach:(.*?)\}(.*?)\{endforeach\}~s', $this->template, $matches) ) {
			// If the {foreach} element is found, the variable $matches will be created.
			// Retrieving the array created in the controller and displayed in the template.
			
				$i = 0;		

				while (isset($matches[1][$i])) {
					
					$loop_name = $matches[1][$i];

					$foreach_array = TemplateController::$values[$loop_name];
					
					$foreach_complete = NULL;			
					
					foreach ($foreach_array as $single_array) {
						$foreach_content = $matches[2][$i];					
						foreach ($single_array as $key => $value) {		

							$foreach_content = str_replace("{{loop_element:" . $key . "}}", $value, $foreach_content);
										
						}						
							$foreach_complete .= $foreach_content;
						}
					$this->template = preg_replace('~\{foreach:(.*?)\}(.*?)\{endforeach\}~s', $foreach_complete, $this->template, 1);

					$i++;
				}
			}			
		}
		
		function replace_if() {

			if( preg_match_all('~\{if:(.*?)\}(.*?)\{elseif\}(.*?)\{endif\}~s', $this->template, $matches) ) {
			// If the {if} element is found, the variable $matches will be created.
			// Retrieving the array created in the controller and displayed in the template.

				$i = 0;
				
				while (isset($matches[2][$i])) {
					$loop_name = $matches[1][$i];	
					$if_test = (explode(' ', $loop_name));
					
					$first = $second = NULL;
					if (isset($if_test[0])) 
					$first = TemplateController::$values[$if_test[0]];				
					else $first = 0;
					
					if (isset($if_test[2])) 
					$second = $if_test[2]; else $second = 0;

					$replacer = $matches[2][$i];

					$else = $matches[3][$i];

					if (isset($if_test[1])) {
						switch($if_test[1]) {
							
							default:
								if (!empty($first)) {

									$this->template = preg_replace('~\{if:' . $if_test[0] . '\}(.*?)\{endif\}~s', $replacer, $this->template, 1);								

								} else {

									$this->template = preg_replace('~\{if:' . $if_test[0] . '\}(.*?)\{endif\}~s', $else, $this->template, 1);

								}
												
							case "==":
								if ($first == $second) {

									$this->template = preg_replace('~\{if:' . $if_test[0] . ' == ' . $second . '\}(.*?)\{endif\}~s', $replacer, $this->template, 1);								

								} else {

									$this->template = preg_replace('~\{if:' . $if_test[0] . ' == ' . $second . '\}(.*?)\{endif\}~s', $else, $this->template, 1);

								}
							case ">":
								if ($first >= $second) {
									
									$this->template = preg_replace('~\{if:(.*?)\}(.*?)\{endif\}~s', $replacer, $this->template, 1);								
								} else {
									
									$this->template = preg_replace('~\{if:(.*?)\}(.*?)\{endif\}~s', $else, $this->template, 1);
								}
							}
						} else {

							if (!empty($first)) {
								
									$this->template = preg_replace('~\{if:(.*?)\}(.*?)\{endif\}~s', $replacer, $this->template, 1);								
								} else {
									
									$this->template = preg_replace('~\{if:(.*?)\}(.*?)\{endif\}~s', $else, $this->template, 1);
								}							
						}
					
					$i++;
				}
			}
		}
		
		function replace_translation() {
			
			if (preg_match_all('/{{translate:+(.*?)}}/', $this->template, $matches)) {

				foreach ($matches[1] as $string) {

					$this->template = str_replace("{{translate:" . $string . "}}", Language::string($string), $this->template);
				}
			}
		}
		
		function replace_auth() {
			
			// !!! No real need for this function
			
			if (preg_match_all('/{auth:(.*?)}(.*?){endauth}/s', $this->template, $matches)) {

				$i = 0;

				while (isset($matches[1][$i])) {
					
					if (Auth::authorise($matches[1][$i])) {
						
						$this->template = preg_replace('/{auth:(.*?)}(.*?){endauth}/s', $matches[2][$i], $this->template, 1);
											
					} else {
						
						$this->template = preg_replace('/{auth:(.*?)}(.*?){endauth}/s', '', $this->template, 1);					
					}		
					$i++;
				}
			}	
		}
		
		function replace_layout() {
			
			$this->template = str_replace("{layout:start}", "", $this->template);
            $this->template = str_replace("{endlayout}", "", $this->template);
			$this->template = preg_replace("/{layout:evidence}/s", "
				<div class='evidence_container'>
							<div class='row evidence'>
								<div class='evidence_paragraph col_12 '>
									
				", $this->template);	
			$this->template = str_replace("{endlayout:evidence}", "
							</div>
						</div>
			            <div class='fill'></div>
				        </div>
					</div>
				", $this->template);
		}
		
		function menu_items() {
			$db = Db::getInstance();
			$sql = 'SELECT * FROM pages WHERE name NOT LIKE "%home%"';
			$q = $db->prepare($sql);
			$req = $q->execute(array());	
			$search_results = array();	
			$i = 0;
			foreach($q->fetchAll(PDO::FETCH_OBJ) as $item) {
					
				 	$menu_items[$i]['file'] = explode('/', ($item->name))[0];					
					$menu_items[$i]['name'] = explode('/', ucwords($item->name))[0];
			 		$i++;
			 }
/*									
			$folder = scandir($_SERVER['DOCUMENT_ROOT'] . "/data/views/pages/");
			$i = 2;
			while (isset($folder[$i])) {
				if ($folder[$i] != '.' && $folder[$i] != '..' && $folder[$i] != "home.view.php") {
									 
				 	$test = explode(".", $folder[$i]); 
				 	$menu_items[$i]['file'] = $test[0];					
					$menu_items[$i]['name'] = ucwords($test[0]);
				}		
				$i++;				
			}
*/
			TemplateController::set("menu_items", $menu_items);
		}
		
		function view() {
					
			$this->load('header');
			$this->load('body');
			$this->load($this->controller . "/" . $this->action);
			$this->load('footer');
							
			$this->menu_items();
			$this->replace();			
						
			return $this->template; 		
		}
	}