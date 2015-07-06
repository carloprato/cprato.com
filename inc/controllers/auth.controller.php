<?php
	
	class AuthController {
		
		static public function version() {
			
			return "0.0.1";
		}
		
		static public function views_list() {
			
			return array('index', 'list_posts', 'view_post');
		}
		
		static public function description() {
			
			return "Essential module to protect pages and modules from unauthorized access.";
		}
							
				
		public static function auth() {
			
		}
		
		public static function register() {
			
			global $registration_errors;
			global $success;
			$registration_errors = Auth::register();	
				$tpl = new TemplateController;
				$tpl->set("error", $registration_errors);	
				$tpl->set("success", 'The registration was completed successfully.');
				if (!isset($_POST['user'])) {
				$tpl->set("success", '');	
				}	
				return $registration_errors;	

		}

		public static function index() {
			
			$tpl = new TemplateController;
			$tpl->set("user_details", print_r($_SESSION, true));
		}
				
		public static function login() {

			global $user;				
			$user = Auth::login(); // Returns user's details on success, false on failure
			if ($user != FALSE) {
				$_SESSION['privileges'] = $user['privileges'];
				$_SESSION['user_id'] = $user['id'];	
				$_SESSION['user'] = $user['user'];				
				$tpl = new TemplateController;
				$tpl->set("login", "Login successful.");
			} else {
				$tpl = new TemplateController;
				$tpl->set("login", "Login failed.");				
			}					
		}
		
		public static function logout() {
				
			return Auth::logout();	
			
		}
	}