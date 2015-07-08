<?php
	
	class TopicModel extends BaseController {
		
		function getTopic() {
			
			$sql = 'SELECT 
				forum_replies.id as reply_id, 
				forum_replies.author,
				forum_replies.content, 
				forum_replies.date_created, 
				users.id as user_id,
				users.user,
				users.name
				FROM forum_replies 
				INNER JOIN users 
				ON forum_replies.topic = ?
				AND users.id = forum_replies.author 
				ORDER BY date_created ASC
			';
				$q = $this->db->prepare($sql);

				$req = $q->execute(array($_GET['arg']));

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

		function countUserPosts($user) {
			
			$sql = 'SELECT COUNT(*) as count_posts FROM forum_replies WHERE author = ?';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($user));	
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $count_reply) {

				return $count_reply['count_posts'];
		 
			}
		}
	}