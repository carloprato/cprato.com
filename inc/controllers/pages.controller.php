<?php
	
	class Pages {
		
		protected $action;
		protected $controller;

		function __construct() {
						
			if (isset($_GET['action'])) {
				$this->action   = $_GET['action'];
				$this->controller = $_GET['p'];	
			} else {
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