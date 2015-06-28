<?php
	
	class AdminController {

		static public function version() {
			
			return "0.0.1";
		}
		
		static public function views_list() {
			
			return array('index', 'list_posts', 'view_post');
		}
						
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