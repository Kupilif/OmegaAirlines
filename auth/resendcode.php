<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include_once SITE_ROOT . '/auth/authcontrol.php';

$auth = new AuthorizationControl();
$auth->ResendActivationCode();

