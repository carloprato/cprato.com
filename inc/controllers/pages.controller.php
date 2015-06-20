<?php
	
	class PagesController {
		
		protected $action;
		protected $controller;

		function __construct() {
				
			if (isset($_GET['action'])) {
				
				$action = $_GET['action'];
			}	else $action = NULL;	
			 
			if (isset($_GET['action']))  {
				$this->action   = $action;
				$this->controller = $_GET['p'];	
			} else if (!isset($_GET['action']) && !file_exists("inc/views/pages/" . $_GET['p'] . ".view.php")) {
				
				$this->action = 'index';
				$this->controller = $_GET['p'];
				
			} else if (file_exists("inc/views/pages/" . $_GET['p'] . ".view.php")) {
				
				$this->controller = 'pages';	
				$this->action   = $_GET['p'];
			}
		}	
				
		function load($page, $type = 'view') {
			
		 	global $lang;
			global $language;

			if (isset($_GET['p']) && isset($_GET['lang'])) {

				if (file_exists(SITE_ROOT . "inc/views/" . $page . ".view.php")) {

					return include(SITE_ROOT . "inc/views/" . $page . ".view.php");	
				} else {
					
					header("HTTP/1.0 404 Not Found");
					return include(SITE_ROOT . "inc/views/404.view.php");					
				}
			}	
		}
		
		function view() {
						
			$html     =	$this->load('header');
			$html    .= $this->load('body');
			$html    .=	$this->load($this->controller . "/" . $this->action);
			$html    .=	$this->load('footer');
			
			return $html;
		}
	}