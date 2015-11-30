<?php
	
	class AdminController {

		public function index() {
			
			Auth::authorise(array("translator", "editor", "author", "moderator"), true);
			
		}
		public function guide() {

			Auth::authorise(array("translator", "editor", "author", "moderator"), true);			
			
		}
		
		public function email() {
			
			Auth::authorise(array("editor", "author", "moderator"), true);

			$db = Db::getInstance();
			$sql = 'SELECT * FROM contact ORDER BY id DESC';
			$q = $db->prepare($sql);
			$req = $q->execute(array());	
			$search_results = array();	
			$i = 0;
			$messages = NULL;
			foreach($q->fetchAll(PDO::FETCH_OBJ) as $message) {

					$messages .=   "E-mail: <b>" . $message->email . "</b> <br/>
									Name: <b>" . $message->name . "</b><br/>
									Date: <b>" . $message->date . "</b><br/>
									" .
								$message->content
								. "<br/><hr>";
			 }
					
			TemplateController::set("messages", $messages);						
		}

	}