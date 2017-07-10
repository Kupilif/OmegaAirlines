<?php
include 'templengine/generator.php';

	session_start();
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
?>