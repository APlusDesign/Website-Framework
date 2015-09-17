	
	<br>
	<h2><?php echo $this->display_title; ?></h2>
	<p>Date joined: <?php echo $this->u_date; ?></p>
	<p><a href="/user/changepassword">Change your password</a></p>
	<br>
	<h2>Stored user data</h2>
	<?php
		$this->pre($this->user->session->data);
	?>
	
