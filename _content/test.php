		
		<div>
			<p>Look at the pretty URL</p>
			
			<?php
				if($_REQUEST['key']) {
					echo "<pre>";
					print_r($_REQUEST);
					echo "</pre>";
					echo "<p>Look in the .htaccess file for the example of how to do value/key url pairing</p>";
					echo "<p>back <a href='/test/'>/test/</a></p>";
				} else {
					echo "<p>Also check this out</p> <p><a href='/test/key/value/key2/value2/key3/value3/'>/test/key/value/key2/value2/key3/value3/</a></p>";

				}
			?>
		</div>
