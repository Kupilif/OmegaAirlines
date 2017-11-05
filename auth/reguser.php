<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include_once SITE_ROOT . '/auth/authcontrol.php';

$auth = new AuthorizationControl();
$auth->RegisterUser($_POST["login"], $_POST["email"], $_POST["passwd"], $_POST["passwdrepeat"], $_POST["g-recaptcha-response"]);

