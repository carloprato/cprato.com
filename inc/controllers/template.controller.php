<?php

	class TemplateController extends BaseController {

		public $action;
		public $controller;
		public $arg;
		public $arg2;
		public static $values;
		
		function __construct() {
			
			$this->controller = Routes::$controller;
			$this->action = Routes::$action;
			$this->arg = Routes::$arg;
			$this->arg2 = Routes::$arg2;
			
		}
		
		function load($page, $type = 'view') {
			
		 	global $lang;
			global $language;

			if (isset($_GET['p']) && isset($_GET['lang'])) {

				if (file_exists(SITE_ROOT . "data/views/" . $page . ".view.php")) {

					return $this->template .= file_get_contents(SITE_ROOT . "data/views/" . $page . ".view.php");
					
				} else if (file_exists(SITE_ROOT . "inc/views/" . $page . ".view.php")) {

					return $this->template .= file_get_contents(SITE_ROOT . "inc/views/" . $page . ".view.php");
										
				} else {
					header("HTTP/1.0 404 Not Found");
					return $this->template .= file_get_contents(SITE_ROOT . "inc/views/errors/404.view.php");					
				}
			}	
		}
		
		public static function set($var, $content) {
			global $language;

			TemplateController::$values[$var] = $content;
		}

		public static function remove($template_value) {
			global $language;

			unset(TemplateController::$values[$template_value]);
		}
				
		function replace() {
			
			$this->replace_if();			
			$this->replace_foreach();
			
			foreach (TemplateController::$values as $key=>$value) {
				// !!! Kind of wrong...

				if (!is_array(TemplateController::$values[$key])) { // Excluding arrays which will be converted as foreach loops

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
						
					$foreach_array = TemplateController::$values[$loop_name];				
					
					$replacer = $matches[2][$i];
					$else = $matches[3][$i];

					if ($foreach_array == TRUE) {
	
						$this->template = preg_replace('~\{if:(.*?)\}(.*?)\{endif\}~s', $replacer, $this->template, 1);
				
					} else {
							$this->template = preg_replace('~\{if:(.*?)\}(.*?)\{endif\}~s', $else, $this->template, 1);				
					}
					
					$i++;
				}
			}
		}
		
		function view() {
			
			global $language;
			
			$this->load('header');
			$this->load('body');
			$this->load($this->controller . "/" . $this->action);
			$this->load('footer');
						
			$this->set("p", PAGE);
			$this->set("lang", LANG);
			$this->set("SITE_ROOT", SITE_ROOT);
			$this->set("arg", $this->arg);
			if (isset($_SESSION['user'])) {
				// !!! not good to set up variables like this
				$this->set("user", $_SESSION['user']);
			}
			$blog = new BlogController;
			
			$this->set("list_posts", $blog->list_posts(3));
			$this->replace();

			if (preg_match_all('/{{translate:+(.*?)}}/', $this->template, $matches)) {

				foreach ($matches[1] as $string) {

					$this->template = str_replace("{{translate:" . $string . "}}", $language->string($string), $this->template);
				}
			}
			return $this->template; 		
		}
	}