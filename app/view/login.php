<!-- multi step form -->
<form id="msform" action="<?php echo URLROOT.'account/login'?>" method="POST">
	<fieldset>
		<h2 class="fs-title">ورود به حساب کاربری</h2>
		<input type="text" name="email" placeholder="پست الکترونیک" />
		<input type="password" name="password" placeholder="رمز عبور" />
		<input type="submit" name="next" class="action-button" value="بعدی" />
	</fieldset>
</form>