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
			
			if (isset($_GET['action'])) {
				// Defines action not to incur in the undefined variable later on
				
				$action = $_GET['action'];
			}	else $action = NULL;	
			 
			if (isset($_GET['action']))  {
				// If there is an action there is a controller as well, so both are set
				
				$this->action   = $action;
				$this->controller = $_GET['p'];	
				
				
			} else if (!isset($_GET['action']) && isset($_GET['p']) && !file_exists("data/views/pages/" . $_GET['p'] . ".view.php")) {
				// If there is not action and the view file with the same name 
				// does not exist the index() method will be called
				
				$this->action = 'index';
				$this->controller = $_GET['p'];
				
			} else if (!isset($_GET['action']) && !isset($_GET['p']) && !file_exists("data/views/pages/" . $_GET['p'] . ".view.php")) {

				$this->action = 'index';
				$this->controller = 'pages';				
				
			} else if (file_exists("data/views/pages/" . $_GET['p'] . ".view.php")) {
				// If the view file exists the default controller pages will be called
				
				$this->controller = 'pages';	
				$this->action   = $_GET['p'];
			}
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
			foreach ($values as $key=>$value) {
					
				$template = str_replace("{{" . $key . "}}", $value, $template);
			}
			$this->replace_foreach();
		}
		
		function view() {
			
			global $template;
			global $language;
			$html     =	$this->load('header');
			$html    .= $this->load('body');
			$html    .=	$this->load($this->controller . "/" . $this->action);
			$html    .=	$this->load('footer');
			
			if(preg_match_all('/{{translate:+(.*?)}}/', $template, $matches)) {
				foreach ($matches[1] as $string) {

					$template = str_replace("{{translate:" . $string . "}}", $language->string($string), $template);
					}
			}			
			
			$this->set("p", $_GET['p']);
			$this->set("lang", $_GET['lang']);
			$this->set("SITE_ROOT", SITE_ROOT);
			$this->set("recent_posts", BlogController::recent_posts(3));
			$this->set("list_posts", BlogController::list_posts(3));
			$this->replace();
			return $template;
			
		}
		
		function replace_foreach() {
			
			global $template;

			if( preg_match('~\{foreach:(.*?)\}(.*?)\{endforeach\}~s', $template, $matches) ) {
			// If the {foreach} element is found, the variable $matches will be created.
			// Retrieving the array created in the controller and displayed in the template.
			
				global ${$matches[1]};		
				${$matches[1]} ;
				$foreach_array = ${$matches[1]};				
				foreach ($foreach_array as $single_array) {
					$foreach_content = $matches[2];					
					foreach ($single_array as $key => $value) {								
						$foreach_content = str_replace("{{loop_element:" . $key . "}}", $value, $foreach_content);					
					}						
					$foreach_complete .= $foreach_content;
					}
				$template = preg_replace('~\{foreach:(.*)\}(.*)\{endforeach\}~s', $foreach_complete, $template);
			}
		}
	}