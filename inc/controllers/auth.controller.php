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
							
			if (isset($_POST['submitButton'])) {	
					
				if (strlen($_POST['user']) <= 3) {
					
					$error = "Username too short.";
				} else if ($_POST['password'] != $_POST['confirm_password']) {
					
					$error = "Passwords do not match.";
				}	else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					
					$error = "E-Mail not valid.";
				} else if (!isset($_POST['name'])) {
					
					$error = "Please insert your name and surname.";
				} else if ($_POST['invitation_code'] != 'INVcarlo123') {
					
					$error = "The invitation code is not valid.";
				} else {
												
					$db = Db::getInstance();
					// !!! Short term fix, better to redefine $_POST instead
					$_POST = array_map('trim', $_POST);
					$sql = 'INSERT INTO `users`(`id`, `user`, `password`, `name`, `email`, `verified`, `privileges`) VALUES (?, ?, ?, ?, ?, ?, ?)';
					$q = $db->prepare($sql);						
					$req = $q->execute(array(NULL, $_POST['user'], Auth::encryptPassword($_POST['password']), $_POST['name'], $_POST['email'], md5($_POST['email']), 0));
					$success = "Successfully registered";
				}
			
			}
		
			if ($error) {
				$tpl = new TemplateController;
				$tpl->set("error", $error);	
				return $error;
			} else {				
				$tpl = new TemplateController;
				$tpl->set("success", $success);	
				return $success;
			}

		}

		public static function index() {
			
			$tpl = new TemplateController;
			$tpl->set("user_details", print_r($_SESSION, true));
		}
				
		public static function login() {
				
			return Auth::login();			
			
		}
		
		public static function logout() {
				
			return Auth::logout();			
			
		}
	}