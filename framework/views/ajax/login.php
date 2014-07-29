<div id="ajax-form">
	<h3>Login</h3>
	<form id="login" method="post" action="/ajax/?flag=login">
		<div class="input-wrap">
			<label>Username:</label>
			<input type="text" name="username" id="username">
		</div>
		<div class="input-wrap">
			<label>Password:</label>
			<input type="password" name="password" id="password">
		</div>
		<div class="input-wrap small-label">
			<label>Remember me?:</label>
			<input type="checkbox" name="auto" class="check" id="auto">
		</div>
		<p>
		   <a href="/ajax/?view=forgot" class="forgot-password fancybox.ajax">Forgot password?</a>
		</p>
		<div class="actions">
			<input type="submit" value="Submit">
		</div>
	</form>
</div>
