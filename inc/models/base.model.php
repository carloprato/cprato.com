<?php
	class BaseModel {
		
		public $template;
		public $db;
		public $tpl;
		public static $values;
		public $lang;
		public $controller;
		public $action;
		public $arg;
		public $arg2;
		
		function __construct() {
			
			$this->db = Db::getInstance();
			$this->tpl = new TemplateController;

			$this->lang = Routes::$lang;
			$this->controller = Routes::$controller;
			$this->action = Routes::$action;
			$this->arg = Routes::$arg;
			$this->arg2 = Routes::$arg2;
		}			
	}