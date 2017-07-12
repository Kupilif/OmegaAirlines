<?php

class MailSender
{
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