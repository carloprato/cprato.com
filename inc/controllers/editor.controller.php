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
						
		}
		function add() {
			// Adds a new static page
							
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