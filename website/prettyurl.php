<?php include($_SERVER['DOCUMENT_ROOT'] .'/../framework/index.php'); ?>
<?php
	// Define MVC data
	$framework->mvc = array (
		"route" 		=> "/",				// The path to your view file 		('/' means root)
		"controller" 	=> "",				// The controller you wish to use 	(empty means don't load a controller)
		"view" 			=> "prettyurl",		// The view you wish to display 	(this can't be empty)
		"template" 		=> "default"		// The Template you wish to use 	(empty means no template, good for ajax)
	);
?>
<?php $framework->init(); ?>