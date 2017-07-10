<?php
include 'templengine/manager.php';

/* Вывод сообщения об ошибке */
function PrintMessage($messg)
{
	$res = "<div align=center>";
	$res .= "<p>" . $messg . "</p>";
	$res .= "<a href=\"index.php?page=authorization\"><button>Назад</button></a>";
	$res .= "</div>";
	echo $res;
}

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
	$hash = CTemplatesManager::GetHashCode();
	$code = CTemplatesManager::GetHashCode();
	
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
	PrintMessage("Пароли не совпадают!");
	exit(1);
}

$database = ConnectToDatabase();
if ($database == null)
{
	PrintMessage("Не удалось подключиться к базе данных!");
	exit(1);
}

if (IsUserAlreadyExistsByLogin($login, $database))
{
	PrintMessage("Пользователь с таким логином уже существует!");
	$database->close();
	exit(1);
}

if (IsUserAlreadyExistsByEMail($email, $database))
{
	PrintMessage("Пользователь с таким e-mail уже существует!");
	$database->close();
	exit(1);
}

if (AddNewUser($login, $email, $passwd, $database))
{
	$database->close();
	header('Location: index.php?page=authorization');
}
else
{
	PrintMessage("Указан неверный email!");
	$database->close();
}

