<?php
	
	class Posts {
		
		public $id;
		public $author;
		public $content;
		
		public function __construct($id = 0, $author = NULL, $content = NULL) {
      		$this->id      = $id;
    		$this->author  = $author;
    		$this->content = $content;
 		   }
		
		
		public static function all() {
		      $list = [];
		      $db = Db::getInstance();
		      $req = $db->query('SELECT * FROM posts');
		
		      foreach($req->fetchAll() as $post) {
		        $list[] = new Posts($post['id'], $post['author'], $post['content']);
		      }
		
		      return $list;
		    }
	}