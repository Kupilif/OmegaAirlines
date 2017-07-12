<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/oa.com/config.php';

include_once SITE_ROOT . 'database/client.php';

class AuthorizationControl
{
	private $db;
	
	public function __construct()
	{
		session_start();
		$this->db = new DatabaseClient();
	}
	
	public function Username()
	{
		if (isset($_SESSION['username']))
		{
			return $_SESSION['username'];
		}
		else
		{
			return NULL;
		}
	}
	
	public function EMail()
	{
		if (isset($_SESSION['email']))
		{
			return $_SESSION['email'];
		}
		else
		{
			return NULL;
		}
	}
	
	public function IsUserAuthorized()
	{
		if ( ((isset($_SESSION['isUserLogged'])) && ($_SESSION['isUserLogged'] == true)) )
		{
			return true;
		}
		else
		{
			return ($this->IsAuthorisationInCookies());
		}
	}
	
	public function IsUserActivated()
	{
		if ( ((isset($_SESSION['isUserActivated'])) && ($_SESSION['isUserActivated'] == true)) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function IsUserVoted()
	{
		try
		{
			$this->$db->Connect();
		}
		catch(Excption $e)
		{
			return false;
		}
		
		$res = $this->$db->IsUserVoted($this->Username());
		$this->$db->Disconnect();
		return $res;
	}
	
	private function IsAuthorisationInCookies()
	{
		if (!isset($_COOKIE['oaAuth']))
		{
			return false;
		}
			
		$savedHash = $_COOKIE['oaAuth'];
		
		try
		{
			$this->$db->Connect();
		}
		catch(Excption $e)
		{
			return false;
		}
		
		$userInfo = $this->$db->FindUserWithHash($savedHash);
		if ($userInfo === NULL)
		{
			setcookie('oaAuth', '', time() - 60);
			return false;
		}
		
		$_SESSION['isUserLogged'] = true;
		$_SESSION['username'] = $userInfo['login'];
		$_SESSION['email'] = $userInfo['email'];
		$_SESSION['isUserActivated'] = ($userInfo['activation'] == 'ACTIVATED');
		
		$this->UpdateHash($userInfo['login']);
		
		$this->$db->Disconnect();
		
		return true;
	}
	
	private function GetRandomHash($length)
	{
		$chars = 'ABCDEFGHIJKLMNOPQRSTYVWXYZabcdefghijklmnopqrstuvwxyz0123456789 ';
		$charslen = strlen($chars) - 1;
		$code = '';
		
		for ($i = 0; $i < $length; $i++)
		{
			$code .= $chars{mt_rand(0, $charslen)};
		}
		
		return sha1($code);
	}
	
	private function UpdateHash($login)
	{
		$newHash = $this->GetRandomHash(50);
		$db->UpdateUserHash($login, $newHash);
		setcookie('oaAuth', $newHash, time() + 30 * 24* 60 * 60);
	}
}

