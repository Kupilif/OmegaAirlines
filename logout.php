<?php
session_start();

unset($_SESSION['username']);
$_SESSION['isUserLogged'] = false;
if (isset($_COOKIE['oaAuth']))
{
	setcookie('oaAuth', '', time() - 60);
}

header('Location: index.php?page=authorization');