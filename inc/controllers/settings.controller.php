<?php
	
	class SettingsController {
				
		public static function test() {
			
			global $language;
			global $lang;
						
			return $language->string("About");
			
		}
	}