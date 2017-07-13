<div align=center>
	<form name="regUser" action={COMMON="REGISTRATION_SCRIPT"} method="post" >
		<p><input type="text" required name="login" placeholder="Логин : 4 - 20 символов" pattern="[A-Za-z0-9_]{4,20}"  size="30%" /></p>
		<p><input type="text" required name="email" placeholder="e-mail" pattern="^[_a-zA-Z-\.0-9]+@[_a-zA-Z-\.]+$"  size="30%" /></p>
		<p><input type="password" required name="passwd" placeholder="Пароль : 4 и более символа" pattern="[\w]{4,}" size="30%" /></p>
		<p><input type="password" required name="passwdrepeat" placeholder="Подтверждение пароля" pattern="[\w]{4,}" size="30%" /></p>
		<div class="g-recaptcha" data-sitekey="6Le5cyEUAAAAAIhsDnSbZkFmn7QJpfocPj2fswIA"></div>
		<p><input type="submit" value="Зарегистрироваться" /></p>
	</form>
</div>