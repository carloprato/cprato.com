<?php
	
	Class PostModel extends BaseModel {
		
		function getLatestPosts($num) {	
			$sql = 'SELECT * FROM posts WHERE status = 1 ORDER BY date_created DESC LIMIT ' . $num;
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($num));	
			$recent_posts = array();	
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $post) {
				$recent_posts[] = $post;
		    }
			return $recent_posts;
		}
		
		function getPost($id) {
			$sql = '
				SELECT 
					posts.id as post_id,
					posts.title as post_title,
					posts.content as post_content,
					posts.date_created as post_date,
					posts.short_title,
					posts.author,
					users.id as user_id,
					users.user	
				FROM posts			
				INNER JOIN users 
				ON (posts.short_title = ?
				OR posts.id = ?)
				AND users.id = posts.author 
				LIMIT 1';
				
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($id, $id));	
			$user = new UserModel;
			foreach($q->fetchAll(PDO::FETCH_OBJ) as $post) {
				$post_content[] = $post;	
			}

			return $post_content;
				  
		}	
		function add() {
			
			// !!! Need to filter variables
			
			$sql = 'INSERT INTO `posts`(`id`, `author`, `content`, `short_content`, `title`, `short_title`, `date_created`, `date_modified`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
			$q = $this->db->prepare($sql);						
			$req = $q->execute(array(
				NULL, 
				Auth::getUserID(), 
				$_POST['post_content'], 
				substr($_POST['post_content'], 0, 200),
				$_POST['post_title'], 
				BlogController::shorten($_POST['post_title']),
				date("Y-m-d H:i:s"), 
				date("Y-m-d H:i:s"), 
				1
				));
		}
			
		function getComments($id) {
			
			$sql = 'SELECT 
				comments.id, 
				comments.post_id, 
				comments.content, 
				comments.date_created,
				comments.author, 
				users.user,
				users.name
				FROM comments 
				INNER JOIN users 
				ON comments.author = users.id 
				AND (
					comments.post_id = ?
					) 
				ORDER BY date_created DESC
			';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($id));	
			$comments = array();	
			foreach($q->fetchAll(PDO::FETCH_OBJ) as $comment) {
				$comments[] = $comment;
		    }

			return $comments;	
		}	 
		
		function addComment() {
			
			$sql = 'INSERT INTO `comments`(`id`, `post_id`, `author`, `content`, `date_created`, `status`) VALUES (?, ?, ?, ?, ?, ?)';
			$q = $this->db->prepare($sql);						
			$req = $q->execute(array(
				NULL,
				$this->arg, 
				Auth::getUserID(), 
				$_POST['comment_content'], 
				date("Y-m-d H:i:s"), 
				1
				));
		}
	}