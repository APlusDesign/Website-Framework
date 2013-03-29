		<?php 
		
			
		
			// Your example class but called using the registry Pattern 
			$yourSiteName = registry::get($site_class);
		?>	
		<!-- Content goes here -->
		<div>
			<?php echo $siteClass->helloWorld();  ?>
			
			<?php echo $yourSiteName->helloWorld();  ?>
			
			<p>Hello World</p>
		</div>
	