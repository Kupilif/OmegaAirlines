<div align=center>
	<p class="content_text">Добро пожаловать, {USERNAME}!</p>
	<p class="content_text">На Вашу почту {EMAIL} был выслан код. Введите его в данное поле, чтобы завершить регистрацию.</p>
	
	<form name="activation" action="activateuser.php" method="post">
		<p><input type="text" required name="code" placeholder="Код активации" pattern="[a-zA-Z0-9]{40}" size="50%" /></p>
		<p><input type="submit" value="Активировать" /></p>
	</form>
	
	<p><a href="resendcode.php"><button>Выслать код повторно</button></a></p>
	<p><a href="logout.php"><button>Выйти</button></a></p>
</div>