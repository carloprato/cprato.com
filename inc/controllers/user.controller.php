<?php
	
	class UserController extends BaseController {
		
		function profile($id) {
			
			$user = new UserModel;
			$user_details[] = $user->getById($id);		
			TemplateController::set("user_details", $user_details);
		}
		
		function edit_profile() {
			
			$user = new UserModel;

			if (isset($_POST['editButton']) && $_POST['new_password'] === $_POST['confirm_password']) {
				
				$_POST['new_password'] = Auth::encryptPassword($_POST['new_password']);				
				$user->update($_POST);
			}			
			
			$user_details[] = $user->getById($_SESSION['user_id']);
	
			TemplateController::set("user_details", $user_details);
		}
	}