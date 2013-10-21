<div class="pre-window-wrap">
	<h3>Login</h3>
	<form id="login" method="post" action="/ajax/flag/login/">
		<div id="reg-username" class="input-wrap">
			<label>Username:</label>
			<input type="text" name="username">
		</div>
		<div id="reg-password" class="input-wrap">
			<label>Password:</label>
			<input type="password" name="password">
		</div>
		<div id="reg-auto" class="input-wrap">
			<label>Remember me?:</label>
			<input type="checkbox" name="auto" class="check">
		</div>
		<p>
		   <a href="/ajax/type/forgot/" class="forgot-password fancybox.ajax">Forgot password?</a>
		</p>
		<div class="login-action">
			<input type="submit" value="Login" class="framework-button large login-button">
		</div>
	</form>
</div>
