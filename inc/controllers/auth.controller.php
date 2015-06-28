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

		public static function index() {
			

		}
				
		public static function login() {
				
			return Auth::login();			
			
		}
		
		public static function logout() {
				
			return Auth::logout();			
			
		}
	}