<?php
	
	class Pages {
		
		function load($page, $data = NULL) {
			
		 	global $lang;
			global $language;
			
			return include(SITE_ROOT . "inc/views/" . $page . ".view.php");		
		}
		
		function view() {
			
			$html     =	$this->load('header');
			$html    .= $this->load('body');
			$html    .=	$this->load($_GET['p']);
			$html    .=	$this->load('footer');
			
			return $html;
		}
	}