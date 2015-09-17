<div class="window-wrapper">
	<h2>Login</h2>
	<form id="login" class="ajax-form framework-form" method="post" action="/ajax/?flag=login">
		<div class="input-wrap">
			<label>Username:</label>
			<input type="text" name="username" id="username">
		</div>
		<div class="input-wrap">
			<label>Password:</label>
			<input type="password" name="password" id="password">
		</div>
		<div class="input-wrap small">
			<label>Remember me:</label>
			<input type="checkbox" name="auto" class="check" id="auto">
		</div>
		<p>
			<br>
		   	<a href="/ajax/?view=forgot" class="forgot-password">Forgot password?</a>
		</p>
		<div class="actions">
			<input type="submit" value="Submit">
		</div>
	</form>
</div>  