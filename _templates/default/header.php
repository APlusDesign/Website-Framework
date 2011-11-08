<header>
	<div class="inner-wrap">
		<h1><?php echo $site_name; ?></h1>
		<div class="user-controls">
			<a href="/">Home</a>
			<a href="/_content/ajax/contact.php" class="fancy-link btn-contact">Contact</a>
            <?php 
            // User not signed in
            if(!$user->signed) : 
			?>	
			<a href="/_content/ajax/register.php" class="fancy-link btn-register">Register</a>
			<a href="/_content/ajax/login.php" class="framework-button fancy-link btn-login">Login</a>
			<?php 
			// User signed in
			else: ?>    
			<a href="user/<?php echo $user->id;?>" iclass="fancy-link update-user"><?php echo ucfirst($user->username); ?></a>
			<a href="#" class="framework-button fancy-link btn-logout">Logout</a>
			<?php endif; ?>	
		</div>
	</div>
</header>
