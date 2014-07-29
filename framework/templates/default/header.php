<header>
	<h1><?php echo $this->site_name; ?></h1>
	<div class="user-controls">
		<a href="/">Home</a>
		<a href="/ajax/?view=contact" class="btn-contact">Contact</a>
		<?php 
			// User not signed in
			if(!$this->user->isSigned()) : 
		?>
		<a href="/ajax/?view=register" class="btn-register">Register</a>
		<a href="/ajax/?view=login" class="btn-login">Login</a>
		<?php 
			// User signed in
			else: 
		?>
		<a href="user/profile" class="update-user"><?php echo ucfirst($this->user->Username); ?></a>
		<a href="#" class="btn-logout">Logout</a>
		<?php endif; ?>
	</div>
</header>