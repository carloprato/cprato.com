<?php
	
	class EmailController extends BaseController {
		
		// Class to add, modify and remove static HTML pages.
		//
		//
		//
	
		
		function send() {
			
			//Auth::authorise(array(""), true);

			if (isset($_POST['email_email']) && isset($_POST['email_name']) && isset($_POST['email_content']) && isset($_POST['email_submit']) && $_POST['email_captcha'] == 7) {

				$file = fopen("data/views/message.txt", "a+");
				
				$content  = "E-mail: " . $_POST['email_email'] . "\n";
				$content .= "Name: " . $_POST['email_name'] . "\n";
				$content .= "Message content: " . $_POST['email_content'] . "\n\n";
							
				fwrite($file, $content);
			}
		}
	
	}
