<?php
	
	class ForumController extends BaseController {
		
		function index() {
			Auth::protect(10);
			
			global $topics;
			
			$db = Db::getInstance();
			$sql = 'SELECT 
				forum_topics.id, 
				forum_topics.author,
				forum_topics.title, 
				forum_topics.content, 
				forum_topics.date_created, 
				users.user,
				users.name
				FROM forum_topics 
				INNER JOIN users 
				ON forum_topics.author = users.id 
				ORDER BY date_created DESC
			';
			$q = $db->prepare($sql);
			$req = $q->execute();	
			$recent_posts = array();	
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $topic) {
				$topics[] = $topic;
		    }
					
			return $topics;
		}
		
		function add() {
			
			Auth::protect(100);
			
			if (isset($_POST['submit_button'])) {	
												
							$db = Db::getInstance();
							$sql = 'INSERT INTO `forum_topics`(`id`, `author`, `title`, `content`,  `date_created`, `category`) VALUES (?, ?, ?, ?, ?, ?)';
							$q = $db->prepare($sql);						
							$req = $q->execute(array(
									NULL, 
									Auth::getUserID(), 
									$_POST['topic_title'], 
									$_POST['topic_content'], 
									date("Y-m-d H:i:s"), 
									1
									));
							$topic_id = $db->lastInsertId();
							$sql = 'INSERT INTO `forum_replies`(`id`, `author`, `content`,  `date_created`, `topic`) VALUES (?, ?, ?, ?, ?)';
							$q = $db->prepare($sql);						
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
			global $template;
			global $pagination;
			
			$db = Db::getInstance();
			$db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );		
			$sql = 'SELECT 
				forum_topics.id, 
				forum_topics.author,
				forum_topics.title, 
				forum_topics.content, 
				forum_topics.date_created, 
				users.user,
				users.name
				FROM forum_topics 
				INNER JOIN users 
				ON forum_topics.id = ?
				ORDER BY date_created DESC
				LIMIT 1
			';
				$q = $db->prepare($sql);

				$req = $q->execute(array($_GET['arg']));

				foreach($q->fetchAll(PDO::FETCH_OBJ) as $topic) {

				 $topics[] = $topic;	
	 
		      	}	
			
			$limit = intval($page*5)-5;
			if ($limit < 0) {
				$limit = 0;
			}
			$sql = 'SELECT *
				FROM forum_replies 
				WHERE forum_replies.topic = ?
				ORDER BY date_created ASC
				LIMIT ?, 5
			';
				$q = $db->prepare($sql);
				$req = $q->execute(array($_GET['arg'], $limit));	

				foreach($q->fetchAll(PDO::FETCH_ASSOC) as $reply) {

					$replies[] = $reply;	
					$replies[count($replies)-1]['user'] = Auth::getUserName($replies[count($replies)-1]['author']);
  					
					$tpl = new TemplateController;
  		 			$tpl->set("id", $topic->id);
											  					
		      	}				  
						$sql = 'SELECT COUNT(*) AS count FROM forum_replies WHERE topic = ?';
						  
						$q = $db->prepare($sql);
						$req = $q->execute(array($topic->id));	
		
						$elements = 5;
						if (isset($_GET['arg2'])) {
						$page = $_GET['arg2'];
						} else { $page = 1; }
						foreach($q->fetchAll(PDO::FETCH_ASSOC) as $reply) {

							$pages = ceil($reply['count'] / $elements);
							
							$i = 1;
							while ($i <= $pages) {

								$pagination[]['page'] = $i;
								$i++;
							}
				      	}

		}		
		
			function add_reply($topic_id) {
				// ??? Redirect immediately after insertion
				// ??? Ask to log in if the user is not yet logged in
				
				Auth::protect(10);
				if (isset($_POST['submitReply'])) {
					
					$db = Db::getInstance();
					$sql = 'INSERT INTO `forum_replies`(
					`id`, 
					`author`,
					`content`, 
					`date_created`, 
					`topic`
					) VALUES (?, ?, ?, ?, ?)';
					$q = $db->prepare($sql);						
					$req = $q->execute(array(
							NULL,
							Auth::getUserID(), 
							$_POST['reply_content'], 
							date("Y-m-d H:i:s"), 
							$topic_id
							));
					// ?!?				
					header('Location: /' . $_GET['lang'] . "/forum/view_topic/" . $topic_id);
				}

			}	
			
			function delete($id) {
			Auth::protect(10);				
					$db = Db::getInstance();
					$sql = 'DELETE FROM `forum_replies` WHERE id = ? AND author = ?';
					$q = $db->prepare($sql);						
					$req = $q->execute(array(
							$id,
							$_SESSION['user_id']
							));							
			}	
			
			function edit($id) {
			
			global $edit_reply;
			$db = Db::getInstance();
			$sql = 'SELECT *
				FROM forum_replies 
				WHERE forum_replies.id = ?
			';
				$q = $db->prepare($sql);
				$req = $q->execute(array($id));	

				foreach($q->fetchAll(PDO::FETCH_ASSOC) as $reply) {

					$edit_reply[] = $reply;	

		      	}	
							
		}
	}
