<div class="window-wrapper">
	<h2>Contact Us</h2>
	<form id="contact" class="ajax-form framework-form" method="post" action="/ajax/?flag=contact">
		<div class="input-wrap">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" value="">
		</div>
		<div class="input-wrap">
			<label for="email">Email</label>
			<input type="text" name="email" id="email" value="" autocapitalize="off">
		</div>
		<div class="input-wrap">
			<label for="message">Message</label>
			<textarea name="message" rows="2" cols="20" id="message"></textarea>
		</div>
		<!-- 
		<div class="input-wrap">
			<label for="country">Country</label>
			<select name="country" id="country">
				<option value="">fffff</option>
			</select>
		</div>
		-->
		<div class="actions">
			<input type="submit" value="Submit">
		</div>
	</form>
</div>  