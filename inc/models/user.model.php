<?php
	
	class UserModel extends BaseModel {
		
		function add($user_details) {
		
			echo "This will be the e-mail's content:<br/><br/>" .
			 	 "Hello, " . $user_details->user . ". You are receiving this e-mail because you need to confirm you are the owner of the account. Your code is " . md5($user_details->email);
			$sql = 'INSERT INTO `users`(`id`, `user`, `fb_user`, `password`, `name`, `email`, `verified`, `privileges`, `date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
			$q = $this->db->prepare($sql);						
			$req = $q->execute(array(NULL, $user_details->user, $user_details->fb_user, Auth::encryptPassword($user_details->password), $user_details->name, $user_details->email, 0, 1, date("Y-m-d H:i:s")));

		}
		
		function getById($id) {
			
			$sql = 'SELECT * FROM `users` WHERE id = ?';
			$q = $this->db->prepare($sql);						
			$req = $q->execute(array($id));
			$user_data  = $q->fetch(PDO::FETCH_OBJ);
			return $user_data;
		}
		
		function getByUser($user) {
			
			$sql = 'SELECT * FROM `users` WHERE user = ?';
			$q = $this->db->prepare($sql);						
			$req = $q->execute(array($user));
			$user_data  = $q -> fetch(PDO::FETCH_OBJ);
			return $user_data;
		}
		
		function getByEmail($email) {
			
			$sql = 'SELECT * FROM `users` WHERE email = ?';
			$q = $this->db->prepare($sql);						
			$req = $q->execute(array($email));
			$user_data  = $q->fetch(PDO::FETCH_OBJ);
			return $user_data;
		}
		
		function acceptUser($id) {

			$sql = '
				UPDATE `users` SET `verified` = ? WHERE id = ?
			';

			$q = $this->db->prepare($sql);						
			$req = $q->execute(array(
				1,
				$id
			));		
			
		}
		
		function refuseUser($id) {

			$sql = '
				UPDATE `users` SET `verified` = ? WHERE id = ?
			';

			$q = $this->db->prepare($sql);						
			$req = $q->execute(array(
				-1,
				$id
			));		
			
		}
		
		function list_all() {

			$sql = 'SELECT * FROM `users`';
			$q = $this->db->prepare($sql);						
			$req = $q->execute();			
			$i = 0;
			foreach($q->fetchAll(PDO::FETCH_OBJ) as $single_user) {

					$user_list[$i] = $single_user;
					$user_list[$i]->role = Auth::roles($user_list[$i]->privileges);
					$i++;
				}
			return $user_list;						
		}
		
		function getPending() {

			$sql = 'SELECT * FROM `users` WHERE verified = ?';
			$q = $this->db->prepare($sql);						
			$req = $q->execute(array(0));			
			$i = 0;
			foreach($q->fetchAll(PDO::FETCH_OBJ) as $single_user) {

					$user_list[$i] = $single_user;
					$user_list[$i]->role = Auth::roles($user_list[$i]->privileges);
					$i++;
				}
			return $user_list;				
			
		}
		
		function roles($id) {
			
			$roles = array(
				100	=> "admin",
				90	=> "editor",
				80 	=> "moderator",
				70	=> "author",
				60  => "translator",
				50  => "user",
				10	=> "new_user",
				0	=> "guest"
			);

			$user = new UserModel;
			$role = array();
			$role['privileges'] = (int) $user->getById($id)->privileges;
			$role['name'] = $role['privileges'];
			$role['name'] = ucwords($role['name']);
			return $role;
		}
		
		function remove() {
			
		}
		
		function update($user_details) {

			$user = new UserModel;
			if (!empty($user_details['new_password'])) {
				$user_details['new_password'] = Auth::encryptPassword($user_details['new_password']);	
			}

			$fields_to_update = array(
				'name' => 'new_name',				
				'password' => 'new_password',
				'email' => 'new_email',
				'profile_visibility' => 'profile_visibility'
			);

			foreach ($fields_to_update as $key => $value) {

			// !!! find better way to give different results if string is empty vs 0
				if (strlen($user_details[$value]) > 0) {
						$sql = '
							UPDATE `users` SET `' . $key . '` = ? WHERE user = ?
			 				';

						$q = $this->db->prepare($sql);						
						$req = $q->execute(array(
							$user_details[$value],
							$_SESSION['user']
						));					
					}
				}
			}
		
		function changePermissions($user_id) {
			//$this->getById($user_id);
			
		}
	}