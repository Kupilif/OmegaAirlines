<?php
	
include_once $_SERVER['DOCUMENT_ROOT'] . '/oa.com/config.php';

include_once SITE_ROOT . '/files/storagemanager.php';

$storage = new StorageManager();
$storage->UploadFile();

	