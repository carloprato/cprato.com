<?php
	
	 class BaseController {
		
		public $template;
		public $db;
		public $tpl;
		public static $values;
		public $page;
		public $lang;

		
		function __construct() {
			
			$this->db = Db::getInstance();
			$this->tpl = new TemplateController;

			$this->controller = Routes::$controller;
			$this->action = Routes::$action;
			$this->arg = Routes::$arg;
			$this->arg2 = Routes::$arg2;
			$this->arg3 = Routes::$arg3;
			$this->lang = Routes::$lang;
			$this->page = Routes::$controller;

		}	
	}