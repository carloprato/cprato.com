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
			
				global $tpl;

						$args=array( 'post_status'=> 'publish', 'numberposts' => $num); 
						$recent_posts = wp_get_recent_posts($args);
						$post_list = NULL;
						foreach( $recent_posts as $recent ){

						if (strlen($recent["post_content"]) > 300)	
							$recent["post_content"] = substr($recent["post_content"], 0, 300) . '...<a href="/' . $_GET[lang] .'/blog/view_post/'. $recent["ID"] . '"> Continue Reading</a>';
				$post_list .= '
                <h3>
					<a href="'. SITE_ROOT . '/' . $_GET[lang] . '/blog/view_post/'. $recent["ID"] . '">
						'. $recent["post_title"].'
					</a>
				</h3>
				
				<p>'. $recent["post_content"] . '
				</p>
				<br/>'; }           
	
		$tpl = new TemplateController;
 		$tpl->set("list_posts", $post_list);  

		   return $post_list;

	}
	
		function view_post($id) {
			
			$post = get_post($id);
			
		 $tpl = new TemplateController;

		echo $comments;
 		 $tpl->set("post_title", $post->post_title);
 		 $tpl->set("post_date", date("H:m, d-m-Y", strtotime($post->post_date)));
 		 $tpl->set("post_id", $id);
		 $comments = BlogController::view_comments($id);
		 $tpl->set("post_content", $post->post_content);
	 	 $tpl->set("comments", $comments); 		

		   
		}
		
		static function recent_posts($num) {
			
			global $tpl;

			$args=array( 'post_status'=> 'publish', 'numberposts' => $num); 
			$recent_posts = wp_get_recent_posts($args);
			$post_list = NULL;

			foreach( $recent_posts as $recent ){

					$post_list .= '<a href="' . SITE_ROOT . '/' . $_GET['lang'] . '/blog/view_post/'. $recent["ID"] . '" class="footer_link">' . $recent["post_title"] .'
					</a><br/>';
				 } 	
			

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
		
		function login() {
			
			$args = array("echo" => FALSE,
						  "redirect" => "/en/blog/login/success");
			$login_form = wp_login_form($args);
			 $tpl = new TemplateController;
			 $tpl->set("login_form", $login_form);

	
	}
}