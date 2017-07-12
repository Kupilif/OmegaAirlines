<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/oa.com/config.php';

include_once SITE_ROOT . '/database/dbclient.php';
include_once SITE_ROOT . '/templengine/generator.php';
include_once SITE_ROOT . '/api/recaptcha.php';
include_once SITE_ROOT . '/mail/mailsender.php';

class AuthorizationControl
{
	private $db;
	
	public function __construct()
	{
		if (session_id() == '')
		{	
			session_start();
		}
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
			$this->db->Connect();
		}
		catch(Excption $e)
		{
			return false;
		}
		
		$res = $this->db->IsUserVoted($this->Username());
		$this->db->Disconnect();
		return $res;
	}
	
	public function AuthorizeUser($login, $passwd, $recaptchaResponse, $rememberUser)
	{
		$generator = new PageGenerator();
		$this->db = new DatabaseClient();
		$recaptcha = new Recaptcha();
		$mailSender = new MailSender();
		
		if (!$recaptcha->IsValid($recaptchaResponse))
		{
			echo $generator->GetErrorPage('Вы – робот!', SITE_ROOT_HTML . '/index.php?page=authorization');
			exit(1);
		}
		
		try
		{
			$this->db->Connect();
		}
		catch (Excetion $e)
		{
			echo $generator->GetErrorPage('Не удалось подключиться к базе данных!', SITE_ROOT_HTML . '/index.php?page=authorization');
			exit(1);
		}
		
		$userInfo = $this->db->FindUserWithLoginAndPasswd($login, $passwd);
		if ($userInfo === NULL)
		{
			echo $generator->GetErrorPage('Неверное имя пользователя или пароль!', SITE_ROOT_HTML . '/index.php?page=authorization');
			exit(1);
		}	
		
		$_SESSION['isUserLogged'] = true;
		$_SESSION['username'] = $userInfo['login'];
		$_SESSION['email'] = $userInfo['email'];
		$_SESSION['isUserActivated'] = ($userInfo['activation'] == 'ACTIVATED');
		
		$newHash = $this->UpdateHash($userInfo['login']);
		if ($rememberUser)
		{
			setcookie('oaAuth', $newHash, time() + 30 * 24 * 60 * 60, '/');
		}
		else
		{
			setcookie('oaAuth', '', time() - 60, '/');
		}
		
		if (NEED_SECURITY_EMAIL)
		{
			$mailSender->SendSecurityNotification($this->EMail(), $this->Username());
		}
		
		$this->db->Disconnect();
		header('Location: ' . SITE_ROOT_HTML . '/index.php?page=authorization');
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
			$this->db->Connect();
		}
		catch(Excption $e)
		{
			return false;
		}
		
		$userInfo = $this->db->FindUserWithHash($savedHash);
		if ($userInfo === NULL)
		{
			setcookie('oaAuth', '', time() - 60, '/');
			return false;
		}
		
		$_SESSION['isUserLogged'] = true;
		$_SESSION['username'] = $userInfo['login'];
		$_SESSION['email'] = $userInfo['email'];
		$_SESSION['isUserActivated'] = ($userInfo['activation'] == 'ACTIVATED');
		
		$newHash = $this->UpdateHash($userInfo['login']);
		setcookie('oaAuth', $newHash, time() + 30 * 24 * 60 * 60, '/');
		
		
		$this->db->Disconnect();
		
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
		$this->db->UpdateUserHash($login, $newHash);
		return $newHash;
	}
}

