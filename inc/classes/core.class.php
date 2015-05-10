<?php
	
	class Core {
		
		function startup() {
				// Defines startup variables
				
				define("SITE_ROOT", "");
				
				//// DEBUG
				// 0 Production, no warnings, just fatal errors
				// 1 Testing, warnings
				// 2 Extended errors
				////
				
				define("DEBUG", "2");
				error_reporting(E_ALL);
				
				define("VERSION", "0.0.1a");
			}

		function absolute_url($url) {
						
		}				
		function checkURI() { 
			// Check if language and page to display are set, otherwise redirects to the homepage
			
			if (!isset($_GET['p']) || !isset($_GET['lang'])) {
				
				header("Location: " . SITE_ROOT . "/en/home");
				}
			}
			
		function debug($message, $level) {
			
			if (DEBUG >= $level) {

				return $message;
				}
			}
		}