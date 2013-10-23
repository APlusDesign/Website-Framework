		<!-- Sorry about html formatting PHP 'includes' mess up the source pretty badly -->
		<header>
			<h1><?php echo $this->site_name; ?></h1>
			<div class="user-controls">
				<a href="/">Home</a>
				<a href="/ajax?type=contact" class="btn-contact fancybox.ajax">Contact</a>
				<?php 
					// User not signed in
					if(!$this->user->signed) : 
				?>

				<a href="/ajax?type=register" class="btn-register fancybox.ajax">Register</a>
				<a href="/ajax?type=login" class="btn-login fancybox.ajax">Login</a>
				<?php 
					// User signed in
					else: 
				?>
				<a href="user/profile" class="update-user fancybox.ajax"><?php echo ucfirst($this->user->username); ?></a>
				<a href="#" class="btn-logout">Logout</a>
				<?php 
					endif;  
				?>

			</div>
		</header>
