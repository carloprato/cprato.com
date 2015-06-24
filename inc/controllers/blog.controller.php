<?php
	
	class BlogController {
		
		// Class to add, modify and remove static HTML pages.
		//
		//
		//
		
		function __construct() {
			

		}
		function index() {
			// List all possible actions related to this module


			$this->list_posts();
         
		}

		function list_posts() {
			
				global $tpl;

						$args=array( 'post_status'=> 'publish', 'numberposts' => '3'); 
						$recent_posts = wp_get_recent_posts($args);
						$post_list = NULL;
						foreach( $recent_posts as $recent ){

						if (strlen($recent["post_content"]) > 300)	
							$recent["post_content"] = substr($recent["post_content"], 0, 300) . '...<a href="/blog/?p='. $recent["ID"] . '"> Continue Reading</a>';
				$post_list .= '
                <h3>
					<a href="{{SITE_ROOT}}/{{lang}}/blog/view_post/'. $recent["ID"] . '">
						'. $recent["post_title"].'
					</a>
				</h3>
				
				'. $recent["post_content"] . '
				<br/>'; }           
	
		$tpl = new TemplateController;
 		$tpl->set("list_posts", $post_list);  


		   return $post_list;



	}
	
		function view_post($id) {
			
			$post = get_post($id);
			
		 $tpl = new TemplateController;
 		 $tpl->set("post_title", $post->post_title);
		 $tpl->set("post_content", $post->post_content);
		 
		   
		}
	}