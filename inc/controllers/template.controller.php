<?php
	
	class TemplateController {

		protected $action;
		protected $controller;

		function __construct() {
				
			if (isset($_GET['action'])) {
				// Defines action not to incur in the undefined variable later on
				
				$action = $_GET['action'];
			}	else $action = NULL;	
			 
			if (isset($_GET['action']))  {
				// If there is an action there is a controller as well, so both are set
				
				$this->action   = $action;
				$this->controller = $_GET['p'];	
				
				
			} else if (!isset($_GET['action']) && !file_exists("data/views/pages/" . $_GET['p'] . ".view.php")) {
				// If there is not action and the view file with the same name 
				// does not exist the index() method will be called
				
				$this->action = 'index';
				$this->controller = $_GET['p'];
				
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
					
				} else {
					
					header("HTTP/1.0 404 Not Found");
					return include(SITE_ROOT . "data/views/404.view.php");					
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
			$this->replace();
			return $template;
			
		}
		
	}