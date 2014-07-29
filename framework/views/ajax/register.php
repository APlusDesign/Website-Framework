<div id="ajax-form">
	<h3>Register</h3>
	<form id="register" method="post" action="/ajax/?flag=register">
		<div class="input-wrap">
			<label>Username:</label>
			<input type="text" name="username" id="username">
		</div>
		<div class="input-wrap">
			<label>Password:</label>
			<input type="password" name="password" id="password">
		</div>
		<div class="input-wrap">
			<label>Re-type Password:</label>
			<input type="password" name="password2" id="password2">
		</div>
		<div class="input-wrap">
			<label>Email: </label>
			<input type="text" name="email" value="" id="email">
		</div>
		<div class="actions">
			<input type="submit" value="Register">
		</div>
	</form>
</div>

