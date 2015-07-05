<?php
	
	class Auth {
		
		const USER = "1";
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
							$_SESSION['privileges'] = $user['privileges'];
							$_SESSION['user'] = $_POST['user'];
							$_SESSION['user_id'] = $user['id'];
						}
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
