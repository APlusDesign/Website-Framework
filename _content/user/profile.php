	
<div class="user-details">
  <h2><?php echo $display_title; ?>'s profile page</h2>
  <p>Date joined: <?php echo $u_date; ?></p>
  <?php if($user->signed && $user->id == $view): ?>
  <p><a href="/user/<?php echo $view; ?>/edit">edit</a></p>
  <?php endif; ?>
</div>
<pre>
<?php print_r($aUser); ?>
</pre>
