<?php
	
	class AdminController {

		public function index() {
			
			Auth::protect(60);
			
		}
		public function guide() {
			
			Auth::protect(100);
		}
	}