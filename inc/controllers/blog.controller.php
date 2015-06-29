<?php
	
	class BlogController {
		
		//
		//
		//
		//
		
		function __construct() {
			

		}

		static public function version() {
			
			return "0.0.1";
		}
		
		static public function views_list() {
			
			return array('index', 'list_posts', 'view_post');
		}
		
		static public function description() {
			
			return "Module to display blog posts and comments.";
		}
									
		function index() {
			// List all possible actions related to this module


			$this->list_posts();
         
		}

		function list_posts($num = 5) {
			
			global $recent_posts;
						
			$db = Db::getInstance();
			$sql = 'SELECT * FROM posts WHERE status = 1 ORDER BY date_created DESC LIMIT 3';
				$q = $db->prepare($sql);
				$req = $q->execute();	
			$recent_posts = array();	
				foreach($q->fetchAll(PDO::FETCH_ASSOC) as $post) {
					$recent_posts[] = $post;
		      	}

					
				 return $recent_posts;
					}
	
		function view_post($id) {
		
			$db = Db::getInstance();
			$sql = 'SELECT * FROM posts WHERE id = ?';
				$q = $db->prepare($sql);
				$req = $q->execute(array($_GET['arg']));	
				
				foreach($q->fetchAll(PDO::FETCH_OBJ) as $post) {
				 $tpl = new TemplateController;
		 		 $tpl->set("post_title", $post->title);
		 		 $tpl->set("post_date", date("H:m, d-m-Y", strtotime($post->date_created)));
		 		 $tpl->set("post_id", $id);
				 $tpl->set("post_content", $post->content);
			 	 $tpl->set("comments", $comments); 		

		      	}		   
		}
		
		static function recent_posts($num) {
			
			global $tpl;

			$args=array( 'post_status'=> 'publish', 'numberposts' => $num); 
			$recent_posts = wp_get_recent_posts($args);
			$post_list = NULL;

			$tpl = new TemplateController;

	 		$tpl->set("recent_posts", $post_list); 

			return $post_list;
		}
		
		static function view_comments($id) {
					
			$comments = get_comments('post_id=' . $id);
			$comment_content = array();
			
			foreach($comments as $comment) :
				$comment_content[$comment->comment_ID][comment] = $comment->comment_content;
				$comment_content[$comment->comment_ID][author] = $comment->comment_author;
				$comment_content[$comment->comment_ID][date] = date("H:m, d-m-Y", strtotime($comment->comment_date));
			endforeach;
			
			foreach($comment_content as $comment=>$value) {

				$comment_list .= "<b>$value[author] ($value[date])</b> - $value[comment] <br/>";
			}
			return $comment_list;
		}

		function add() {
			
			if (isset($_POST['submit_button'])) {	
												
							$db = Db::getInstance();
							$sql = 'INSERT INTO `posts`(`id`, `author`, `content`, `short_content`, `title`, `short_title`, `date_created`, `date_modified`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
							$q = $db->prepare($sql);						
							$req = $q->execute(array(
									NULL, 
									Auth::getUserID(), 
									$_POST['post_content'], 
									substr($_POST['post_content'], 0, 200),
									$_POST['post_title'], 
									str_replace(" ", "-", $_POST['post_title']),
									date("Y-m-d H:i:s"), 
									date("Y-m-d H:i:s"), 
									1
									));
									
							$success = "Successfully registered";
				}
			
			}
		
		
		}
