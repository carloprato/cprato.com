<?php
	
	class StatsController {
		

		function list_controllers() {
			
		$dir    = '.';
		$files1 = scandir($dir);

		$i = 0;
    	while (isset($files1[$i])) {

			$files1[$i] = str_replace(".controller.php", "", $files1[$i]);

			$i++;
		}
		unset($files1[0]);
		unset($files1[1]);
		return($files1);
		
	}
	
	}
	
	$test = new StatsController;
	$array = $test->list_controllers();
	foreach ($array as $element) {
		$element = ucwords($element);
		echo $element . "<br/>";	
	}