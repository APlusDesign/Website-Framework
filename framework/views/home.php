		<!-- HTML Content goes here -->
		<br>
		<h2>Everything is accessible via ''$this'' keyword</h2>
		<p>Value of Variable declared in class.default.php: <strong><?php echo $this->someVariable; ?></strong></p>
		<p>Value of Variable declared in class.default.php: <strong><?php echo $this->someOtherVariable; ?></strong></p>
		<p>Value of Variable declared in config.inc: <strong><?php echo $this->href; ?></strong></p>
		<p>Output of a function declared in class.default.php: <strong><?php echo $this->helloWorld2(); ?></strong></p>
		<p>Output of a function declared in class.functions.php: <strong><?php echo $this->helloWorld1(); ?></strong></p>
		<p>Output of a function declared in class.websiteFramework.php: <strong><?php echo $this->helloWorld(); ?></strong></p>
		
		<br><br>
		<h2>Things to test after editing config.inc</h2>
		<p>Register an account &#8594; activate via email &#8594; login to that account</p>
		<p>Change your password &#8594; login again</p>
		<p>View your user page after login</p>
		<p>Send yourself an email using the contact form</p>
		<p>View the test page <a href="/prettyurl">/prettyurl</a></p>
		<p>View custom 404 Page <a href="/404">/404</a></p>
		<p>View the render speed <a href="/speed-test">/speed-test</a></p>
		<p>Run Google <a href="http://code.google.com/speed/page-speed/" class="_blank">Page Speed</a> (Nothing to do here)</p>
		<p>Run Yahoo! <a href="http://developer.yahoo.com/yslow/" class="_blank">YSlow</a> (A Grade +95)</p>
		<p>Open <a href="http://code.google.com/p/fbug/" class="_blank">Firebugs</a> NET panel and watch the waterfall</p>
		