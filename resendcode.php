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

function SendMail($address, $code)
{
	$subject = 'oa.com - Activation code';
	$message = 'Ваш новый код активации : ' . $code . "\n";
	$message .= 'Авторизируйтесь на сайте и введите его в указанное поле.';
	mail($address, $subject, $message);
}

session_start();

$database = CTemplatesManager::ConnectToDatabase();
if ($database == null)
{
	PrintMessage("Не удалось подключиться к базе данных!");
	exit(1);
}

$code = CTemplatesManager::GetHashCode();
$database->query("UPDATE `users` SET `activation` = '" . $code ."' WHERE BINARY `login` = '" . $_SESSION['username'] . "'");
SendMail($_SESSION['email'], $code);
$database->close();
header('Location: index.php?page=authorization');