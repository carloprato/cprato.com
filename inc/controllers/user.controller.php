<?php
	
	class UserController extends BaseController {
		
		function list_all() {
			
			Auth::authorise(array("moderator"), true);
			
			$user = new UserModel;
			$user_list = $user->list_all();
			TemplateController::set("user_list", $user_list);
			
		}
		
		function manage() {
		
			Auth::authorise(array("moderator"), true);
			$user = new UserModel;
			$user_list = $user->getPending();

			TemplateController::set("user_list", $user_list);				

		}

		function accept($id) {
			
			Auth::authorise(array("moderator"), true);			
			$user = new UserModel;
			$user->acceptUser($id);
			$user_data = $user->getById($id);
			
				$headers   = array();
				$headers[] = "MIME-Version: 1.0";
				$headers[] = "Content-type: text/plain; charset=iso-8859-1";
				$headers[] = "From: Sender Name <selfhelp@bipolarmalta.org>";
				$headers[] = "Reply-To: Recipient Name <" . $user_data->email .">";
				$headers[] = "Subject: Welcome to Bipolar Malta!";
				$headers[] = "X-Mailer: PHP/".phpversion();
	
				mail($user_data->email, 'Welcome to Bipolar Malta!', 'You can now join our forum and start discussing with our members!', implode("\r\n", $headers));

			header("Location: /en/user/manage");
		}

		function refuse($id) {
			
			$user = new UserModel;
			$user->refuseUser($id);
			header("Location: /en/user/manage");
		}
				
		function confirm($code) {
			
			$sql = 'UPDATE `users` SET verified = 1 WHERE verified = ?';
			$q = $this->db->prepare($sql);						
			$req = $q->execute(array($code));

		}
				
		function profile($id) {
			
			Auth::authorise(array("user"), true);
			
			$user = new UserModel;
			if (!empty($id) && $id != $_SESSION['user_id']) {
				$user_details[] = $user->getById($id);
				$user_details[0]->role = Auth::roles($user_details[0]->privileges);
				TemplateController::set("edit_profile", NULL);	

			} else {	
				$user_details[] = $user->getByUser($_SESSION['user']);
				$user_details[0]->role = Auth::roles();
				TemplateController::set("edit_profile", 1);	
			}

			$user_details[0]->date = date("d/m/Y", strtotime($user_details[0]->date));
			
			if (!(VISIBLE_NAME & $user_details[0]->profile_visibility) && $user_details[0]->id != $_SESSION['user_id'] && !Auth::authorise(array("admin", "moderator"))) {
				
				$user_details[0]->name = "Hidden";
			}
			
			if (!(VISIBLE_EMAIL & $user_details[0]->profile_visibility) && $user_details[0]->id != $_SESSION['user_id'] && !Auth::authorise(array("admin", "moderator"))) {
				
				$user_details[0]->email = "Hidden";
			}
						
			TemplateController::set("user_details", $user_details);
		}
		
		function edit_profile($id) {
			
			Auth::authorise(array("user"), true);
			
			if (!empty($_POST['editButton'])) {
				$profile_visibility = 3;
	
				foreach($_POST['profile_visibility'] as $hidden) {
					
					$profile_visibility = $profile_visibility - $hidden;
				}
				
				$_POST['profile_visibility'] = $profile_visibility;
				
			}
			
			if (Auth::authorise(array("admin")) != true || $id == NULL) {				
				$id = $_SESSION['user_id'];
			}
				
			$user = new UserModel;
			$edit_profile_errors = array();
			
			if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {	
				if (isset($_POST['editButton']) && $_POST['new_password'] == $_POST['confirm_password']) {
	
					$user->update($_POST);
				} else if (isset($_POST['editButton']) && $_POST['new_password'] != $_POST['confirm_password']) {
					
					$edit_profile_errors[]['error'] = "The passwords you entered do not match.";
				}
			}
			if (!empty($_FILES['profile_image']['name'])) {
				

				$target_dir =  $_SERVER['DOCUMENT_ROOT']  . "/data/res/images/users/";
				$target_file = $target_dir . $_SESSION['user_id'] . ".jpg";
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image

				    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
				    if($check !== false) {

				        $uploadOk = 1;
				    } else {
				        echo "File is not an image.";
				        $uploadOk = 0;
				    
				}	
				
				// Check if file already exists

					// Check file size
					if ($_FILES["profile_image"]["size"] > 500000) {
					    echo "Sorry, your file is too large.";
					    $uploadOk = 0;
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
					    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					    $uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
					    echo "Sorry, your file was not uploaded.";
					// if everything is ok, try to upload file
					} else {
				
				        $maxDim = 100;
				        list($width, $height, $type, $attr) = getimagesize( $_FILES['profile_image']['tmp_name'] );
				        if ( $width > $maxDim || $height > $maxDim ) {
				            $target_filename = $_FILES['profile_image']['tmp_name'];
				            $fn = $_FILES['profile_image']['tmp_name'];
				            $size = getimagesize( $fn );
				            $ratio = $size[0]/$size[1]; // width/height
				            if( $ratio > 1) {
				                $width = $maxDim;
				                $height = $maxDim/$ratio;
				            } else {
				                $width = $maxDim*$ratio;
				                $height = $maxDim;
				            }
				            $src = imagecreatefromstring( file_get_contents( $fn ) );
				            $dst = imagecreatetruecolor( $width, $height );
				            imagecopyresampled( $dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
				            imagedestroy( $src );
				            imagepng( $dst, $target_filename ); // adjust format as needed
				            imagedestroy( $dst );
				        }
						
					    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {

			
						} else {
					        echo "Sorry, there was an error uploading your file.";
					    }
					}

			}
			
			
			$user_details[] = $user->getById($id);
			$user_details[0]->role = Auth::roles();

			if((VISIBLE_EMAIL & $user_details[0]->profile_visibility) == 0) $user_details[0]->email_visibility = 'checked';
			if((VISIBLE_NAME & $user_details[0]->profile_visibility) == 0) $user_details[0]->name_visibility = 'checked';
			if (1 == 2 && !empty($user_details[0]->fb_user)) { // Enabled editing for all accounts
				$input_disabled = "disabled";
			} else $input_disabled = NULL;
			
			TemplateController::set("input_disabled", $input_disabled);
			TemplateController::set("edit_profile_errors", $edit_profile_errors);	
			TemplateController::set("fb_user", $user_details[0]->fb_user);	
			TemplateController::set("user_details", $user_details);
			
		}
	}
	