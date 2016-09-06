<?php
	
	Class SearchModel extends BaseModel {
		
		function results($where) {	
			
			if ($where == 'blog') {
				$table = 'posts';
				$where = $where . "/view_post"; // !!! Quite ugly as well
			} else if ($where == 'forum') {
				$table = 'forum_topics';
				$where = $where . "/view_topic";
			}
			$sql = 'SELECT * FROM ' . $table . ' WHERE content LIKE \'%'. $_POST["search_string"] . '%\' OR title LIKE \'%'. $_POST["search_string"] . '%\'';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array());	
			$search_results = array();	
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $result) {
				$search_results[] = $result;
				$search_results[count($search_results)-1]['where'] = $where; // !!! Fix to understand if searching forum or blog
		    }
			
			return $search_results;
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
			$short_content = strip_tags(substr($_POST['post_content'], 0, 200));
			$sql = 'INSERT INTO `posts`(`id`, `author`, `content`, `short_content`, `title`, `short_title`, `date_created`, `date_modified`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
			$q = $this->db->prepare($sql);						
			$req = $q->execute(array(
				NULL, 
				Auth::getUserID(), 
				$_POST['post_content'], 
				$short_content,
				$_POST['post_title'], 
				BlogController::shorten($_POST['post_title']),
				date("Y-m-d H:i:s"), 
				date("Y-m-d H:i:s"), 
				1
				));
		}
		
		function edit($id) {

			Auth::authorise(array("author", "editor"), true);
			
			$sql = 'UPDATE posts
					SET content = ?'; 
			$update = array($_POST['post_content']);
			
			if (!empty($_POST['post_title'])) {
				
				$sql .= ', title = ?';
				$update[] = $_POST['post_title'];
			}	
			$update[] = $id;
			$sql .= ' WHERE id = ?';	
			$q = $this->db->prepare($sql);						
			$req = $q->execute($update);
					
		}	
		
		function delete($id) {
			
			Auth::authorise(array("author"), true);
			
				$sql = 'DELETE FROM `posts` WHERE id = ?';
				$q = $this->db->prepare($sql);						
				$req = $q->execute(array(
					$id
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