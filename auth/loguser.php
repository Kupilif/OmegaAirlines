<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/oa.com/config.php';

include_once SITE_ROOT . '/auth/authcontrol.php';

$auth = new AuthorizationControl();
$auth->AuthorizeUser($_POST["login"], $_POST["passwd"], isset($_POST['rememberUser']));

