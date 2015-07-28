<?php
	
	class MessagesController {
		
		function index() {
			
			Auth::authorise("user");
			
			$message = new MessageModel();
			$message_list = $message->getAllReceived();
			TemplateController::set("messages", $message_list);
		}

		function thread($user_id) {
			
			Auth::authorise("user");
			
			$message = new MessageModel();
			$message_list = $message->getAllBy($user_id);
			TemplateController::set("messages", $message_list);
		}
		
				
		function send($to) {
			
			if (isset($_POST['submitButton'])) {
				
				$message = new MessageModel;
				$message->send($to);
				header("Location: /en/messages");
			}
		}
	}