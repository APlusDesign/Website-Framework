<?php include($_SERVER['DOCUMENT_ROOT'] .'/../framework/index.php'); ?>
<?php
	// Define MVC data
	$framework->mvc = array (
		"route" 		=> "ajax/",		// The path to your view file
		"controller" 	=> "ajax",		// The controller you wish to use
		"view" 			=> null,		// The view you wish to display
		"template" 		=> ""			// The Template you wish to use
	);
?>
<?php $framework->init(); ?>