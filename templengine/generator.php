<?php

include_once 'manager.php';
include_once 'engine.php';

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
