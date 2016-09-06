<?php
	
	Class MidiModel extends BaseModel {
		
		function getMidiList($limit = NULL, $order = NULL) {	
			$sql = 'SELECT * FROM midi ' . $order . ' ' . $limit;
			$q = $this->db->prepare($sql);
			$req = $q->execute();	
            $midis = array();
            $i = 0;	
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $midi) {
				$midis[] = $midi;
				$slug = $this->slug($midis[$i]['artist'], $midis[$i]['title']);
				$midis[$i]['slug'] = $slug;
				$midis[$i]['rank'] = $i + 1;
		        $i++;
            }
			return $midis;
		}

		function getMidi($id) {	
			$sql = 'SELECT * FROM midi WHERE id = ? ORDER BY id';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($id));	
			$midis = array();
			$i = 0;	
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $midi) {
                $midis[] = $midi;
				$midis[$i]['slug'] = $this->slug($midis[$i]['artist'], $midis[$i]['title']);
				if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/res/images/albums/" . $id . ".jpg"))
					 {
							$midis[$i]['image'] =  $midis[$i]['id'];
					}	else {	
							$midis[$i]['image'] = 'default';
					} 		
					 
				$i++;
			}
			return $midis;
		}

		function getNewMidi() {	
			$sql = 'SELECT * FROM midi ORDER BY id DESC LIMIT 4';
			$q = $this->db->prepare($sql);
			$req = $q->execute();	
            $midis = array();
            $i = 0;	
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $midi) {
				$midis[] = $midi;
  				$slug = $this->slug($midis[$i]['artist'], $midis[$i]['title']);              
                $midis[$i]['slug'] = $slug;
				$midis[$i]['rank'] = $i + 1;
		        $i++;
            }
			return $midis;
		}

		function search($keyword) {

			$sql = 'SELECT * FROM midi WHERE artist LIKE ? OR title LIKE ?';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array("%".$keyword."%", "%".$keyword."%"));	
            $midis = array();
            $i = 0;	
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $midi) {
				$midis[] = $midi;
  				$slug = $this->slug($midis[$i]['artist'], $midis[$i]['title']);              
                $midis[$i]['slug'] = $slug;
		        $i++;
            }
			return $midis;			
		}

		function insert($json, $file) {

			echo $json->results[0]->id . "<br>";
			echo $json->results[0]->name . "<br>";
			echo $json->results[0]->mixName . "<br>";
			echo $json->results[0]->releaseDate . "<br>";
			echo $json->results[0]->bpm . "<br>";
			echo $json->results[0]->key->standard->letter . $json->results[0]->key->standard->sharp .$json->results[0]->key->standard->flat . $json->results[0]->key->standard->chord ."<br>";
			echo $json->results[0]->genres[0]->name . "<br>";
			echo $json->results[0]->label->name . "<br>";
			echo $json->results[0]->dynamicImages->main->url . "<br>";
		}

		function slug($artist, $title) {

	            $midi_name = $artist . '-' . $title;
                $midi_name = strtolower($midi_name);
                $midi_name = preg_replace("/[^a-z0-9_\s-]/", "", $midi_name);
                //Clean up multiple dashes or whitespaces
                $midi_name = preg_replace("/[\s-]+/", " ", $midi_name);
                //Convert whitespaces and underscore to dash
                $midi_name = preg_replace("/[\s_]/", "-", $midi_name);
                $slug = $midi_name;
                return $slug;
		}

		function getBeatport($id) {

				/**
				* Beatport OAuthConnect by Tim Brandwijk - posted in groups.google.com/forum/#!forum/beatport-api
				*
				* Needs this beatport_callback.php script to work:
				*  <?php
						$credentials = array();
						foreach ($_GET as $key => $value) {
							$credentials[$key] = $value;
						}
						if (!empty($credentials)) print json_encode($credentials);
					?>
				*/

				date_default_timezone_set('Europe/Paris');

				// Beatport URLs. Note the oauth_callback after the request url. This is needed to catch the verifier string:
				$req_url = 'https://oauth-api.beatport.com/identity/1/oauth/request-token?oauth_callback='.urlencode('http://localhost/beatport_callback.php');
				$authurl = 'https://oauth-api.beatport.com/identity/1/oauth/authorize';
				$auth_submiturl = "https://oauth-api.beatport.com/identity/1/oauth/authorize-submit";
				$acc_url = 'https://oauth-api.beatport.com/identity/1/oauth/access-token';

				// !!! Login details
					$conskey = BP_KEY;
					$conssec = BP_SECRET;
					$beatport_login = BP_USER;
					$beatport_password = BP_PASSWORD;
					
				/**
				* Step 1: Get a Request token
				*/
				$oauth = new OAuth($conskey,$conssec);
				$oauth->enableDebug();
				$oauth->disableSSLChecks();
				$oauth->setAuthType(OAUTH_AUTH_TYPE_FORM); // switch to POST request
				$request_token_info = $oauth->getRequestToken($req_url);

				if(!empty($request_token_info)) {
				//   echo 'Received OAuth Request token: ' . $request_token_info['oauth_token']."\n";
				//   echo 'Received OAuth Request token secret: ' . $request_token_info['oauth_token_secret']."\n";
				} else {
					print "Failed fetching request token, response was: " . $oauth->getLastResponse();
					exit();
				}

				/**
				* Step 2: Set Request Token to log in
				*/
				$oauth->setToken($request_token_info['oauth_token'],$request_token_info['oauth_token_secret']);

				/**
				* Step 3: Use request token to log in and authenticate for 3-legged auth. The response (via callback URL in $req_url) contains the OAuth token and verifier
				*/
				ini_set('max_execution_time', 500);
				$submit = "Login";
				$url = $auth_submiturl;

				$curl_connection_bp = curl_init();
				curl_setopt($curl_connection_bp, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl_connection_bp, CURLOPT_URL, $url);
				curl_setopt($curl_connection_bp, CURLOPT_CONNECTTIMEOUT, 0);
				curl_setopt($curl_connection_bp, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT6.0; en-US; rv:1.8.1.11) Gecko/20071127 Firefox/2.0.0.11");
				curl_setopt($curl_connection_bp, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
				curl_setopt($curl_connection_bp, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl_connection_bp, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($curl_connection_bp, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($curl_connection_bp, CURLOPT_VERBOSE, false); // when true, this outputs the oauth_token and oauth_verifier value that are posted to the callback URL
				curl_setopt($curl_connection_bp, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
				curl_setopt($curl_connection_bp, CURLOPT_REFERER, $curl_connection_bp);
				curl_setopt($curl_connection_bp, CURLOPT_FAILONERROR, 0);
				$post_string = 'oauth_token='.$request_token_info['oauth_token'] . '&username=' . $beatport_login . '&password=' . $beatport_password . '&submit=Login';
				curl_setopt($curl_connection_bp, CURLOPT_POST, true);
				curl_setopt($curl_connection_bp, CURLOPT_POSTFIELDS, $post_string);
				$beatport_response = curl_exec($curl_connection_bp);

				$beatport_response = json_decode($beatport_response);

				//print_r($beatport_response);

				/**
				* Step 4: Use verifier string to request the Access Token
				*/
				$get_access_token = $oauth->getAccessToken($acc_url, "", $beatport_response->oauth_verifier);
				if(!empty($get_access_token)) {
				//    print_r($get_access_token);
				} else {
					print "Failed fetching access token, response was: " . $oauth->getLastResponse();
					exit();
				}

				/** 
				* Step 5: Set Access Token for further requests
				*/
				$oauth->setToken($get_access_token['oauth_token'],$get_access_token['oauth_token_secret']);

				/**
				* Step 6: Test request.
				*/
				$oauth->fetch('https://oauth-api.beatport.com/catalog/3/tracks', array('id'=>$id));
				return	$json = json_decode($oauth->getLastResponse());

		}

		function upload() {

			$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/midi/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$error = 0;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			if($imageFileType != "mid") {
				return array('error'=>"Sorry, only .mid files are allowed.");
				$uploadOk = 0;
			}
			if ($uploadOk == 0) {
				return "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					return "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				} else {
					return "Sorry, there was an error uploading your file.";
				}
			}

		}
		function generateKey($time) {

			$key = base64_encode(date("d/m/Y H:i"));
			return preg_replace("/[^A-Za-z0-9 ]/", '', $key);
		}

		function isKeyValid($key) {

			$time = 300; // Seconds of validity of the link
			$key_decoded = base64_decode($key."==");
			
			if (strtotime(date("d/m/Y H:i"))-strtotime($key_decoded) < $time) {
				return TRUE;
			} else return FALSE;
		}
	}