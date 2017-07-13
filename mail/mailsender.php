<?php

class MailSender
{
	public function SendActivationEMail($address, $code)
	{
		$subject = 'oa.com - Welcome!';
		$message = "Благодарим Вас за регистрацию на портале OmegaAirlines!\n";
		$message .= "Для завершения регистрации Вам необходимо ввести код активации в указанное на сайте поле.\n";
		$message .= "Ваш код активации : $code\n";
		return mail($address, $subject, $message);
	}
	
	public function ResandActivationCode($address, $code)
	{
		$subject = 'oa.com - Activation code';
		$message = 'Ваш новый код активации : ' . $code . "\n";
		$message .= 'Авторизируйтесь на сайте и введите его в указанное поле.';
		mail($address, $subject, $message);
	}
	
	public function SendSecurityNotification($address, $username)
	{
		$subject = 'oa.com - Security notification';
		$message = "Уважаемый $username! В Ваш аккаунт выполнен вход со следующими параметрами:\n";
		$message .= 'Время: ' . date("r") . "\n";
		$message .= 'Браузер: ' . $this->GetBrowserName($_SERVER['HTTP_USER_AGENT']) . "\n";
		mail($address, $subject, $message);
	}
	
	private function GetBrowserName($str)
	{
		if (strpos($str, 'YaBrowser') !== false)
		{
			return 'Яндекс.Браузер';
		}
		if (strpos($str, 'Chrome') !== false)
		{
			return 'Chrome';
		}
		if (strpos($str, 'Opera') !== false)
		{
			return 'Opera';
		}
		if (strpos($str, 'Firefox') !== false)
		{
			return 'Firefox';
		}
		if (strpos($str, 'MSIE') !== false)
		{
			return 'Internet Explorer';
		}
		if (strpos($str, 'Safari') !== false)
		{
			return 'Safari';
		}
		return "Unknown browser";
	}
}