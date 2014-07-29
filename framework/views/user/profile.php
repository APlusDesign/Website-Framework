
<div class="user-details">
	<h2><?php echo $this->controller->display_title; ?></h2>
	<p>Date joined: <?php echo $this->controller->u_date; ?></p>
	<?php if($this->controller->type == 'private'): ?>
		<p><a href="/user/profile?id=<?php echo $this->user->ID; ?>">View your public profile</a></p>
		<p><a href="/user/changepassword">Change your password</a></p>
		<br>
		
		<pre>
		<?php print_r($this->user->session->data); ?>
		</pre>
	<?php endif; ?>
</div>

