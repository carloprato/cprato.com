<?php
	
	class BlogController extends BaseController {
		
		//
		//
		//
		//
		
		function index() {

			$this->list_posts();
         
		}

		function list_posts($num = 5) {
			
			global $recent_posts;

			$sql = 'SELECT * FROM posts WHERE status = 1 ORDER BY date_created DESC LIMIT 3';
			$q = $this->db->prepare($sql);
			$req = $q->execute();	
			$recent_posts = array();	
			foreach($q->fetchAll(PDO::FETCH_ASSOC) as $post) {
				$recent_posts[] = $post;
		    }
					
			return $recent_posts;
		}
	
		function view_post($id) {


			/// !!! only one URL should be processed instead of both short_title and post id.
			$sql = 'SELECT * FROM posts WHERE short_title = ? OR id = ?';
				$q = $this->db->prepare($sql);
				$req = $q->execute(array($_GET['arg'], $_GET['arg']));	

				foreach($q->fetchAll(PDO::FETCH_OBJ) as $post) {
					
		 		 $this->tpl->set("post_title", $post->title);
		 		 $this->tpl->set("short_title", $post->short_title);
		 		 $this->tpl->set("post_date", date("H:m, d-m-Y", strtotime($post->date_created)));
		 		 $this->tpl->set("post_id", $post->id);
				 $this->tpl->set("post_content", $post->content);
			 	 $this->tpl->set("comments_list", $this->view_comments($post->id)); 		
		      	}		   
		}
		
		function view_comments($id) {

			global $comments;
			
			$sql = 'SELECT 
				comments.id, 
				comments.post_id, 
				comments.content, 
				comments.date_created, 
				users.user,
				users.name
				FROM comments 
				INNER JOIN users 
				ON comments.author = users.id 
				AND comments.post_id = ? 
				ORDER BY date_created DESC
			';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($id));	
			$comments = array();	
			foreach($q->fetchAll(PDO::FETCH_OBJ) as $comment) {
				$comments[] = $comment;
		    }
		}

		function add() {
			
			Auth::protect(100);
			
			if (isset($_POST['submit_button'])) {	
												

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
			}			
			
			function add_comment($post_id) {
				// ??? Redirect immediately after insertion
				// ??? Ask to log in if the user is not yet logged in
				
				Auth::protect(10);
				if (isset($_POST['submitComment'])) {
					
					$this->db = Db::getInstance();
					$sql = 'INSERT INTO `comments`(`id`, `post_id`, `author`, `content`, `date_created`, `status`) VALUES (?, ?, ?, ?, ?, ?)';
					$q = $this->db->prepare($sql);						
					$req = $q->execute(array(
							NULL,
							$post_id, 
							Auth::getUserID(), 
							$_POST['comment_content'], 
							date("Y-m-d H:i:s"), 
							1
							));
					// ?!?				
					header('Location: /' . $_GET['lang'] . "/blog/view_post/" . $post_id);
				}

			}
			
			static public function shorten($text)
			{ 
			  // replace non letter or digits by -
			  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
			
			  // trim
			  $text = trim($text, '-');
			
			  // transliterate
			  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
			
			  // lowercase
			  $text = strtolower($text);
			
			  // remove unwanted characters
			  $text = preg_replace('~[^-\w]+~', '', $text);
			
			  if (empty($text))
			  {
			    return 'n-a';
			  }
			
			  return $text;
			}		
		
		}