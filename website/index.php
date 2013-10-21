<?php include($_SERVER['DOCUMENT_ROOT'] .'/../framework/index.php'); ?>
<?php
	// Define MVC data
	$framework->mvc = array (
		"route" 		=> "/",				// The path to your view file
		"controller" 	=> "",				// The controller you wish to use
		"view" 			=> "home",			// The view you wish to display
		"template" 		=> "default"		// The Template you wish to use
	);

	// Define SEO data
	$framework->seo = array (
		"page_title" 	=> "Website framework . PHP . HTML5 . CSS3 . jQuery",
		"page_desc"		=> "Website framework . Free and easy way to deploy super fast websites on the spot",
		"page_keywords" => "website, framework, php, html5, css3, jquery"
	);
?>
<?php $framework->init(); ?>
