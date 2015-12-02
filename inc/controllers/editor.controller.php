<?php
	
	class EditorController extends BaseController {
		
		// Class to add, modify and remove static HTML pages.
		//
		//
		//

		/**
		 * List all possible actions related to this module
		 *
		 */	
		function index() {
			
			Auth::authorise(array("editor"), true);
			$editor = new EditorModel;
			$pages = $editor->getPages();
			TemplateController::set("page_editor", $pages);
		}
		
		function add() {
			
			Auth::authorise(array("editor"), true);
			
			if (isset($_POST['page_name'])) {
				
				$name = $_POST['page_name'];
				$content = '<div class="evidence_container">
							<div class="row evidence">
							<div class="evidence_paragraph col_12 ">';				
				$content .= $_POST['page_content'];
				$content .= '</div>
							</div>
							<div class="fill">&nbsp;</div>
							</div>';

				$editor = new EditorModel;
				$editor->add($name, $content);				
				header("Location: /en/" . $_POST['page_name']);
			}
		}
		
		function delete($file) {
			
			Auth::authorise(array("editor"), true);			

			$editor = new EditorModel;
			$editor->delete($file);			
			header("Location: /en/editor");
		}
		
		function edit($page_id) {
			// Edits a created static page
			Auth::authorise(array("editor"), true);

			if (!empty($_POST['page_content'])) {
				
				$editor = new EditorModel;
				$editor->update($page_id, $_POST['page_content']);
				header('Location: /en/editor/edit/'. $this->arg); // !!! Let's code something better when we have time
			}

			$editor = new EditorModel;
			$page = $editor->getPage($page_id);			
			TemplateController::set("page_content", htmlentities($page->content));			
		}
	}