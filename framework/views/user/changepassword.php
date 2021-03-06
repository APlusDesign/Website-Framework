	
	<br>
	<h2>Change Password</h2>
	<?php if(!$this->passChanged) { ?>
	
		<form id="change-password" class="framework-form" method="post" action="">
			<input name="c" type="hidden" value="<?php echo (isset($_GET['c']) ? $_GET['c'] : ''); ?>">
			<div id="reg-password" class="input-wrap">
				<label>New Password:</label>
				<input name="password" type="password" autocomplete="off">
			</div>
			<div id="reg-password-2" class="input-wrap">
				<label>Retype New Password:</label>
				<input name="password2" type="password" autocomplete="off">
			</div>
			<div class="actions">
				<input type="submit" value="Change" class="framework-button change-password-button">
				<div class="error-wrap">
					<?php
						if($this->user->log->getFormErrors()){
							foreach($this->user->log->getFormErrors() as $i=>$x){
								echo "<p class='reg-error'>$x</p>";
							}
						}
					?>
				</div>
			</div>
		</form>
	
	<?php } else { ?>
		<p>Password was changed</p>
		<p>You have been logged out:: <a href="/ajax/?view=login" class="btn-login">Login</a></p>
		<p>Return to <a href="/">Home</a></p>
	<?php } ?>
