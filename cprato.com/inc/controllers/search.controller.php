<?php
	
	class SearchController extends BaseController {
		
		public function results() {
			
			$search = new SearchModel;
			$results = $search->results($this->arg);
			if (empty($results)) {
				TemplateController::set("results", array());
			} else {
				TemplateController::set("results", $results);
			}
		}
	}
