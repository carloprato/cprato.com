<?php
	
	class EmailController extends BaseController {
		
		// Class to send messages without being logged in.
		//
		//
		//
	
		
		function send() {
			
			//Auth::authorise(array(""), true);

			if (isset($_POST['email_email']) && isset($_POST['email_name']) && isset($_POST['email_content']) && isset($_POST['email_submit']) && $_POST['email_captcha'] == 7) {

				$email = new EmailModel;
				$email->send($_POST['email_email'], $_POST['email_name'], $_POST['email_content'], date("d/m/y H:i"));
			}
		}
	
	}
