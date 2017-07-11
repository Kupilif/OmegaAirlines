<?php
include_once 'templengine/manager.php';
include_once 'templengine/genrator.php';

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

$manager = new TemplatesManager();
$database = $manager->ConnectToDatabase();
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
	$database->close();
	$generator = new PageGenerator();
	echo $generator->GetErrorPage('Неверный код активации!', 'index.php?page=authorization');
}
