		
		<!-- Content goes here -->
		<div>
			<?php 
				/*
				$data['username'] = "pablo";
				$data['email'] = "tadah@whatever.com"; 
				$data['password'] = "!@#$$%";
				$data['activated'] = "1";
				$data['confirmation'] = "1";
				$data['reg_date'] = "NOW()";
				$data['group_id'] = "1";
				$data['last_login'] = "NOW()";
				$primary_id = $db->insert("users", $data);
				
				
				// then use the returned ID if you want
				echo " record : $primary_id";
				*/
				// Your generic class - example
				echo $siteClass->helloWorld(); 
				echo $siteClass->helloWorld(); 
				// Your example class but called using the registry Pattern 
				$yourClass = registry::get($site_class);
				echo $yourClass->helloWorld(); 
		
			?>	
		</div>
	