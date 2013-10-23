
<div class="user-details">
	<h2><?php echo $this->display_title; ?></h2>
	<p>Date joined: <?php echo $this->u_date; ?></p>
	<?php if($this->type == 'private'): ?>
		<p><a href="/user/profile?id=<?php echo $this->user->data['user_id']; ?>">View your public profile</a></p>
		<p><a href="/user/changepassword">Change your password</a></p>
		<br>
		<pre>
		<?php print_r($this->user->data); ?>
		</pre>
	<?php endif; ?>
</div>

