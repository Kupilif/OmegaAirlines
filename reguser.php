<?php
include_once 'templengine/manager.php';
include_once 'templengine/generator.php';

/* Проверка, совпадают ли пароли */
function IsPasswordCorrect($passwd1, $passwd2)
{
	return (strcmp($passwd1, $passwd2) == 0);
}

/* Подключение к базе данных */
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

/* Проверка, существует ли пользователь
   с заданным логином */
function IsUserAlreadyExistsByLogin($login, $db)
{
	$searchRes = $db->query("SELECT * FROM `users` WHERE BINARY `login` = '$login'");
	if ($searchRes !== false)
	{
		if (mysqli_num_rows($searchRes) > 0)
		{
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

function IsUserAlreadyExistsByEMail($email, $db)
{
	$searchRes = $db->query("SELECT * FROM `users` WHERE `email` = '$email'");
	if ($searchRes !== false)
	{
		if (mysqli_num_rows($searchRes) > 0)
		{
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

function SendMail($address, $code)
{
	$subject = 'oa.com - Welcome!';
	$message = "Благодарим Вас за регистрацию на портале OmegaAirlines!\n";
	$message .= "Для завершения регистрации Вам необходимо ввести код активации в указанное на сайте поле.\n";
	$message .= "Ваш код активации : $code\n";
	return mail($address, $subject, $message);
}

/* Добавление нового пользователя в БД */
function AddNewUser($login, $email, $passwd, $db)
{
	$encpasswd = sha1($passwd);
	$manager = new TemplatesManager();
	$hash = $manager->GetHashCode();
	$code = $manager->GetHashCode();
	
	if (!SendMail($email, $code))
	{
		return false;
	}
	
	$query = "INSERT INTO `users` ( `hash` , `login` , `email` , `passwd` , `vote` , `activation` ) 
				VALUES ('$hash', '$login', '$email', '$encpasswd', '0', '$code')";
	$db->query($query);
	
	$_SESSION['isUserLogged'] = true;
	$_SESSION['isUserActivated'] = false;
	$_SESSION['username'] = $login;
	$_SESSION['email'] = $email;
	
	return true;
}

session_start();

$login = $_POST["login"];
$email = $_POST["email"];
$passwd = $_POST["passwd"];
$passwdrepeat = $_POST["passwdrepeat"];

if (!IsPasswordCorrect($passwd, $passwdrepeat))
{
	$generator = new PageGenerator();
	echo $generator->GetErrorPage('Пароли не совпадают!', 'index.php?page=authorization');
	exit(1);
}

$database = ConnectToDatabase();
if ($database == null)
{
	$generator = new PageGenerator();
	echo $generator->GetErrorPage('Не удалось подключиться к базе данных!', 'index.php?page=authorization');
	exit(1);
}

if (IsUserAlreadyExistsByLogin($login, $database))
{
	$database->close();
	$generator = new PageGenerator();
	echo $generator->GetErrorPage('Пользователь с таким логином уже существует!', 'index.php?page=authorization');
	exit(1);
}

if (IsUserAlreadyExistsByEMail($email, $database))
{
	$database->close();
	$generator = new PageGenerator();
	echo $generator->GetErrorPage('Пользователь с таким e-mail уже существует!', 'index.php?page=authorization');
	exit(1);
}

if (AddNewUser($login, $email, $passwd, $database))
{
	$database->close();
	header('Location: index.php?page=authorization');
}
else
{
	$database->close();
	$generator = new PageGenerator();
	echo $generator->GetErrorPage('Указан неверный email!', 'index.php?page=authorization');
}

