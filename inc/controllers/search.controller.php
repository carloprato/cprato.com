<?php
	
	class SearchController {
		
		public function results() {
			
			$search = new SearchModel;
			$results = $search->results($_GET['arg']);
			if (empty($results)) {
				TemplateController::set("results", array());
			} else {
				TemplateController::set("results", $results);
			}
		}
	}
