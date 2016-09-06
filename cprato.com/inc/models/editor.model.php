<?php
	
	Class EditorModel extends BaseModel {
		
		public function getPages() {
			
			$sql = 'SELECT * FROM pages';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array());	
			
			foreach($q->fetchAll(PDO::FETCH_OBJ) as $page) {					
			
				$pages_list[] = $page;					
			}			
			return $pages_list;
		}
		
		public function getPage($page_id) {
						
			$sql = 'SELECT * FROM pages WHERE name = ? OR name = ?';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($page_id, $page_id . "/index")); // !!! Fix this too	
			foreach($q->fetchAll(PDO::FETCH_OBJ) as $page) {					
				return $page;
			}			
		}
		
		public function add($name, $content) {
			
			$sql = 'INSERT INTO `pages` (`name`, `content`) VALUES (?, ?)';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($name, $content));
		}
		
		public function update($name, $content) {
			
			$sql = 'UPDATE pages SET content = ? WHERE name = ? OR name = ?';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($content, $name, $name . "/index")); // !!! Fix this too	
		}
		
		public function delete($name) {
			
			$sql = 'DELETE FROM `pages` WHERE name = ? LIMIT 1';
			$q = $this->db->prepare($sql);
			$req = $q->execute(array($name));
		}
	}