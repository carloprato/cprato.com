<?php
	
	class Core extends BaseModel {

		public $page;
		public $lang;
		public $routes;
		
		function __construct() {
			
			session_start();
			// !!! This belongs in routes.php
			if (isset($_GET['lang'])) $this->lang = $_GET['lang'];
			else $this->lang = 'en';
			if (isset($_GET['p'])) $this->page = $_GET['p'];
			else $this->page = 'home';

			/*
			** Defines page constants
			*/
			
			define("SITE_ROOT", "");
			define("LANG", $this->lang);
			define("PAGE", $this->page);
						
			/*
			** Security
			*/
			
			define("COOKIE_PREFIX", 'ecf5252a4a1a154b75c72f60477564b3a94b576308ea9f3b'); // Cookie to prefix to make the remember me feature more secure
			define("FB_PASSWORD", "5nzMXkxyzwBYbWIQwf7VlmPDVrekJycaxf5jzRwefiA2nXmzUaEDX9Z7cakB0PSQFrZSiuHAtw2Z4itwoL0vdylRTyhYy34X");
			
			/*
			** Profile visibility
			*/
			
			define('VISIBLE_NAME', 0x00000001);
			define('VISIBLE_EMAIL', 0x00000002);
			
			/*
			** Error reporting
			*/
			
			error_reporting(E_ALL);
			
			/*
			** Update servers
			*/
			
			define("UPDATE_SERVER", "http://www.cprato.com/updates/");
			
			/*
			** About
			*/
			
			define("VERSION", "0.1.005linux");
			define("VERSION_DATE", "20150815");			
			
			/*
			** Start
			*/
			
			Auth::autologin();
			$this->init();
			$this->checkURI();

		}
	
		function init() {
			
			$post = new PostModel;			
			TemplateController::set("recent_posts", $post->getLatestPosts(0,3));
						
			$forum = new TopicModel;
			TemplateController::set("list_topics", $forum->getTopicList(3));
			
			TemplateController::set("page_title", $_GET['p']);
			TemplateController::set("p", PAGE);
			TemplateController::set("lang", LANG);
			TemplateController::set("SITE_ROOT", SITE_ROOT);
			TemplateController::set("arg", $this->arg);
			if (isset($this->arg) && $_GET['p'] == 'messages') {
				$user = new UserModel;
				TemplateController::set("recipient", $user->getById($this->arg)->user);
			}
			
			if (isset($_SESSION['user'])) {
				// !!! not good to set up variables like this
				TemplateController::set("user", $_SESSION['user']);
				TemplateController::set("name", $_SESSION['name']);
				TemplateController::set("user_id", $_SESSION['user_id']);
				TemplateController::set("privileges", $_SESSION['privileges']);
			} else {
				
				TemplateController::set("user", 0);
				TemplateController::set("name", 0);				
				TemplateController::set("user_id", 0);
			}			
		}
		
		function checkURI() { 
			// Check if language and page to display are set, otherwise redirects to the homepage
			
			if (!isset($_GET['p']) || !isset($_GET['lang'])) {
				
				header("Location: " . SITE_ROOT . "en/home");
			}
		}
			
		function debug($message, $level) {
			
			if (DEBUG >= $level) {

				return $message;
				}
			}
		}
