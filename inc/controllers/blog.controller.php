<?php
	
	class BlogController extends BaseController {
		
		//
		//
		//
		//
		
		function index() {

			$topic = new TopicModel;
			$this->list_posts();

		}

		function list_posts() {
			
			$post = new PostModel;
			$num = 3;
			$page = Routes::$arg*$num;
			
			$recent_posts = $post->getLatestPosts($page,$num);
			
		/*
			$topic = new Topic;
			$topic->pagination(1, 5, 'posts', 'id');
			*/


			TemplateController::set("recent_posts", $recent_posts);		

		}
	
		function view_post($id) {

			/// !!! only one URL should be processed instead of both short_title and post id.
			$post = new PostModel;
			$post_content = $post->getPost($id);
			if ($this->arg2 != $post->getPost($id)[0]->short_title) {
				
				header("Location: /en/blog/view_post/" . $id . "/" . $post->getPost($id)[0]->short_title);
			} 
			$comments = $post->getComments($id);

			TemplateController::set("post_content", $post_content);
	   		TemplateController::set("comments", $comments);
		}

		function add() {
			
			Auth::authorise(array("editor", "author"), true);
			
			if (isset($_POST['submit_button'])) {	
												
				$post = new PostModel;
				$post->add();
							
				}			
			}			

		function edit($id) {
			
			Auth::authorise(array("editor", "author"), true);									
							
			$post = new PostModel;			


			if (isset($_POST['submit_button'])) {	
				
				$post->edit($id);
							
				}		
			$post_to_edit = $post->getPost($id);				
			TemplateController::set("post_to_edit", $post_to_edit);	
			}	

		function delete($id) {
			
			Auth::authorise(array("editor", "author"), true);									
							
			$post = new PostModel;	
		
			$post->delete($id);
			header("Location: /en/blog/menu");
		}	
			
						
			function menu() {
				
				$post = new PostModel;
				$blog_editor = 	$post->getLatestPosts(0, 10);
				TemplateController::set("blog_editor", $blog_editor);
			}			
			
			function add_comment($post_id) {
				// ??? Redirect immediately after insertion
				// ??? Ask to log in if the user is not yet logged in
				
				Auth::authorise(array("user"), true);
				
				if (isset($_POST['submitComment'])) {
					
					$post = new PostModel;
					$post->addComment();
					// ?!?				
					header('Location: /' . $this->lang . "/blog/view_post/" . $post_id);
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