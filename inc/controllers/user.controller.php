<?php
	
	class UserController extends BaseController {
		
		function list_all() {
			
			Auth::protect(50);
			$user = new UserModel;
			$user_list = $user->list_all();
			TemplateController::set("user_list", $user_list);
		}
		
		function profile($id) {
			
			Auth::protect(10);
			
			$user = new UserModel;
			if (!empty($id) && $id != $_SESSION['user_id']) {
				$user_details[] = $user->getById($id);
				$user_details[0]->role = $user->roles($id)['name'];
				TemplateController::set("edit_profile", NULL);	

			} else {	
				$user_details[] = $user->getByUser($_SESSION['user']);
				$user_details[0]->role = $user->roles($_SESSION['user_id'])['name'];
				TemplateController::set("edit_profile", 1);	
			}

			$user_details[0]->date = date("d/m/Y", strtotime($user_details[0]->date));
			TemplateController::set("user_details", $user_details);
		}
		
		function edit_profile($id) {
			
			Auth::protect(10);
			if (Auth::protect(100, false) != true || $id == NULL) {				
				$id = $_SESSION['user_id'];
			}
				
			$user = new UserModel;
			$edit_profile_errors = array();
			
			if (isset($_POST['editButton']) && $_POST['new_password'] == $_POST['confirm_password']) {

				$user->update($_POST);
			} else if (isset($_POST['editButton']) && $_POST['new_password'] != $_POST['confirm_password']) {
				
				$edit_profile_errors[]['error'] = "The passwords you entered do not match.";
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
			$user_details[0]->role = $user->roles($id)['name'];			
			if (1 == 2 && !empty($user_details[0]->fb_user)) { // Enabled editing for all accounts
				$input_disabled = "disabled";
			} else $input_disabled = NULL;
			
			TemplateController::set("input_disabled", $input_disabled);
			TemplateController::set("edit_profile_errors", $edit_profile_errors);	
			TemplateController::set("fb_user", $user_details[0]->fb_user);	
			TemplateController::set("user_details", $user_details);
			
		}
	}