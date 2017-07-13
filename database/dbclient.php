<?php

class DataBaseClient
{
	private $db;
	private $isConnected;
	
	public function __construct()
	{
		$this->isConnected = false;
	}
	
	public function Connect()
	{
		$this->db = new mysqli(SERVER, USER, PASSWORD, BASE);
		$this->db->query("SET CHARACTER SET 'UTF8'");
		$this->db->query("SET CHARSET 'UTF8'");
		$this->db->query("SET NAMES 'UTF8'");
		$this->isConnected = true;
	}
	
	public function Disconnect()
	{
		$this->db->close();
		$this->isConnected = false;
	}
	
	public function IsConnected()
	{
		return $this->isConnected;
	}
	
	public function GetValueForTemplatesEngine($key)
	{
		if (! $this->isConnected)
		{
			return 'Не удалось подключиться к базе данных!';
		}
		
		$queryResult = $this->db->query("SELECT `value` FROM `description` WHERE `name` = '" . $key . "'");
		if ($queryResult === false)
		{
			return 'Ошибка при обращении к базе данных!';
		}
		
		if ($queryResult->num_rows == 0)
		{
			return 'Запрашиваемый элемент не найден!';
		}
		
		$res = '';
		while (($curElem = $queryResult->fetch_assoc()) !== NULL)
		{
			$res .= $curElem['value'];
			$res = nl2br($res);
		}
		return $res;
	}
	
	public function GetQuestionAnswers($question, $number, &$results)
	{
		$queryResult = $this->db->query("SELECT `results` FROM `questionnaire` WHERE `question` = '" . $question . "'");
		if ($queryResult !== false)
		{
			if ($queryResult->num_rows == 1)
			{
				$curElem = $queryResult->fetch_assoc();
				$strAnswers = $curElem['results'];
				$answers = preg_split("/-/", $strAnswers);
				
				$size = count($answers);
				for ($i = 1; $i <= $size; $i++)
				{
					$name = "A" . $number . "_" . $i;
					$results["$name"] = $answers[$i - 1];
				}
			}
		}
	}
	
	public function FindUserWithHash($hash)
	{
		$queryResult = $this->db->query("SELECT * FROM `users` WHERE `hash` = '$hash'");
		if ($queryResult === false)
		{
			return NULL;
		}
	
		if ($queryResult->num_rows != 1)	
		{
			return NULL;
		}
		
		return $queryResult->fetch_assoc();
	}
	
	public function FindUserWithLoginAndPasswd($login, $passwd)
	{
		$queryResult = $this->db->query("SELECT * FROM `users` WHERE BINARY `login` = '$login' OR `email` = '$login'");
		if ($queryResult === false)
		{
			return NULL;
		}
	
		if ($queryResult->num_rows != 1)	
		{
			return NULL;
		}
		
		$userInfo = $queryResult->fetch_assoc();
		
		$dbencpasswd = $userInfo['passwd'];
		$encpasswd = $this->MakePasswdHash($userInfo['login'], $passwd, $userInfo['sault']);
		
		if ($dbencpasswd == $encpasswd)
		{
			return $userInfo;
		}
		else
		{
			return NULL;
		}
	}
	
	public function IsUserExistsWithLogin($login)
	{
		$queryResult = $this->db->query("SELECT * FROM `users` WHERE BINARY `login` = '$login'");
		if ($queryResult === false)
		{
			return false;
		}
		if ($queryResult->num_rows > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function IsUserExistsWithEMail($email)
	{
		$queryResult = $this->db->query("SELECT * FROM `users` WHERE `email` = '$email'");
		if ($queryResult === false)
		{
			return false;
		}
		if ($queryResult->num_rows > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function AddNewUser($hash, $login, $email, $passwd, $sault, $activationCode)
	{
		$encpasswd = $this->MakePasswdHash($login, $passwd, $sault);
		
		$this->db->query(
			"INSERT INTO `users` ( `hash` , `login` , `email` , `passwd` , `sault` , `vote` , `activation` ) 
			VALUES ('$hash', '$login', '$email', '$encpasswd', '$sault', '0', '$activationCode')"
		);
	}
	
	public function SetNewActivationCode($login, $activationCode)
	{
		$this->db->query("UPDATE `users` SET `activation` = '" . $activationCode ."' WHERE BINARY `login` = '" . $login . "'");
	}
	
	public function IsActivationCodeValid($login, $code)
	{
		$queryResult = $this->db->query("SELECT `activation` FROM `users` WHERE BINARY `login` = '" . $login . "'");
		if ($queryResult === false)
		{
			return false;
		}
		if ($queryResult->num_rows != 1)
		{
			return false;
		}
		$elem = $queryResult->fetch_assoc();
		return ($elem['activation'] == $code);
	}
	
	public function ActivateUser($login)
	{
		$this->db->query("UPDATE `users` SET `activation` = 'ACTIVATED' WHERE BINARY `login` = '" . $login . "'");
	}
	
	public function UpdateUserHash($username, $hash)
	{
		$this->db->query("UPDATE `users` SET `hash` = '" . $hash ."' WHERE BINARY `login` = '" . $username . "' OR `email` = '" . $username . "'");
	}
	
	public function IsUserVoted($login)
	{
		$queryResult = $this->db->query("SELECT `vote` FROM `users` WHERE BINARY `login` = '" . $_SESSION['username'] . "'");
		if ($queryResult === false)
		{
			return false;
		}
		
		if ($queryResult->num_rows != 1)
		{
			return false;
		}
		
		$elem = $queryResult->fetch_assoc();
		return $elem['vote'] == '1';
	}
	
	private function MakePasswdHash($login, $passwd, $sault)
	{
		$enclogin = sha1($login);
		$encpasswd = sha1($passwd);
		$mixed = '';
		for ($i = 0; $i < strlen($enclogin); $i++)
		{
			$mixed .= $enclogin{$i} . $encpasswd{$i};
		}
		$hash = sha1($mixed);
		
		$mixed = '';
		for ($i = 0; $i < strlen($sault); $i++)
		{
			$mixed .= $hash{$i} . $sault{$i};
		}
		$hash = sha1($mixed);
		return $hash;
	}
}
