<?php
	
	class Auth {
		
		public static function login() {
								
			// Checks if the user exists and if the password is correct, if yes authorizes them.
			//
			//
			//
			
		    $db = Db::getInstance();
			
			if (isset($_POST['user']) && isset($_POST['password'])) {
				$sql = 'SELECT * FROM users WHERE user = ? AND password = ? LIMIT 1';
				$q = $db->prepare($sql);
				$req = $q->execute(array( $_POST['user'], $_POST['password']));	
				

				foreach($q->fetchAll(PDO::FETCH_ASSOC) as $user) {

					$_SESSION['privileges'] = $user['privileges'];
					$_SESSION['user'] = $_POST['user'];
					$_SESSION['password'] = md5($_POST['password']);


					return "Login Successful.";		
		      	}


		    	return "Error.";
				}

				header("Location: /en/auth/auth");
		 	}
					
		function logout() {
			
			session_destroy();
			header('Location: /en/home');
			
		}
		
		function register() {
			
			
		}
		
		public static function protect($privileges) {
			
			
			if (isset($_SESSION['privileges']) && $_SESSION['privileges'] >= $privileges) {
				
				return true;
			} else if (isset($_SESSION['privileges']) && $_SESSION['privileges'] < $privileges) {

		 		header("Location: /en/auth");
			} else {

				header("Location: /en/auth");
			}
		}
		
	}
