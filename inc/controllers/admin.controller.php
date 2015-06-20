<?php
	
	class AdminController {
				
		public static function all() {
			Auth::protect(100);
			return "test";
		}
		public static function test() {
			
			global $language;
			global $lang;
						
			return $language->string("About");
			
		}
	}