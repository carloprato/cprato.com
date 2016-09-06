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

				} else TemplateController::set("success", FALSE);				

				
				TemplateController::set("registration_errors", $registration_errors);
				return $registration_errors;	
		}

		public static function index() {
			
 
		}
				
		function login() {
			
			$auth = new Auth;
			$user = $auth->login($_POST['user'], $_POST['password']); // Returns user's details on success, false on failure

			if ($user != FALSE) {

				$_SESSION['privileges'] = $user['privileges'];
				$_SESSION['user_id'] = $user['id'];	
				$_SESSION['user'] = $user['user'];				
				$_SESSION['name'] = $user['name'];

			} else {
				
				
			}
		}
		
		function logout() {
				
			return Auth::logout();	
			
		}
		
		function facebook($callback = false) {
		
				$fb = new Facebook\Facebook([
				  'app_id' => '437069579659215',
				  'app_secret' => '3a2a21410ab20e786e876b67a5ee9fc4',
				  'default_graph_version' => 'v2.2',
				  ]);


				$helper = $fb->getRedirectLoginHelper();

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
					if ($helper->getError()) {
						header('HTTP/1.0 401 Unauthorized');
						echo "Error: " . $helper->getError() . "\n";
						echo "Error Code: " . $helper->getErrorCode() . "\n";
						echo "Error Reason: " . $helper->getErrorReason() . "\n";
						echo "Error Description: " . $helper->getErrorDescription() . "\n";
					} else {
						header('HTTP/1.0 400 Bad Request');
						echo 'Bad request';
					}
					exit;
				}

				// Logged in
				echo '<h3>Access Token</h3>';
				var_dump($accessToken->getValue());

				// The OAuth 2.0 client handler helps us manage access tokens
				$oAuth2Client = $fb->getOAuth2Client();

				// Get the access token metadata from /debug_token
				$tokenMetadata = $oAuth2Client->debugToken($accessToken);
				echo '<h3>Metadata</h3>';
				var_dump($tokenMetadata);

				// Validation (these will throw FacebookSDKException's when they fail)
				$tokenMetadata->validateAppId(437069579659215); // Replace {app-id} with your app id
				// If you know the user ID this access token belongs to, you can validate it here
				//$tokenMetadata->validateUserId('123');
				$tokenMetadata->validateExpiration();

				if (! $accessToken->isLongLived()) {
					// Exchanges a short-lived access token for a long-lived one
					try {
						$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
					} catch (Facebook\Exceptions\FacebookSDKException $e) {
						echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
						exit;
					}

					echo '<h3>Long-lived</h3>';
					var_dump($accessToken->getValue());
				}

				$_SESSION['fb_access_token'] = (string) $accessToken;

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');
				 /*
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
				$user_details->password = FB_PASSWORD;
				$user_details['password'] = FB_PASSWORD;
				$user_details['confirm_password'] = FB_PASSWORD;
				$user_details['invitation_code'] = 'selfhelp2015';
				$auth = new Auth;
				if (Auth::validate($user_details) == NULL) {
					$user->add($user_details);
					
					$auth->login($user_details->user, $user_details->password);

				} else {
					echo $user_details->user; echo $user_details->password;
					$auth->login($user_details->user, $user_details->password);	
					
				}
							$user_profile[] = $user_details;
*/
							TemplateController::set("user_details", $user_profile);				
			}	

		}