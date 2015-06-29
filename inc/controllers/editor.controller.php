<?php
	
	class EditorController {
		
		// Class to add, modify and remove static HTML pages.
		//
		//
		//
	
		static public function version() {
			
			return "0.0.1";
		}
		
		static public function views_list() {
			
			return array('index', 'add', 'edit');
		}

		static public function description() {
			
			return "Module to add and edit pages to the website.";
		}
											
		function __construct() {
			

		}
		
		function index() {
			// List all possible actions related to this module
			Auth::protect(100);						
		}
		
		function add() {
			
			Auth::protect(100);
			
			// Adds a new static page
			if (isset($_POST['page_name'])) {
				// Removing backslash before writing the content to file
				$_POST['page_content'] = str_replace("\\", "", $_POST['page_content']);
				// Removing the stylesheet, temporary fix
				$_POST['page_content'] = str_replace('<link href="/data/res/css/stylesheet.css" rel="stylesheet">', "", $_POST['page_content']);
				$tpl = new TemplateController;
				$tpl->set("POST", print_r($_POST, true));		
				$file = fopen("data/views/pages/" . $_POST['page_name'] . ".view.php", "w");
				fwrite($file, $_POST['page_content']);
				header("Location: /en/" . $_POST['page_name']);
			}
		}
		
		function remove() {
			// Removes a created static page
		}
		
		function edit($id) {
			// Edits a created static page
			global $language;
			$page = file_get_contents("data/views/pages/" . $id . ".view.php");
			$tpl = new TemplateController;
			
			if(preg_match_all('/{{translate:+(.*?)}}/', $page, $matches)) {
				foreach ($matches[1] as $string) {

					$page = str_replace("{{translate:" . $string . "}}", "<span style='display:none;'>" . $string . "</span>" . $language->string($string) . "&zwnj;", $page);
				}
			}

			$tpl->set("page_content", $page);
			global $text;
			$text = "1";
							
		}
	}