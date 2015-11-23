<?php
	
	class Auth extends BaseModel {
		
		const ADMIN_RIGHTS	 	= 32;
		const EDITOR_RIGHTS 	= 16;
		const AUTHOR_RIGHTS		=  8;
		const MODERATOR_RIGHTS  =  4;
		const TRANSLATOR_RIGHTS =  2;
		const USER_RIGHTS		=  1;
			
		public  function login($username, $password) {
								
			// Checks if the user exists and if the password is correct, if yes authorizes them.
			//
			//
			//
			//
			
		    $db = Db::getInstance();
			
			if (isset($username) && isset($password)) {
					
				$sql = 'SELECT * FROM users WHERE user = ? LIMIT 1';
				$q = $this->db->prepare($sql);
				$req = $q->execute(array($username));	
				
				foreach($q->fetchAll(PDO::FETCH_ASSOC) as $user) {

					if (!hash_equals($user['password'], crypt($password, $user['password']))) {
						
						$login_errors[]['error'] = "Username and password do not match, or username is not registered.";
						TemplateController::set("login_errors", $login_errors);											
						return false;
					} else if ($user['verified'] != 1) {
						
						$login_errors[]['error'] = "You have not been accepted yet. Come back later!";
						TemplateController::set("login_errors", $login_errors);											
						return false;
					}

					 else if (Auth::autologin() == true || hash_equals($user['password'], crypt($password, $user['password']))) {
		
						$_SESSION['privileges'] = $user['privileges'];
						$_SESSION['user_id'] = $user['id'];	
						$_SESSION['user'] = $user['user'];
						$_SESSION['name'] = $user['name'];
									
						if (!empty($_POST['remember_me'])) {
							Auth::remember($user['id']);
						}
						
						$login_errors[]['error'] = "Login successful.";
						TemplateController::set("login_errors", $login_errors);																	
						return $user;
					}
					return false;
		      	}
				  return false;
			}
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
				$_POST['fb_user'] = 0;  
				$user_details = array_map('trim', $_POST);

				$error = Auth::validate($user_details);
						
				if (empty($error)) {
					
					$user_details = (object) $user_details;											
					$user->add($user_details);
								
				}
				$user_details = (object) $user_details;
				TemplateController::set("user_wrong_details", $user_details);											
				return $error;
			}						
		}
			
		public static function authorise($role, $redirect = false, $user_permissions = NULL) {
			
			$user_permissions = 0;
			
			if ($user_permissions == NULL) {
				
				$user_permissions = (int) $_SESSION['privileges'];
			}
			
			$permissions = array(
				"admin"			=> self::ADMIN_RIGHTS,
				"editor"		=> self::EDITOR_RIGHTS,
				"author"		=> self::AUTHOR_RIGHTS,
				"moderator"		=> self::MODERATOR_RIGHTS,
				"translator"	=> self::TRANSLATOR_RIGHTS,
				"user"			=> self::USER_RIGHTS
			);
			
			if (is_array($role)) {
				
				foreach ($role as $single_role) {
					
					if (($user_permissions & $permissions[$single_role]) == true) {
						
						return true;
					}
				}				

			} else {
				
				if (($user_permissions & $permissions[$role]) == true) return true;
				
			}
			
			if ($redirect == true) {
				
					header("Location: /en/auth");
			}
				return false;
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
		
		public static function roles($user_privileges = 0) {	
			
			if (empty($user_privileges)) {
				$user_privileges = (object) 0;
				$user_privileges = $_SESSION['privileges'];
			}
							
			$permissions = array(
				"admin"			=> self::ADMIN_RIGHTS,
				"editor"		=> self::EDITOR_RIGHTS,
				"author"		=> self::AUTHOR_RIGHTS,
				"moderator"		=> self::MODERATOR_RIGHTS,
				"translator"	=> self::TRANSLATOR_RIGHTS,
				"user"			=> self::USER_RIGHTS
			);
		
			foreach ($permissions as $key => $value) {
				
				if (($permissions[$key] & $user_privileges) == true) {
					
					return ucwords($key);
				}
			}
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
				
				$error = array();
				
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
				
				if ($data['invitation_code'] != 'selfhelp2015') {
					
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
						$_SESSION['name'] = $user['name'];	
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