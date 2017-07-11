<?php
include_once 'templengine/manager.php';
include_once 'templengine/generator.php';

function GetBrowserName($str)
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

function ConnectToDatabase()
{
	$db = new mysqli('localhost', 'root', '2019755', 'site');
	if ($db == null)
	{
		return null;
	}
	
	$db->query("SET CHARACTER SET 'UTF8'");
	$db->query("SET CHARSET 'UTF8'");
	$db->query("SET NAMES 'UTF8'");
	return $db;
}

function SendMail($address, $username)
{
	$subject = 'oa.com - Security notification';
	$message = "Уважаемый $username! В Ваш аккаунт выполнен вход со следующими параметрами:\n";
	$message .= 'Время: ' . date("r") . "\n";
	$message .= 'Браузер: ' . GetBrowserName($_SERVER['HTTP_USER_AGENT']) . "\n";
	mail($address, $subject, $message);
}

function IsUserInDatabase($login, $passwd, $db, &$hash)
{
	$searchRes = $db->query("SELECT * FROM `users` WHERE BINARY `login` = '$login' OR `email` = '$login'");
	if ($searchRes !== false)
	{
		if (mysqli_num_rows($searchRes) > 0)
		{
			$elems = $searchRes->fetch_assoc();
			$dbencpasswd = $elems['passwd'];
			$encpasswd = sha1($passwd);
			if ($dbencpasswd == $encpasswd)
			{
				$manager = new TemplatesManager();
				$newHash = $manager->GetHashCode();
				$db->query("UPDATE `users` SET `hash` = '" . $newHash ."' WHERE BINARY `login` = '" . $login . "' OR `email` = '" . $login . "'");
				$hash = $newHash;
				
				$_SESSION['username'] = $elems['login'];
				$_SESSION['email'] = $elems['email'];
				$_SESSION['isUserActivated'] = ($elems['activation'] == 'ACTIVATED');
				
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

function IsUserRobot()
{
	$answer = $_POST["g-recaptcha-response"];
	if ($answer == '') {
		return true;
	}
	
	$params = 'secret=' . '6Le5cyEUAAAAAPLw0k6Di6TpD830119NhqdCGWgF' . '&response=' . $answer;

	$c = curl_init();
	if ($c === false)
	{
		return true;
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
		return true;
	}
	
	$res = json_decode($content);
	curl_close($c);
	
	return !($res->success);
}

session_start();

$login = $_POST["login"];
$passwd = $_POST["passwd"];

$database = ConnectToDatabase();
if ($database == null)
{
	PrintMessage("Не удалось подключиться к базе данных!");
	exit(1);
}

if (isset($_POST['rememberUser']))
{
	$remember = true;
}
else
{
	$remember = false;
}

if (IsUserRobot())
{
	$generator = new PageGenerator();
	echo $generator->GetErrorPage('Вы – робот!', 'index.php?page=authorization');
	exit(1);
}

$hash = '';
if (IsUserInDatabase($login, $passwd, $database, $hash))
{
	$_SESSION['isUserLogged'] = true;
	
	if (isset($_POST['rememberUser']))
	{
		setcookie('oaAuth', $hash, time() + 30 * 24 * 60 * 60);
	}
	else
	{
		setcookie('oaAuth', '', time() - 60);
	}
	$database->close();
	SendMail($_SESSION['email'], $_SESSION['username']);
	header('Location: index.php?page=authorization');
}
else
{
	$generator = new PageGenerator();
	echo $generator->GetErrorPage('Неверное имя пользователя или пароль!', 'index.php?page=authorization');
}

$database->close();
