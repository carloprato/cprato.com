<?php
	
	class StatsController {
		
		static public function version() {
			
			return "0.0.1";
		}
		
		static public function views_list() {
			
			return array('index', 'list_posts', 'view_post');
		}

		static public function description() {
			
			return "Module to display statistics about installed modules.";
		}
										
		function list_controllers() {
				

			$dir    = './inc/controllers';
			$files1 = scandir($dir);
			unset($files1[0]);
			unset($files1[1]);
			
			$i = 2;
	    	while (isset($files1[$i])) {
			
				$controller = str_replace(".controller.php", "", $files1[$i]);			
				$controller = ucwords($controller) . "Controller";
				
				if (!class_exists($controller))	{
					include("./inc/controllers/" . $files1[$i]);
				}
				$files1[name][$i] = $files1[$i];			
				$files1[version][$i] = $controller::version();
				$files1[views][$i] = $controller::views_list();
				$files1[description][$i] = $controller::description();			
				unset($files1[$i]);
				$i++;
			}
						
			$tpl = new TemplateController;
		
			$tpl->set("controllers_list", "<pre>" . print_r($files1, true) . "</pre>");
			return($files1);
		
		}
	
	}
