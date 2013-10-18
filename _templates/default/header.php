
		<header>
			<h1><?php echo $site_name; ?></h1>
			<div class="user-controls">
				<a href="/">Home</a>
				<a href="/_content/ajax/contact" class="btn-contact fancybox.ajax">Contact</a>
		        <?php 
			        // User not signed in
			        if(!$user->signed) : 
				?>	
				<a href="/_content/ajax/register" class="btn-register fancybox.ajax">Register</a>
				<a href="/_content/ajax/login" class="btn-login fancybox.ajax">Login</a>
				<?php 
					// User signed in
					else: 
				?>    
				<a href="user/id/<?php echo $user->id;?>" class="update-user fancybox.ajax"><?php echo ucfirst($user->username); ?></a>
				<a href="#" class="btn-logout">Logout</a>
				<?php 
					endif; 
				?>	
			</div>
		</header>
