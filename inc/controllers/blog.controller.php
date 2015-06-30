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

		public static function list_posts($num = 5) {
			
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
			$sql = 'SELECT * FROM posts WHERE short_title = ?';
				$q = $db->prepare($sql);
				$req = $q->execute(array($_GET['arg']));	

				foreach($q->fetchAll(PDO::FETCH_OBJ) as $post) {
				 $tpl = new TemplateController;
		 		 $tpl->set("post_title", $post->title);
		 		 $tpl->set("short_title", $post->short_title);
		 		 $tpl->set("post_date", date("H:m, d-m-Y", strtotime($post->date_created)));
		 		 $tpl->set("post_id", $id);
				 $tpl->set("post_content", $post->content);
			 	 $tpl->set("comments_list", $this->view_comments($post->id)); 		

		      	}		   
		}
		

		
		static function view_comments($id) {


			global $tpl;
			global $comments;
			
			$db = Db::getInstance();
			$sql = 'SELECT * FROM comments WHERE status = 1 and post_id = ? ORDER BY date_created DESC';
			$q = $db->prepare($sql);
			$req = $q->execute(array($id));	
			$comments = array();	
				foreach($q->fetchAll(PDO::FETCH_OBJ) as $comment) {
					$comments[] = $comment;
		      	}
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
									BlogController::shorten($_POST['post_title']),
									date("Y-m-d H:i:s"), 
									date("Y-m-d H:i:s"), 
									1
									));
									
							$success = "Successfully registered";
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