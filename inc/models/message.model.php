<?php
	class MessageModel extends BaseModel {
		
		function getAllReceived() {
				
			$sql = '
					SELECT DISTINCT sender, recipient FROM messages WHERE (sender = ? OR recipient = ?)
					';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($_SESSION['user_id'], $_SESSION['user_id']));	
			$messages = array();
			$i = 0;
			$user = new UserModel;
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $message) {
				$messages[$i] = $message;
				
				$messages[$i]['sender_user'] = $user->getById($messages[$i]['sender'])->user;	
				
				if (isset($messages[$i]['sender']) && $messages[$i]['sender'] == $_SESSION['user_id']) {
					$messages[$i]['sender_user'] = $user->getById($messages[$i]['recipient'])->user;	
				}
				$i++;
			}

			return $messages;
		}

		function getAllBy($user_id) {
				
			$sql = '
				SELECT messages.*	
				FROM messages
				WHERE
					(recipient = ?
					OR sender = ?) AND
					(recipient = ? OR sender = ?)
				GROUP BY messages.id
				ORDER BY messages.message_date DESC';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($_SESSION['user_id'], $_SESSION['user_id'], $user_id, $user_id));	
			$messages = array();
			$i = 0;
			$user = new UserModel;
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $message) {
				$messages[$i] = $message;
				$messages[$i]['recipient_user'] = $user->getById($messages[$i]['recipient'])->user;
				$messages[$i]['sender_user'] = $user->getById($messages[$i]['sender'])->user;
				$i++;
			}
 
			return $messages;
		}
		
				
		function send() {
			
			$user = new UserModel;
			// !!! Need to filter variables
			if (isset($_POST['submitButton'])) {
				$sql = 'INSERT INTO `messages`(`id`, `sender`, `recipient`, `content`, `message_date`, `read`) VALUES (?, ?, ?, ?, ?, ?)';
				$q = $this->db->prepare($sql);						
				$req = $q->execute(array(
					NULL, 
					Auth::getUserID(),
					$user->getByUser($_POST['recipient'])->id,
					$_POST['content'],
					date("Y-m-d H:i:s"), 
					0
					));
			}
		}
	}