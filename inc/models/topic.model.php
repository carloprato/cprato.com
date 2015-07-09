<?php
	
	class TopicModel extends BaseModel {
		
		function getTopic() {
			
			// !!! Short term fix, please fix in the router instead
			if ($this->arg2 == 0) {
				$this->arg2 = 1;
			}	
			$this->db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );			
			$sql = 'SELECT 
				forum_replies.id as reply_id, 
				forum_replies.author,
				forum_replies.content, 
				forum_replies.date_created, 
				forum_replies.topic as topic_id,
				users.id as user_id,
				users.user,
				users.name
				FROM forum_replies 
				INNER JOIN users 
				ON forum_replies.topic = ?
				AND users.id = forum_replies.author 
				ORDER BY date_created ASC
				LIMIT ?, 5
			';
				$q = $this->db->prepare($sql);
				
				$pages = intval(5 * $this->arg2)-5;

				$req = $q->execute(array($_GET['arg'], $pages));

				$i = 0;
				foreach($q->fetchAll(PDO::FETCH_ASSOC) as $reply) {

					$replies[$i] = $reply;
		      		$replies[$i]['count_posts']	= $this->countUserPosts($replies[$i]['user_id']);
					$i++;
				}	

			return $replies;
		}
		
		function getTopicList() {
			
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
			$q = $this->db->prepare($sql);
			$req = $q->execute();	
			$recent_posts = array();	
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $topic) {
				$topics[] = $topic;
		    }					
			return $topics;
		}
						
		function getTopicTitle($topic_id) {		

			$sql = '
			SELECT 
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
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($_GET['arg']));
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $topic) {
				 $topic_title = $topic['title'];	 
	      	}	
			  return $topic_title;
		}	

		function add() {
			
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
		}
		
		function countUserPosts($user) {
			
			$sql = 'SELECT COUNT(*) as count_posts FROM forum_replies WHERE author = ?';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($user));	
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $count_reply) {

				return $count_reply['count_posts'];		 
			}
		}
		
		function pagination($topic_id, $posts_per_page) {
			
			$sql = 'SELECT COUNT(*) as post_number FROM forum_replies WHERE topic = ?';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($topic_id));	
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $count_reply) {
		
				$pages = $count_reply['post_number']/$posts_per_page;
				$pages = ceil($pages);
				$i = 1;
									
				$pagination[] = array(
					"page" => 1,
					"page_name" => 'First',
					"open_b_tag" => NULL,
					"close_b_tag" => NULL						
				);
								
				$i = $this->arg2;
				$lower = $this->arg2 - 5;
				while ($lower <= 0) { $lower++; }
				while ($lower <= $i && $lower > 0) {
					
					if ($this->arg2 == $lower) {
						$open_b_tag = '<span style="font-size:150%"><b>';
						$close_b_tag = '</b></span>';
					} else {
						$open_b_tag = false;
						$close_b_tag = false;
					}
					$pagination[] = array(
						"page" => $lower,
						"page_name" => $lower,
						"open_b_tag" => $open_b_tag,
						"close_b_tag" => $close_b_tag						
					);
					$lower++;			
				}

				$i = $this->arg2 + 5;
				$higher = $this->arg2 + 1;
				while ($higher <= $i && $higher < $pages && $higher > 0) {
					
					if ($this->arg2 == $higher) {
						$open_b_tag = '<span style="font-size:150%"><b>';
						$close_b_tag = '</b></span>';
					} else {
						$open_b_tag = false;
						$close_b_tag = false;
					}
					$pagination[] = array(
						"page" => $higher,
						"page_name" => $higher,
						"open_b_tag" => $open_b_tag,
						"close_b_tag" => $close_b_tag						
					);
					$higher++;					
				}
				
				if ($pages > 1) {				
						if ($this->arg2 == NULL) $this->arg2 = 1;	
						if ($this->arg2 == $i) {
							$open_b_tag = '<span style="font-size:150%"><b>';
							$close_b_tag = '</b></span>';
						} else {
							$open_b_tag = false;
							$close_b_tag = false;
						}
										
					$pagination[] = array(
						"page" => $pages-1,
						"page_name" => 'Last',
						"open_b_tag" => $open_b_tag,
						"close_b_tag" => $close_b_tag						
					);
				}
				return $pagination;
			}
		}
		
		function add_reply() {
			
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
		}
		
		function getData() {
			
	        return $this->db->query('SELECT * FROM forum_replies WHERE id = ' . (int) $id)->fetchObject();
		}
	}	