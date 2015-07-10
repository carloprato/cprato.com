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
			if (!empty($id)) {
				$user_details[] = $user->getById($id);
				$user_details[0]->role = $user->roles($id)['name'];
				TemplateController::set("edit_profile", NULL);	
			} else {				
				$user_details[] = $user->getByUser($_SESSION['user']);
				$user_details[0]->role = $user->roles($_SESSION['user_id'])['name'];
				TemplateController::set("edit_profile", 1);	
			}

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
				
				$_POST['new_password'] = Auth::encryptPassword($_POST['new_password']);				
				$user->update($_POST);
			} else if (isset($_POST['editButton']) && $_POST['new_password'] != $_POST['confirm_password']) {
				
				$edit_profile_errors[]['error'] = "The passwords you entered do not match.";
			}

			$user_details[] = $user->getById($id);
			$user_details[0]->role = $user->roles($id)['name'];			
	
			TemplateController::set("edit_profile_errors", $edit_profile_errors);	
			TemplateController::set("user_details", $user_details);
		}
	}
	
