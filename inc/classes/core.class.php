<?php
	
	class Core {
	
		function __construct() {
			// Defines startup variables
			global $user;			
			
			session_start();
			if (isset($_GET['lang'])) $lang = $_GET['lang'];
			else $lang = 'en';
			if (isset($_GET['p'])) $page = $_GET['p'];
			else $page = 'en';
			define("SITE_ROOT", "");
			define("LANG", $lang);
			define("PAGE", $page);
			define("COOKIE_PREFIX", 'ecf5252a4a1a154b75c72f60477564b3a94b576308ea9f3b'); // Cookie to prefix to make the remember me feature more secure
			define("FB_PASSWORD", "5nzMXkxyzwBYbWIQwf7VlmPDVrekJycaxf5jzRwefiA2nXmzUaEDX9Z7cakB0PSQFrZSiuHAtw2Z4itwoL0vdylRTyhYy34X");
				
			//// DEBUG
			// 0 Production, no warnings, just fatal errors
			// 1 Testing, warnings
			// 2 Extended errors
			////
			
			define("DEBUG", "2");
			error_reporting(E_ALL);
			
			define("VERSION", "0.0.1a");
			if (isset($_SESSION['user'])) {
				define("USER", $_SESSION['user']);
				$user = $_SESSION['user'];
			}
			$this->checkURI();
			Auth::autologin();
		}
	
		function checkURI() { 
			// Check if language and page to display are set, otherwise redirects to the homepage
			
			if (!isset($_GET['p']) || !isset($_GET['lang'])) {
				
				header("Location: " . SITE_ROOT . "en/home");
			}
		}
			
		function debug($message, $level) {
			
			if (DEBUG >= $level) {

				return $message;
				}
			}
		}