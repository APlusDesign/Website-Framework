
	<h3>Change Password</h3>
	<?php if(!$this->passChanged) { ?>
	<div class="user-form">
		<form id="change-password" method="post" action="">
			<input name="c" type="hidden" value="<?php echo (isset($_GET['c']) ? $_GET['c'] : ''); ?>">
			<div id="reg-password" class="input-wrap">
				<label>New Password:</label>
				<input name="password" type="password" autocomplete="off">
			</div>
			<div id="reg-password-2" class="input-wrap">
				<label>Retype New Password:</label>
				<input name="password2" type="password" autocomplete="off">
			</div>
			<div class="change-action">
				<input type="submit" value="Change" class="framework-button large login-button">
				<div class="error-wrap">
					<?php
						if(count($_POST) and $this->user->has_error()){
							foreach($this->user->error() as $i=>$x){
								echo "<p class='reg-error'>$x</p>";
							}
						}
					?>
				</div>
			</div>
		</form>
	</div>
	<?php } else { ?>
		<a href="/">Return to <?php echo $this->href; ?></a>
	<?php } ?>
