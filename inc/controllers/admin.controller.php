<?php
	
	class AdminController {
				
		public static function all() {
			
			return "test";
		}
		public static function test() {
			
			global $language;
			global $lang;
						
			return $language->string("About");
			
		}
	}