<?php include($_SERVER['DOCUMENT_ROOT'] .'/../framework/index.php'); ?>
<?php
	// Define MVC data
	$framework->mvc = array (
		"route" 		=> "/user/",		// The path to your view file
		"controller" 	=> "user",			// The controller you wish to use
		"view" 			=> "profile",		// The view you wish to display
		"template" 		=> "default"		// The Template you wish to use
	);
?>
<?php $framework->init(); ?>