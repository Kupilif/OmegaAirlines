<?php
include 'templengine/manager.php';
include 'templengine/engine.php';

	session_start();
	/* Проверка, передано ли имя запрашиваемой страницы */
	if (isset($_GET['page']))
	{
		$reqPage = $_GET['page'];
	}
	else
		$reqPage = 'index';
	
	CTemplatesManager::GetPageInfo($reqPage, $pagePath, $pageData, $commonData);
	$engine = new CTemplatesEngine();
	$page = $engine->GetPage($pagePath, $pageData, $commonData);
	
	/* Вывод готовой страницы */
	echo $page;
?>