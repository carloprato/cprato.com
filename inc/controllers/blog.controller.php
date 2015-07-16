<?php
	
	class BlogController extends BaseController {
		
		//
		//
		//
		//
		
		function index() {

			$this->list_posts();
         
		}

		function list_posts() {
			
			$post = new PostModel;
			$recent_posts = $post->getLatestPosts(5);
			TemplateController::set("recent_posts", $recent_posts);		

		}
	
		function view_post($id) {

			/// !!! only one URL should be processed instead of both short_title and post id.
			$post = new PostModel;
			$post_content = $post->getPost($id);
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
			
			function add_comment($post_id) {
				// ??? Redirect immediately after insertion
				// ??? Ask to log in if the user is not yet logged in
				
				Auth::authorise(array("user"), true);
				
				if (isset($_POST['submitComment'])) {
					
					$post = new PostModel;
					$post->addComment();
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