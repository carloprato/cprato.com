<?php
	
	class AdminController {

		public function index() {
			
			//Auth::protect(100);
			
		}
		public function guide() {
			
			Auth::protect(100);
		}
	}