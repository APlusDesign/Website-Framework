<div id="ajax-form">
	<h3>Contact us</h3>
	<div class="user-form">
		<form id="contact" method="post" action="/ajax/?flag=contact">
			<div class="input-wrap">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" value="">
			</div>
			<div class="input-wrap">
				<label for="phone">Email</label>
				<input type="text" name="email" id="email" value="">
			</div>
			<div class="input-wrap">
				<label for="message">Message</label>
				<textarea name="message" rows="2" cols="20" id="message"></textarea>
			</div>
			<div class="actions">
				<input type="submit" value="Submit">
			</div>
		</form>
	</div>
</div>
  