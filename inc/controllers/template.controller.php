<?php
	
	class TemplateController {

		protected $action;
		protected $controller;

		static public function version() {
			
			return "0.0.1";
		}
		
		static public function views_list() {
			
			return array();
		}

		static public function description() {
			
			return "Essential module to set up and display the template.";
		}
									
		function __construct() {
			
			$this->controller = Routes::$controller;
			$this->action = Routes::$action;
		}	
		
		function load($page, $type = 'view') {
			
			global $template;
		 	global $lang;
			global $language;

			if (isset($_GET['p']) && isset($_GET['lang'])) {

				if (file_exists(SITE_ROOT . "data/views/" . $page . ".view.php")) {

					return $template .= file_get_contents(SITE_ROOT . "data/views/" . $page . ".view.php");
					
				} else if (file_exists(SITE_ROOT . "inc/views/" . $page . ".view.php")) {

					return $template .= file_get_contents(SITE_ROOT . "inc/views/" . $page . ".view.php");
										
				} else {
					header("HTTP/1.0 404 Not Found");
					return $template .= file_get_contents(SITE_ROOT . "inc/views/errors/404.view.php");					
				}
			}	
		}
		
		function set($var, $content) {
			global $language;
			global $template;
			global $values;
			$values[$var] = $content;

		}
		
		function replace() {
			
			global $values;
			global $template;

			$this->replace_if();			
			$this->replace_foreach();
	
			foreach ($values as $key=>$value) {
				// !!! Kind of wrong...
				if (!is_array($values[$key])) { // Excluding arrays which will be converted as foreach loops

					$template = str_replace("{{" . $key . "}}", $value, $template);
				}
			}
		}
		
		function replace_foreach() {
			
			global $template;

			if( preg_match_all('~\{foreach:(.*?)\}(.*?)\{endforeach\}~s', $template, $matches) ) {
			// If the {foreach} element is found, the variable $matches will be created.
			// Retrieving the array created in the controller and displayed in the template.

				$i = 0;				

				while (isset($matches[1][$i])) {
					global ${$matches[1][$i]};

					$foreach_array = ${$matches[1][$i]};
					$foreach_complete = NULL;			
					
					foreach ($foreach_array as $single_array) {
						$foreach_content = $matches[2][$i];					
						foreach ($single_array as $key => $value) {								
							$foreach_content = str_replace("{{loop_element:" . $key . "}}", $value, $foreach_content);			
						}						
						$foreach_complete .= $foreach_content;
						}
					$template = preg_replace('~\{foreach:(.*?)\}(.*?)\{endforeach\}~s', $foreach_complete, $template, 1);
					$i++;
				}
			}			
		}
		
		function replace_if() {

			global $template;

			if( preg_match_all('~\{if:(.*?)\}(.*?)\{elseif\}(.*?)\{endif\}~s', $template, $matches) ) {
			// If the {if} element is found, the variable $matches will be created.
			// Retrieving the array created in the controller and displayed in the template.

				$i = 0;
				
				while (isset($matches[2][$i])) {
					global ${$matches[1][$i]};	
					$foreach_array = ${$matches[1][$i]};
					$replacer = $matches[2][$i];
					$else = $matches[3][$i];

					if (isset($foreach_array)) {
	
						$template = preg_replace('~\{if:(.*?)\}(.*?)\{endif\}~s', $replacer, $template, 1);
				
					} else {
							$template = preg_replace('~\{if:(.*?)\}(.*?)\{endif\}~s', $else, $template, 1);				
					}
					
					$i++;
				}
			}
		}
		
		function view() {
			
			global $template;
			global $language;
			
			$this->load('header');
			$this->load('body');
			$this->load($this->controller . "/" . $this->action);
			$this->load('footer');
						
			$this->set("p", PAGE);
			$this->set("lang", LANG);
			$this->set("SITE_ROOT", SITE_ROOT);
			if (isset($_SESSION['user'])) {
				// !!! not good to set up variables like this
				$this->set("user", $_SESSION['user']);
			}

			$this->set("list_posts", BlogController::list_posts(3));
			$this->replace();

			if (preg_match_all('/{{translate:+(.*?)}}/', $template, $matches)) {

				foreach ($matches[1] as $string) {

					$template = str_replace("{{translate:" . $string . "}}", $language->string($string), $template);
				}
			}
			return $template; 		
		}
	}