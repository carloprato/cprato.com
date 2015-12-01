<?php
	
	class EditorController extends BaseController {
		
		// Class to add, modify and remove static HTML pages.
		//
		//
		//
	
		function index() {
			// List all possible actions related to this module

			$db = Db::getInstance();
			$sql = 'SELECT * FROM pages';
			$q = $db->prepare($sql);
			$req = $q->execute(array());	
			$search_results = array();	
			$i = 0;
			foreach($q->fetchAll(PDO::FETCH_OBJ) as $item) {
					
				$page_editor[$i]['page_name'] = $item->name;					
				$page_editor[$i]['page_id'] = $item->name;			 		
				$i++;
			 }
/*			 
			 			
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
*/
			TemplateController::set("page_editor", $page_editor);
		}
		
		function add() {
			
			Auth::authorise(array("editor"), true);
			
			// Adds a new static page
			if (isset($_POST['page_name'])) {
				
				$content = '<div class="evidence_container">
							<div class="row evidence">
							<div class="evidence_paragraph col_12 ">';				
				$content .= $_POST['page_content'];
				$content .= '</div>
							</div>
							<div class="fill">&nbsp;</div>
							</div>';

				$db = Db::getInstance();
				$sql = 'INSERT INTO `pages` (`name`, `content`) VALUES (?, ?)';
				$q = $db->prepare($sql);
				$req = $q->execute(array($_POST['page_name'], $content));
				
				header("Location: /en/" . $_POST['page_name']);
			}
		}
		
		function delete($file) {
			$db = Db::getInstance();
			$sql = 'DELETE FROM `pages` WHERE name = ? LIMIT 1';
			$q = $db->prepare($sql);
			$req = $q->execute(array($file));
			header("Location: /en/editor");
		}
		
		function edit($page_id) {
			// Edits a created static page
			Auth::authorise(array("editor"), true);

			$db = Db::getInstance();

			if (!empty($_POST['page_content'])) {
				
				$db = Db::getInstance();
				$sql = 'UPDATE pages SET content = ? WHERE name = ? OR name = ?';
				$q = $db->prepare($sql);
				$req = $q->execute(array($_POST['page_content'], $page_id, $page_id . "/index")); // !!! Fix this too	

				header('Location: /en/editor/edit/'. $_GET["arg"]); // !!! Let's code something better when we have time
			}
			
			$sql = 'SELECT * FROM pages WHERE name = ? OR name = ?';
			$q = $db->prepare($sql);
			$req = $q->execute(array($page_id, $page_id . "/index")); // !!! Fix this too	

			$i = 0;
			foreach($q->fetchAll(PDO::FETCH_OBJ) as $page) {
					
				$this->tpl->set("page_content", htmlentities($page->content));
			 }
			 

		}
			 
			/*		
			$page = htmlentities(file_get_contents("data/views/pages/" . Routes::$arg . ".view.php"));
			$page = str_replace("{layout:start}{layout:evidence}", "", $page);
			$page = str_replace("{endlayout:evidence}{endlayout}", "", $page);
			if (!empty($_POST['page_content'])) {
				
				$file = fopen("data/views/pages/" . Routes::$arg . ".view.php", 'w');
				
				$content  = "{layout:start}{layout:evidence}";
				$content    .= $_POST['page_content'];
				$content .= "{endlayout:evidence}{endlayout}";
							
				fwrite($file, $content);
				header('Location: /en/editor/edit/'. $_GET["arg"]); // !!! Let's code something better when we have time
				$page = $_POST['page_content'];
			}
			*/
			//$this->tpl->set("page_content", $page);
							
	}