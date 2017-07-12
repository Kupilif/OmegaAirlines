<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/oa.com/config.php';

include_once SITE_ROOT . 'templengine/manager.php';
include_once SITE_ROOT . 'templengine/engine.php';

class PageGenerator
{
	public function GetSpecificPage($reqPage)
	{
		$manager = new TemplatesManager();
		$engine = new TemplatesEngine();
		$manager->GetPageInfo($reqPage, $pagePath, $pageData, $commonData);
		return $engine->GetPage($pagePath, $pageData, $commonData);
	}
	
	public function GetIndexPage()
	{
		$manager = new TemplatesManager();
		$engine = new TemplatesEngine();
		$manager->GetPageInfo('index', $pagePath, $pageData, $commonData);
		return $engine->GetPage($pagePath, $pageData, $commonData);
	}
	
	public function GetErrorPage($message, $link)
	{
		$manager = new TemplatesManager();
		$engine = new TemplatesEngine();
		$manager->GetErrorPageInfo($message, $link, $pagePath, $pageData, $commonData);
		return $engine->GetPage($pagePath, $pageData, $commonData);
	}
}
