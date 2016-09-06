<?php
	
	class Custompages extends BaseController {
		
		function index() {
		
			// Load from DB instead
			$id = 1;
			$name = "about";	
			$page = "{layout:start}
						{layout:evidence}
							<h2>About Us</h2>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget nulla id est congue molestie. Phasellus varius, nisl sit amet aliquam sodales, orci leo mollis massa, eu sollicitudin mauris eros nec sem. Ut ac lectus id nunc malesuada blandit id in augue. <br /><br />Duis in sem massa. Integer a accumsan massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean quis pellentesque quam. Integer quam sem, ullamcorper in tellus a, luctus faucibus lorem. Cras lorem leo, posuere quis nunc scelerisque, ultricies mollis elit. <br /><br />Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut lacinia a massa ut malesuada. Donec pulvinar imperdiet leo, vel ullamcorper urna luctus a. Aliquam tempus congue lacus, id rutrum metus laoreet a. Aliquam iaculis eu augue mollis semper. Donec ornare cursus augue in aliquam.<br /><br />This is new <strong>information</strong> that was added later thanks to the page editor.<br /><br />
						{endlayout:evidence}
					{endlayout}";
			$evidence = "<div class='evidence_container'>
							<div class='row evidence'>
								<div class='col_6 evidence_paragraph'>";
			
			if (preg_match_all('/{layout:start}(.*?){endlayout}/s', $page, $matches)) {

				$page = str_replace("{layout:evidence}", $evidence, $page);
				$page = str_replace("{endlayout:evidence}", $endevidence, $page);				
			}
			
			$this->template = $page;	
		}
	}