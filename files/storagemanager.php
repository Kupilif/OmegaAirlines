<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/oa.com/config.php';

include_once SITE_ROOT . '/templengine/generator.php';
include_once SITE_ROOT . '/auth/authcontrol.php';

define('STORAGE_ROOT', SITE_ROOT . '/STORAGE');
define('STORAGE_ROOT_DOWNLOAD', SITE_ROOT_HTML . '/STORAGE');
define('CURRENT_DIR', '.');
define('PARENT_DIR', '..');

class StorageManager
{
	public function GetFilesList($username)
	{
		if (!file_exists(STORAGE_ROOT))
		{
			mkdir(STORAGE_ROOT);
		}
		
		$currentDir = STORAGE_ROOT . '/' . $username;
		if (!file_exists($currentDir))
		{
			mkdir($currentDir);
		}
		
		$files = scandir($currentDir);
		
		$res = "<table>";
	
		for ($i = 0; $i < count($files); $i++)
		{
			if ( ($files[$i] != CURRENT_DIR) && ($files[$i] != PARENT_DIR) )
			{
				$path = STORAGE_ROOT_DOWNLOAD . '/' . $username . '/' . $files[$i];
		
				$res .= '<td><a href={COMMON="DELETE_FILE_SCRIPT"}?filename=' . $files[$i] . '"><button>Удалить</button></a></td>';
		
				$res .= "<td>";
		
				$res .= "<a href=\"$path\" target=\"_blank\">{$files[$i]}</a>";
		
				$res .= "</td>";
				$res .= "</tr>";
			}
		}
	
		$res .= "</table>";
		return $res;
	}
	
	public function UploadFile()
	{
		$generator = new PageGenerator();
		$auth = new AuthorizationControl();
		if (!$auth->IsUserAuthorized())
		{
			header('Location: ' . SITE_ROOT_HTML . '/index.php?page=authorization');
		}
		
		if (!isset($_FILES['uploadfile']))
		{
			echo $generator->GetErrorPage('Необходимо загрузить файл!', SITE_ROOT_HTML . '/index.php?page=documents');
			exit(1);
		}
		
		$currentDir = STORAGE_ROOT . '/' . $auth->Username();
		$fileInfo = pathinfo($_FILES['uploadfile']['name']);
		if (strcasecmp($fileInfo['extension'], 'php') == 0)
		{
			echo $generator->GetErrorPage('Нельзя загружать файлы данного типа!', SITE_ROOT_HTML . '/index.php?page=documents');
			exit(1);
		}
			
		$newFilePath = $currentDir . '/' . $fileInfo['basename'];
				
		if (!move_uploaded_file($_FILES['uploadfile']['tmp_name'], $newFilePath))
		{
			echo $generator->GetErrorPage('Ошибка при загрузке файла!', SITE_ROOT_HTML . '/index.php?page=documents');
			exit(1);
			
		}

		header('Location: ' . SITE_ROOT_HTML . '/index.php?page=documents');
	}
	
	public function DeleteFile()
	{
		$generator = new PageGenerator();
		$auth = new AuthorizationControl();
		if (!$auth->IsUserAuthorized())
		{
			header('Location: ' . SITE_ROOT_HTML . '/index.php?page=authorization');
		}

		if (!isset($_GET['filename']))
		{
			echo $generator->GetErrorPage('Необходимо указать файл для удаления!', SITE_ROOT_HTML . '/index.php?page=documents');
			exit(1);
		}
		
		$currentDir = STORAGE_ROOT . '/' . $auth->Username();
		$filePath = $currentDir . '/' . $_GET['filename'];
		if (!file_exists($filePath))
		{
			echo $generator->GetErrorPage('Указанный файл не найден!', SITE_ROOT_HTML . '/index.php?page=documents');
			exit(1);		
		}

		if (!unlink($filePath))
		{
			echo $generator->GetErrorPage('Ошибка удаления файла!', SITE_ROOT_HTML . '/index.php?page=documents');
			exit(1);
		}
		
		header('Location: ' . SITE_ROOT_HTML . '/index.php?page=documents');
	}
}