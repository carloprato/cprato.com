<?php
	
	abstract class BaseController {
		
		public $template;
		public $db;
		public $tpl;

		function __construct() {
			
			$this->db = Db::getInstance();
			$this->tpl = new TemplateController;
			
		}
	
	}
	
