<?php
	
	class ForumController extends BaseController {
				
		function index() {
			
			Auth::authorise(array("user"), true);
			
			$topic = new TopicModel;
			$topics = $topic->getTopicList();
			TemplateController::set("topics", $topics);
 			
		}
		
		function add() {
			
			Auth::authorise(array("user"), true);
			
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
			
			header("Location: /en/forum");
		}		
			
		function view_topic($id, $page = 1) {
		
			Auth::authorise(array("user"), true);

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
			
			Auth::authorise(array("user"), true);
			
			if (isset($_POST['submitReply'])) {
			
				if (strlen($_POST['reply_content']) < 5) {
					
					$errors[]['error'] = 'The reply is too short.';
				}
				
				if (empty($errors)) {
							
					$topic = new TopicModel;
					$last_id = $topic->add_reply();
					
					TemplateController::set("errors", 0);					
					TemplateController::set("topic_id", $this->arg);
					header("Location: /" . $_GET['lang'] . "/forum/view_topic/" . $this->arg . "/#reply" . $last_id);
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
			
			Auth::authorise(array("user"), true);
			// Spaghetti
			
				if (!Auth::authorise(array("moderator"))) {
					$author = 'AND author = '. $_SESSION['user_id'];
				} else { $author = NULL; }
				
				$sql = 'DELETE FROM `forum_replies` WHERE id = ?' . $author;
				$q = $this->db->prepare($sql);						
				$req = $q->execute(array(
					$id
					));							
		}	
		
		function edit($id) {
			  
			Auth::authorise(array("user"), true);	  

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
			// Spaghetti  
			if (!Auth::authorise(array("moderator"))) {
				$author = 'AND author = '. $_SESSION['user_id'];
			} else { $author = NULL; }
			
			$sql = '
				SELECT *
				FROM forum_replies 
				WHERE forum_replies.id = ?
			' . $author;			  
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($id));	
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $reply) {
				$edit_reply[] = $reply;	
	      	}		

			  TemplateController::set("edit_reply", $edit_reply);	
		}
	}