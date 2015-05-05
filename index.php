<?php
  #remove the directory path we don't want
  $request  = str_replace("/envato/pretty/php/", "", $_SERVER['REQUEST_URI']);
 
  #split the path by '/'
  $params     = split("/", $request);
	$_GET['lang'] = $params['1'];
	$_GET['p'] = $params['2'];
  ?>

<?php
	if ($_GET['lang'] == NULL) $_GET['lang'] = 'en';
	if ($_GET['p'] == NULL) $_GET['p'] = 'home';
	include("lang/en.lang.php");	
	include("lang/" . $_GET['lang'] .".lang.php");
	include("inc/header.inc.php");
	include("inc/body.inc.php");
	include("inc/". $_GET[p] . ".inc.php");
	include("inc/footer.inc.php");
	
	?>