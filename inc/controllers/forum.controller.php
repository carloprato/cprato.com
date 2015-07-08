<?php
	
	class ForumController extends BaseController {
				
		function index() {
			Auth::protect(10);
			
			global $topics;
			
			$topic = new TopicModel;
			$topics = $topic->getTopicList();
			
		}
		
		function add() {
			
			Auth::protect(100);
			
			if (isset($_POST['submit_button'])) {	

				$sql = 'INSERT INTO `forum_topics`(`id`, `author`, `title`, `content`,  `date_created`, `category`) VALUES (?, ?, ?, ?, ?, ?)';
				$q = $this->db->prepare($sql);						
				$req = $q->execute(array(
					NULL, 
					Auth::getUserID(), 
					$_POST['topic_title'], 
					$_POST['topic_content'], 
					date("Y-m-d H:i:s"), 
					1
					));
				$topic_id = $this->db->lastInsertId();
				$sql = 'INSERT INTO `forum_replies`(`id`, `author`, `content`,  `date_created`, `topic`) VALUES (?, ?, ?, ?, ?)';
				$q = $this->db->prepare($sql);						
				$req = $q->execute(array(
					NULL, 
					Auth::getUserID(), 
					$_POST['topic_content'], 
					date("Y-m-d H:i:s"), 
					$topic_id
					));
				// ?!?		
				header('Location: /' . $_GET['lang'] . "/forum");
			}	
		}		
			
		function view_topic($id, $page = 1) {
			
			// !!! This function is ugly please fix
		
			Auth::protect(10);
			global $topics;
			global $replies;
			global $pagination;		

			$topic = new TopicModel;
			$replies = array();
			$replies = $topic->getTopic();

		}		
		
		function add_reply($topic_id) {
			// ??? Redirect immediately after insertion
			
			Auth::protect(10);
			if (isset($_POST['submitReply'])) {
				
				$sql = 'INSERT INTO `forum_replies`(
				`id`, 
				`author`,
				`content`, 
				`date_created`, 
				`topic`
				) VALUES (?, ?, ?, ?, ?)';
				$q = $this->db->prepare($sql);						
				$req = $q->execute(array(
					NULL,
					Auth::getUserID(), 
					$_POST['reply_content'], 
					date("Y-m-d H:i:s"), 
					$this->arg
					));
				// ?!?				
				header('Location: /' . $_GET['lang'] . "/forum/view_topic/" . $this->arg);
			}
		}	
		
		function delete($id) {
			
			Auth::protect(10);				
				$sql = 'DELETE FROM `forum_replies` WHERE id = ? AND author = ?';
				$q = $this->db->prepare($sql);						
				$req = $q->execute(array(
					$id,
					$_SESSION['user_id']
					));							
		}	
		
		function edit($id) {
		
			global $edit_reply;
			$sql = 'SELECT *
				FROM forum_replies 
				WHERE forum_replies.id = ?
			';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($id));	
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $reply) {
				$edit_reply[] = $reply;	
	      	}				
		}
	}