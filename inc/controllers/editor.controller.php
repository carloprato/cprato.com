<?php
	
	class EditorController {
		
		// Class to add, modify and remove static HTML pages.
		//
		//
		//
		
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
			global $template;
			$tpl = new TemplateController;
			$tpl->set("page_content", $page);
			global $text;
			$text = "1";

							
		}
	}