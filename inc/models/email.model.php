<?php
	class EmailModel extends BaseModel {
				
		function getEmails() {

			$sql = 'SELECT * FROM contact ORDER BY id DESC';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array());	

			foreach($q->fetchAll(PDO::FETCH_OBJ) as $message) {

					$emails[] = $message;
			 }			 
			 return $emails;
		}
		
		function send($email, $name, $content, $date) {

			$user = new EmailModel;
			// !!! Need to filter variables

				$sql = 'INSERT INTO `contact`(`id`, `name`, `email`, `content`, `date`) VALUES (?, ?, ?, ?, ?)';
				$q = $this->db->prepare($sql);						
				$req = $q->execute(array(
					NULL, 
					$name,
					$email,
					$content,
					$date 
					));
			
		}
	}