<?php

class Recaptcha
{
	public function IsValid($response)
	{
		if ($response == '') {
			return false;
		}
	
		$params = 'secret=' . '6Le5cyEUAAAAAPLw0k6Di6TpD830119NhqdCGWgF' . '&response=' . $response;

		$c = curl_init();
		if ($c === false)
		{
			return false;
		}
	
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($c, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_TIMEOUT, 3);
		curl_setopt($c, CURLOPT_POST, true);
		curl_setopt($c, CURLOPT_POSTFIELDS, $params);
		$content = curl_exec($c);
	
		if ($content === false)
		{
			//echo curl_error($c);
			return false;
		}
	
		$res = json_decode($content);
		curl_close($c);
	
		return ($res->success);
	}
}