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

function IsCodeValid($code, $db)
{
	$searchRes = $db->query("SELECT `activation` FROM `users` WHERE BINARY `login` = '" . $_SESSION['username'] . "'");
	if ($searchRes !== false)
	{
		if (mysqli_num_rows($searchRes) > 0)
		{
			$elems = $searchRes->fetch_assoc();
			return ($elems['activation'] == $code);
		}
	}	
}

session_start();

$database = CTemplatesManager::ConnectToDatabase();
if ($database == null)
{
	PrintMessage("Не удалось подключиться к базе данных!");
	exit(1);
}

if (IsCodeValid($_POST['code'], $database))
{
	$_SESSION['isUserActivated'] = true;
	$database->query("UPDATE `users` SET `activation` = 'ACTIVATED' WHERE BINARY `login` = '" . $_SESSION['username'] . "'");
	$database->close();
	header('Location: index.php?page=authorization');
}
else
{
	PrintMessage('Неверный код активации!');
	$database->close();
}