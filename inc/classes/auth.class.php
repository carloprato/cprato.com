<?php
	
	class Auth {
		

		public static function login($username, $password) {
								
			// Checks if the user exists and if the password is correct, if yes authorizes them.
			//
			//
			//
			//
			
		    $db = Db::getInstance();
			
			if (isset($username) && isset($password)) {
				
				$sql = 'SELECT * FROM users WHERE user = ? LIMIT 1';
				$q = $db->prepare($sql);
				$req = $q->execute(array($username));	
				
				foreach($q->fetchAll(PDO::FETCH_ASSOC) as $user) {

						if ( hash_equals($user['password'], crypt($password, $user['password'])) || Auth::autologin() == true) {
							if ($_POST['remember_me'] == 1) {
								Auth::remember($user['id']);
							}
							return $user;
						}
						return false;
		      	}

				  return false;
				}

				//header("Location: /en/auth/auth");
		 	}
					
		function logout() {
			
			session_destroy();
			setcookie("id", "", time()-3600, "/");
			setcookie("hash", "", time()-3600,  "/");
			header('Location: /en/home');
			
		}
		
		 public static function register() {
			
			if (isset($_POST['submitButton'])) {	
			
				$error = array();
				$user = new UserModel;
				  
				$user_details = array_map('trim', $_POST);

				$error = Auth::validate($user_details);
						
				if (empty($error)) {
					
					$user_details = (object) $user_details;											
					$user->add($user_details);
								
				}
				return $error;
			}						
		}
		
		public static function protect($privileges, $redirect = true) {
			
			if (isset($_SESSION['privileges']) && $_SESSION['privileges'] >= $privileges) {
				
				return true;
			} else if (isset($_SESSION['privileges']) && $_SESSION['privileges'] < $privileges && $redirect == true) {

		 		header("Location: /en/auth");
			} else if ($redirect == false && isset($_SESSION['privileges']) && $_SESSION['privileges'] ) {

				return false;
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
			
				$user = new UserModel;	
				return $user->getByUser($_SESSION['user'])->id;

		      	}				
			
		public static function getUserName($id) {

				$user = new UserModel;	
				return $user->getById($id)->user;

		      	}		
		
		public static function validate($data) {

				$user = new UserModel;
				$username_exists = $user->getByUser($data['user']);
				$email_exists = $user->getByEmail($data['email']);
				
				if (isset($username_exists->user)) {
					
					$error[]['error'] = "{{translate:error_username_taken}}";
				}	
				
				if (isset($email_exists->email)) {
					
					$error[]['error'] = "{{translate:error_email_taken}}";
				}
				
				if (strlen($data['user']) <= 3) {
					
					$error[]['error'] = "Username too short.";
				}
				
				if ($data['password'] != $data['confirm_password']) {
					
					$error[]['error'] = "Passwords do not match.";
				}
				
				if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
					
					$error[]['error'] = "E-Mail not valid.";
				} 
				
				if (!isset($data['name'])) {
					
					$error[]['error'] = "Please insert your name and surname.";
				} 
				
				if ($data['invitation_code'] != 'INVcarlo123') {
					
					$error[]['error'] = "The invitation code is not valid.";
				}
						
			return $error;
		}
		
		public static function encryptPassword($password) {
			
			$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
			$salt = sprintf("$2a$%02d$", 10) . $salt;			
			$hash = crypt($password, $salt);
			return $hash;
			
		}
		
		public static function remember($id) {
				
				setcookie("id", $id, time()+31536000,'/');
				setcookie("hash", sha1(COOKIE_PREFIX . $id), time()+31536000,'/');
			}
		
		public static function autologin() {
		// !!! Fix doubled code (Auth::login())
		
		if (isset($_COOKIE['id']) && isset($_COOKIE['hash'])) {
			$id = $_COOKIE['id'];				  
			$hash = $_COOKIE['hash'];
			
			if ( $hash === sha1(COOKIE_PREFIX . $_COOKIE['id']) )
			{

					$db = Db::getInstance();			
					$sql = 'SELECT * FROM users WHERE id = ? LIMIT 1';
					$q = $db->prepare($sql);
					$req = $q->execute(array($_COOKIE['id']));	
					
					foreach($q->fetchAll(PDO::FETCH_ASSOC) as $user) {
	
						$_SESSION['privileges'] = $user['privileges'];
						$_SESSION['user_id'] = $user['id'];	
						$_SESSION['user'] = $user['user'];
	
			      	}				
			}

			else {

				 setcookie("id", "", time()-3600,  "/");
				 setcookie("hash", "", time()-3600, "/");
				 return false;
				}
			}
		}
	}