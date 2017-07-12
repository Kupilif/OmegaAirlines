<?php

include_once 'config.php';

include SITE_ROOT . 'templengine/generator.php';

$generator = new PageGenerator();

if (isset($_GET['page']))
{
	$pageData = null;
	$commonData = null;
	$page = $generator->GetSpecificPage($_GET['page'], $pageData, $commonData);
}
else
{
	$page = $generator->GetIndexPage();
}

echo $page;
