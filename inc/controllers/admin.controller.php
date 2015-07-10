<?php
	
	class AdminController {

		public function index() {
			
			Auth::protect(100);
		}
	}