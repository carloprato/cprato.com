<?php
	
	class Auth {
		
		function login() {
								
		      $list = [];
		      $db = Db::getInstance();
		      $req = $db->query('SELECT * FROM users');
		
		      foreach($req->fetchAll() as $post) {
		        $list[] = new Posts($post['id'], $post['user'], $post['password']);
		      }
		
		
		      return $list;
		    }
			
		
		
		function logout() {
			
			
		}
		
		function register() {
			
			
		}
		
		function protect() {
			
			
		}
		
	}