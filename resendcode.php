<?php
include_once 'templengine/manager.php';
include_once 'templengine/generator.php';

function SendMail($address, $code)
{
	$subject = 'oa.com - Activation code';
	$message = 'Ваш новый код активации : ' . $code . "\n";
	$message .= 'Авторизируйтесь на сайте и введите его в указанное поле.';
	mail($address, $subject, $message);
}

session_start();
$manager = new TemplatesManager();
$database = $manager->ConnectToDatabase();
if ($database == null)
{
	$generator = new PageGenerator();
	echo $generator->GetErrorPage('Не удалось подключиться к базе данных!', 'index.php?page=authorization');
	exit(1);
}

$code = $manager->GetHashCode();
$database->query("UPDATE `users` SET `activation` = '" . $code ."' WHERE BINARY `login` = '" . $_SESSION['username'] . "'");
SendMail($_SESSION['email'], $code);
$database->close();
header('Location: index.php?page=authorization');