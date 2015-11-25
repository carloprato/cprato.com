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
			TemplateController::set("messages", $messages);						
		}

	}