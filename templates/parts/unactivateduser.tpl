<div align=center>
	<p class="content_text">Добро пожаловать, {VAR="USERNAME"}!</p>
	<p class="content_text">На Вашу почту {VAR="EMAIL"} был выслан код. Введите его в данное поле, чтобы завершить регистрацию.</p>
	
	<form name="activation" action={COMMON="ACTIVATION_SCRIPT"} method="post">
		<p><input type="text" required name="code" placeholder="Код активации" pattern="[a-zA-Z0-9]{40}" size="50%" /></p>
		<p><input type="submit" value="Активировать" /></p>
	</form>
	
	<p><a href={COMMON="RESEND_CODE_SCRIPT"}><button>Выслать код повторно</button></a></p>
	<p><a href={COMMON="LOGOUT_SCRIPT"}><button>Выйти</button></a></p>
</div>