<?php
	
	class Auth {
		

		public static function login() {
								
			// Checks if the user exists and if the password is correct, if yes authorizes them.
			//
			//
			//
			//
			
		    $db = Db::getInstance();
			
			if (isset($_POST['user']) && isset($_POST['password'])) {
				
				$sql = 'SELECT * FROM users WHERE user = ? LIMIT 1';
				$q = $db->prepare($sql);
				$req = $q->execute(array( $_POST['user']));	
				
				foreach($q->fetchAll(PDO::FETCH_ASSOC) as $user) {

						if ( hash_equals($user['password'], crypt($_POST['password'], $user['password'])) ) {
							return $user;
						}
						return false;
		      	}

				  return false;
				}

				header("Location: /en/auth/auth");
		 	}
					
		function logout() {
			
			session_destroy();
			header('Location: /en/home');
			
		}
		
		public static 	function register() {
			
			
			if (isset($_POST['submitButton'])) {	
			
				$error = array();

				$db = Db::getInstance();				
				$sql = 'SELECT * FROM `users` WHERE user = ?';
				$q = $db->prepare($sql);						
				$req = $q->execute(array($_POST['user']));
				if ($q->fetchColumn() > 0) {		
					  $error[]['error'] = 'The username is taken.';							  
				}
				$sql = 'SELECT * FROM `users` WHERE email = ?';
				$q = $db->prepare($sql);						
				$req = $q->execute(array($_POST['email']));
				if ($q->fetchColumn() > 0) {		
					  $error[]['error'] = 'Another account with the same e-mail exists. Please choose another e-mail.';							  
				}
											
				if (strlen($_POST['user']) <= 3) {
					
					$error[]['error'] = "Username too short.";
				}
				if ($_POST['password'] != $_POST['confirm_password']) {
					
					$error[]['error'] = "Passwords do not match.";
				}
				
				if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					
					$error[]['error'] = "E-Mail not valid.";
				} 
				
				if (!isset($_POST['name'])) {
					
					$error[]['error'] = "Please insert your name and surname.";
				} 
				
				if ($_POST['invitation_code'] != 'INVcarlo123') {
					
					$error[]['error'] = "The invitation code is not valid.";
				}

											  
				if (count($error) == 0) {
												
					$db = Db::getInstance();
					// !!! Short term fix, better to redefine $_POST instead
					
			
						$_POST = array_map('trim', $_POST);
						$sql = 'INSERT INTO `users`(`id`, `user`, `password`, `name`, `email`, `verified`, `privileges`) VALUES (?, ?, ?, ?, ?, ?, ?)';
						$q = $db->prepare($sql);						
						$req = $q->execute(array(NULL, $_POST['user'], Auth::encryptPassword($_POST['password']), $_POST['name'], $_POST['email'], md5($_POST['email']), 10));
						return NULL;
					  }
				
					return $error;
			}						
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
		
		public static function roles() {		

			$roles = array(
					"root"   => 100,
					"admin"  => 90,
					"editor" => 80,
					"author" => 70,
					"translator" => 60,
					"reader" => 0
			);
			return $roles;
		}
		
		public static function getUserID() {
		    $db = Db::getInstance();			
			$sql = 'SELECT * FROM users WHERE user = ? LIMIT 1';
				$q = $db->prepare($sql);
				/// !!! $_SESSION not always defined
				$req = $q->execute(array($_SESSION['user']));	
				
				foreach($q->fetchAll(PDO::FETCH_OBJ) as $user) {
						
							return $user->id;
						}
						return "Error!";
		      	}				
			
		public static function getUserName($id) {
		    $db = Db::getInstance();			
			$sql = 'SELECT * FROM users WHERE id = ? LIMIT 1';
				$q = $db->prepare($sql);

				$req = $q->execute(array($id));	
				
				foreach($q->fetchAll(PDO::FETCH_OBJ) as $user) {
						
							return $user->user;
						}
						return "Error!";
		      	}		
		
		public static function encryptPassword($password) {
			
			$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
			$salt = sprintf("$2a$%02d$", 10) . $salt;			
			$hash = crypt($password, $salt);
			return $hash;
			
			// Hashing the password with its hash as the salt returns the same hash
			if ( hash_equals($hash, crypt($password, $hash)) ) {
				return $hash;
			}
		}
	}	
