<?php
				
				use Facebook\FacebookSession;
				use Facebook\FacebookRedirectLoginHelper;
				use Facebook\GraphUser;
				use Facebook\FacebookRequestException;
				
	class AuthController extends BaseController {
						
		function register() {
			

			$registration_errors = Auth::register();	

				TemplateController::set("error", $registration_errors);	

				if ($registration_errors == NULL && isset($_POST['user'])) {

					TemplateController::set("success", 'The registration was completed successfully.');				

				}
				
				TemplateController::set("registration_errors", $registration_errors);
				return $registration_errors;	

		}

		public static function index() {
			
 
		}
				
		function login() {
			
			global $user;				
			$user = Auth::login($_POST['user'], $_POST['password']); // Returns user's details on success, false on failure
			if ($user != FALSE) {
				$_SESSION['privileges'] = $user['privileges'];
				$_SESSION['user_id'] = $user['id'];	
				$_SESSION['user'] = $user['user'];				
				$_SESSION['name'] = $user['name'];
												
				$this->tpl->set("login", "Login successful.");
			} else {

				$this->tpl->set("login", "Login failed.");				
			}					
		}
		
		function logout() {
				
			return Auth::logout();	
			
		}
		
		function facebook($callback = false) {
		
				$fb = new Facebook\Facebook([
				  'app_id' => '1612484382341510',
				  'app_secret' => '9dc2372e20de05ae4b506402eee57202',
				  'default_graph_version' => 'v2.2',
				  ]);
				 
				if (empty($_SESSION['fb_access_token'])) {	
					# /js-login.php
				
					$helper = $fb->getJavaScriptHelper();
					
					try {
					  $accessToken = $helper->getAccessToken();
					} catch(Facebook\Exceptions\FacebookResponseException $e) {
					  // When Graph returns an error
					  echo 'Graph returned an error: ' . $e->getMessage();
					  exit;
					} catch(Facebook\Exceptions\FacebookSDKException $e) {
					  // When validation fails or other local issues
					  echo 'Facebook SDK returned an error: ' . $e->getMessage();
					  exit;
					}
					
					if (! isset($accessToken)) {
					  echo 'No cookie set or no OAuth data could be obtained from cookie.';
					  exit;
					}
					
					// Logged in
					
					$_SESSION['fb_access_token'] = (string) $accessToken;
					
				}
				
				try {
				  // Returns a `Facebook\FacebookResponse` object
				  $response = $fb->get('/me?fields=id,first_name,last_name,email', $_SESSION['fb_access_token']);
				} catch(Facebook\Exceptions\FacebookResponseException $e) {
				  echo 'Graph returned an error: ' . $e->getMessage();
				  exit;
				} catch(Facebook\Exceptions\FacebookSDKException $e) {
				  echo 'Facebook SDK returned an error: ' . $e->getMessage();
				  exit;
				}
				
				$user_details = $response->getGraphUser();

				$user = new UserModel;
				$random_username = preg_replace("/\@(.*)/i", '', $user_details['email']);
				$user_details['name'] = $user_details['first_name'] . " " . $user_details['last_name'];
				$user_details['user'] = $random_username;
				$user_details['fb_user'] = $user_details['id']; 
				$user_details->name  = $user_details['first_name'] . " " . $user_details['last_name'];
				$user_details->user  = $random_username;
				$user_details->email = $user_details['email'];
				$user_details->fb_user = $user_details['id']; 
				$user_details->password = 'facebook';
				$user_details['password'] = 'facebook';
				$user_details['confirm_password'] = 'facebook';
				$user_details['invitation_code'] = 'selfhelp2015';
				
				if (Auth::validate($user_details) == NULL) {
					$user->add($user_details);
					Auth::login($user_details->user, $user_details->password);
				} else {
					Auth::login($user_details->user, $user_details->password);	
				}
							$user_profile[] = $user_details;
							TemplateController::set("user_details", $user_profile);				
			}	
		}