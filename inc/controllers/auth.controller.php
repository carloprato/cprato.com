<?php
	
	class AuthController extends BaseController {
						
		function register() {
			

			$registration_errors = Auth::register();	

				TemplateController::set("error", $registration_errors);	

				if ($registration_errors == NULL && isset($_POST['user'])) {

					TemplateController::set("success", 'The registration was completed successfully.');				

				}
				
				TemplateController::set("registration_errors", $registration_errors);
				return $registration_errors;	

		}

		public static function index() {
			
 
		}
				
		function login() {
			
			global $user;				
			$user = Auth::login($_POST['user'], $_POST['password']); // Returns user's details on success, false on failure
			if ($user != FALSE) {
				$_SESSION['privileges'] = $user['privileges'];
				$_SESSION['user_id'] = $user['id'];	
				$_SESSION['user'] = $user['user'];				

				$this->tpl->set("login", "Login successful.");
			} else {

				$this->tpl->set("login", "Login failed.");				
			}					
		}
		
		function logout() {
				
			return Auth::logout();	
			
		}
	}