<?php include($_SERVER['DOCUMENT_ROOT'] .'/../framework/index.php'); ?>
<?php
	// Define MVC data
	$framework->mvc = array (
		"route" 		=> "/404/",			// The path to your view file
		"controller" 	=> "",				// The controller you wish to use
		"view" 			=> "404",			// The view you wish to display
		"template" 		=> "default"		// The Template you wish to use
	);
	// Define SEO data
	$framework->seo = array (
		"page_title" 	=> "Website framework . 404",
		"page_desc"		=> "Website framework . 404"
	);
?>
<?php $framework->init(); ?>