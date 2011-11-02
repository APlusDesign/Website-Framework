
	<!-- Content goes here -->
	<?php 
        // Your generic class - example
        echo $siteClass->helloWorld(); 
        
        // Your example class but called using the registry Pattern 
        $yourClass = registry::get($site_class);
        echo $yourClass->helloWorld(); 
    ?>

