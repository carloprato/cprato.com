<?php
	
	class EditorController extends BaseController {
		
		// Class to add, modify and remove static HTML pages.
		//
		//
		//
	
	
		
		function index() {
			// List all possible actions related to this module
			
			Auth::authorise(array("editor"), true);
			
			$pages = scandir($_SERVER['DOCUMENT_ROOT'] . '/data/views/pages/');

			$i = 2;
			$page_editor = array();
			while (isset($pages[$i])) {
				$str = explode(".", $pages[$i]);
				$page_editor[$i]['page_name'] = $pages[$i];
				$page_editor[$i]['page_id'] = $str[0];
				$i++;
			}		

			TemplateController::set("page_editor", $page_editor);
		}
		
		function add() {
			
			Auth::authorise(array("editor"), true);
			
			// Adds a new static page
			if (isset($_POST['page_name'])) {
				$this->tpl->set("POST", print_r($_POST, true));		
				$file = fopen("data/views/pages/" . $_POST['page_name'] . ".view.php", "w");
				
				$content = "{layout:start}
								{layout:evidence}";
				$content .= $_POST['page_content'];
				$content .= "{endlayout:evidence}
							{endlayout}";
							
				fwrite($file, $content);
				header("Location: /en/" . $_POST['page_name']);
			}
		}
		
		function delete($file) {
			unlink($_SERVER['DOCUMENT_ROOT'] . "/data/views/pages/" . $file . ".view.php");
			header("Location: /en/editor");
		}
		
		function edit($page_id) {
			// Edits a created static page
			Auth::authorise(array("editor"), true);
					
			$page = htmlentities(file_get_contents("data/views/pages/" . $_GET['arg'] . ".view.php"));
			$page = str_replace("{layout:start}{layout:evidence}", "", $page);
			$page = str_replace("{endlayout:evidence}{endlayout}", "", $page);
			if (!empty($_POST['page_content'])) {
				
				$file = fopen("data/views/pages/" . $_GET['arg'] . ".view.php", 'w');
				
				$content  = "{layout:start}{layout:evidence}";
				$content .= $_POST['page_content'];
				$content .= "{endlayout:evidence}{endlayout}";
							
				fwrite($file, $content);
				header('Location: /en/editor/edit/'. $_GET["arg"]); // !!! Let's code something better when we have time
				$page = $_POST['page_content'];
			}

			$this->tpl->set("page_content", $page);
							
		}
	}
