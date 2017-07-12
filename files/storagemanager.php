<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/oa.com/config.php';

define('STORAGE_ROOT', SITE_ROOT . '/STORAGE');

class StorageManager
{
	public function GetFilesList()
	{
		if (!file_exists(STORAGE_ROOT))
		{
			mkdir(STORAGE_ROOT);
		}
		$files = scandir(STORAGE_ROOT);
		$res = "<table>";
	
		for ($i = 2; $i < count($files); $i++)
		{
			$path = $filesDir . $files[$i];
		
			$res .= "<tr>";
		
			$res .= "<td><a href=\"deletefile.php?filename={$files[$i]}\"><button>Удалить</button></a></td>";
		
			$res .= "<td>";
		
			$res .= "<a href=\"$path\" target=\"_blank\">{$files[$i]}</a>";
		
			$res .= "</td>";
			$res .= "</tr>";
		}
	
		$res .= "</table>";
		return $res;
	}
}