	
<div class="user-details">
	<h2><?php echo $display_title; ?>'s profile page</h2>
	<p>Date joined: <?php echo $u_date; ?></p>
	<?php if($user->signed): ?>
	<pre>
	<?php print_r($aUser); ?>
	</pre>
	<?php endif; ?>
</div>

