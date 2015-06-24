<?php
	
	class AuthController {
		
		
		public static function auth() {
			

		}
		
		public static function login() {
				
			return Auth::login();			
			
		}
		
		public static function logout() {
				
			return Auth::logout();			
			
		}
	}