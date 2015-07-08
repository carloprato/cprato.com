<?php
	
	class EditorController extends BaseController {
		
		// Class to add, modify and remove static HTML pages.
		//
		//
		//
	
		
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
				$this->tpl->set("POST", print_r($_POST, true));		
				$file = fopen("data/views/pages/" . $_POST['page_name'] . ".view.php", "w");
				fwrite($file, $_POST['page_content']);
				header("Location: /en/" . $_POST['page_name']);
			}
		}
		
		function remove() {
			// Removes a created static page
		}
		
		function edit($page_id) {
			// Edits a created static page
			Auth::protect(100);
			
			global $language;
			
			$page = file_get_contents("data/views/pages/" . $_GET['arg'] . ".view.php");
			
			if (!empty($_POST['page_content'])) {
				
				$file = fopen("data/views/pages/" . $_GET['arg'] . ".view.php", 'w');
				fwrite($file, $_POST['page_content']);
				$page = $_POST['page_content'];
			}

			$this->tpl->set("page_content", $page);
							
		}
	}
