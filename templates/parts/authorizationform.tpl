<div align=center>
	<form name="logUser" action={COMMON="AUTHORIZATION_SCRIPT"} method="post" >
		<p><input type="text" required name="login" placeholder="Логин или e-mail" size="30%" /></p>
		<p><input type="password" required name="passwd" placeholder="Пароль" pattern="[\w]{4,}" size="30%" /></p>
		<p><input type="checkbox" name="rememberUser" value="on" size="30%" />Запомнить меня</p>
		<div class="g-recaptcha" data-sitekey="6Le5cyEUAAAAAIhsDnSbZkFmn7QJpfocPj2fswIA"></div>
		<p><input type="submit" value="Войти" /></p>
	</form>
</div>