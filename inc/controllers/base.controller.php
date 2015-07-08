<?php
	
	abstract class BaseController {
		
		public $template;
		public $db;
		public $tpl;

		function __construct() {
			
			$this->db = Db::getInstance();
			$this->	tpl = new TemplateController;

			$this->controller = Routes::$controller;
			$this->action = Routes::$action;
			$this->arg = Routes::$arg;
			$this->arg2 = Routes::$arg2;
					
		}	
	}