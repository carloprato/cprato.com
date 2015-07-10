<?php
	
	class ForumController extends BaseController {
				
		function index() {
			Auth::protect(10);
			
			$topic = new TopicModel;
			$topics = $topic->getTopicList();
			TemplateController::set("topics", $topics);
 			
		}
		
		function add() {
			
			Auth::protect(50);
			
			if (isset($_POST['submit_button']))  {	
			
				if (strlen($_POST['topic_title']) < 5) {
					
					$errors[]['error'] = 'The title is too short.';
				}
				
				if (strlen($_POST['topic_content']) < 10) {
					
					$errors[]['error'] = 'The post is too short.';
				}
				
				if (empty($errors)) {
					$topic = new TopicModel;
					$topic->add();
					TemplateController::set("errors", 0);					
				} else {
					TemplateController::set("new_topic_errors", $errors);
					TemplateController::set("errors", 1);
				} 
			} else { 
				TemplateController::set("new_topic_errors", NULL);
				TemplateController::set("errors", 0);
			}
		}		
			
		function view_topic($id, $page = 1) {
		
			Auth::protect(10);

			$topic = new TopicModel;
			$replies = array();
			$replies = $topic->getTopic();

			$pagination = $topic->pagination($id, 5);
			TemplateController::set("replies", $replies);
			TemplateController::set("topic_title", $topic->getTopicTitle($replies[0]['topic_id']));
			TemplateController::set("topic_id", $replies[0]['topic_id']); 		
			TemplateController::set("pagination", $pagination); 		
		}		
		
		function add_reply($topic_id) {
			// ??? Redirect immediately after insertion
			
			Auth::protect(50);
			
			if (isset($_POST['submitReply'])) {
			
				if (strlen($_POST['reply_content']) < 5) {
					
					$errors[]['error'] = 'The reply is too short.';
				}
				
				if (empty($errors)) {
							
					$topic = new TopicModel;
					$topic->add_reply();
					
					TemplateController::set("errors", 0);					
					TemplateController::set("topic_id", $this->arg);
				} else {
					TemplateController::set("new_reply_errors", $errors);
					TemplateController::set("errors", 1);
				} 
			} else { 
				TemplateController::set("new_reply_errors", NULL);
				TemplateController::set("errors", 0);
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
			  
			  if (!empty($_POST['reply_content'])) {
	
				$sql = '
					UPDATE 
					forum_replies 
					SET `content` = ? WHERE forum_replies.id = ?
					LIMIT 1
				';
				$q = $this->db->prepare($sql);
				$req = $q->execute(array($_POST['reply_content'], $id));					  
				  
			  }
			$sql = '
				SELECT *
				FROM forum_replies 
				WHERE forum_replies.id = ?
				AND author = ?
			';			  
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($id, $_SESSION['user_id']));	
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $reply) {
				$edit_reply[] = $reply;	
	      	}		

			  TemplateController::set("edit_reply", $edit_reply);	
		}
	}