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
				
		function load($page, $data = NULL) {
			
		 	global $lang;
			global $language;
			
			return include(SITE_ROOT . "inc/views/" . $page . ".view.php");		
		}
		
		function view() {
						
			$html     =	$this->load('header');
			$html    .= $this->load('body');
			$html    .=	$this->load($this->controller . "/" . $this->action);
			$html    .=	$this->load('footer');
			
			return $html;
		}
	}