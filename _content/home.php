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
		<br><br>
		<div>
			<h2>Things to test after editing config.inc</h2>
			<p>Register an account, activate via email,  login to that account</p>
			<p>View your user page, after logging in</p>
			<p>View the test page <a href="/test">/test</a></p>
			<p>Run Google <a href="http://code.google.com/speed/page-speed/" class="blank">Page Speed</a></p>
			<p>Run Yahoo! <a href="http://developer.yahoo.com/yslow/" class="blank">YSlow</a></p>
		    <p>View <a href="http://code.google.com/p/fbug/" class="blank">Firebugs</a> NET panel and see the waterfall</p>
		    <p>Use the contact form</p>
		</div>