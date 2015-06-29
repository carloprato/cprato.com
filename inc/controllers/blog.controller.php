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
				global $recent_posts;
						$args=array( 'post_status'=> 'publish', 'numberposts' => $num); 
						$recent_posts = wp_get_recent_posts($args);
						/*
						$recent_posts = array(
							array("post_title" => "Wow great!",
								  "post_content" => "bla bla bla bla",
								  "ID" => 1),
							array("post_title" => "Wow dfsg!",
								  "post_content" => "bla sdfgss bla bla",
								  "ID" => 2),
								  
							array("post_title" => "Wosdfgw great!",
								  "post_content" => "bla bla sfgsfs bla",
								  "ID" => 3),
								  								  	
						);
						*/

						foreach ($recent_posts as $key => $value) {

							$recent_posts[$key]['post_content_short'] = substr($recent_posts[$key]['post_content'], 0, 200) . "...";
						}
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