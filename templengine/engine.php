<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include_once SITE_ROOT . '/database/dbclient.php';

class TemplatesEngine
{
	const FILES_PATTERN = '/{FILE=\"(.+)\"}/imsU';
	const COMMON_ARRAY_PATTERN = '/{COMMON=\"(\w+)\"}/';
	const SPECIFIC_ARRAY_PATTERN = '/{VAR=\"(\w+)\"}/';
	const CONFIG_PATTERN = '/{CONFIG=\"(\w+)\"}/';
	const CONDITION_PATTERN = '/{IF \"(\d+)\"(<|>|==|!=|<=|>=)\"(\d+)\"}(.+)({ELSE}(.+))?{ENDIF}/sU';
	const DATABASE_PATTERN = '/{DB=\"(\w+)\"}/';
	
	private $configFilePath;
	private $configuration;
	private $dbclient;
	private $commonData;
	private $specificData;
	private $isConfigurationLoaded;
	private $isDatabaseConnnected;
	
	public function __construct()
	{
		$this->configFilePath = SITE_ROOT . '/templengine/config.txt';
	}
	
	/* Генерация страницы */
	public function GetPage($templatePath, &$pageData, &$common)
	{
		$this->commonData = $common;
		$this->specificData = $pageData;
		$this->LoadConfiguration();
		$this->dbclient = new DataBaseClient();
		$requestedPage = file_get_contents($templatePath);
		
		try
		{
			$this->dbclient->Connect();
		}
		catch(Exception $e) { }
		
		do
		{	
			$requestedPage = preg_replace_callback(self::COMMON_ARRAY_PATTERN, array($this, 'FromCommonArray'), $requestedPage);
			$requestedPage = preg_replace_callback(self::SPECIFIC_ARRAY_PATTERN, array($this, 'FromSpecificArray'), $requestedPage);
			$requestedPage = preg_replace_callback(self::CONFIG_PATTERN, array($this, 'FromConfigFile'), $requestedPage);
			$requestedPage = preg_replace_callback(self::DATABASE_PATTERN, array($this, 'FromDatabase'), $requestedPage);
			$requestedPage = preg_replace_callback(self::FILES_PATTERN, array($this, 'FromFile'), $requestedPage);
			$requestedPage = preg_replace_callback(self::CONDITION_PATTERN, array($this, 'WorkWithCondition'), $requestedPage);
		}
		while (
			(preg_match(self::COMMON_ARRAY_PATTERN, $requestedPage) == 1) ||
			(preg_match(self::SPECIFIC_ARRAY_PATTERN, $requestedPage) == 1) ||
			(preg_match(self::CONFIG_PATTERN, $requestedPage) == 1) ||
			(preg_match(self::DATABASE_PATTERN, $requestedPage) == 1) ||
			(preg_match(self::FILES_PATTERN, $requestedPage) == 1) ||
			(preg_match(self::CONDITION_PATTERN, $requestedPage) == 1) );
		
		$this->dbclient->Disconnect();
		return $requestedPage;
	}
	
	/* Загрузка файла конфигурации */
	private function LoadConfiguration()
	{
		if (is_file($this->configFilePath))
		{
			$this->configuration = file_get_contents($this->configFilePath);
			$this->isConfigurationLoaded = true;
		}
		else
		{
			$this->isConfigurationLoaded = false;
		}
	}
	
	/* Подстановка параметров с директивой FILE */
	private function FromFile($regexp)
	{
		$filename = $regexp[1];
		if (is_file($filename))
		{
			return file_get_contents($filename);
		}
		else
		{
			return 'Файл ' . $filename . ' не найден!';
		}
	}
	
	/* Подстановка параметров с директивой COMMON */
	private function FromCommonArray($regexp)
	{
		$key = $regexp[1];
		if (array_key_exists($key, $this->commonData))
		{
			return $this->commonData[$key];
		}
		else
		{
			return 'Переменная ' . $key . ' не найдена!';
		}
	}
	
	/* Подстановка параметров с директивой VAR */
	private function FromSpecificArray($regexp)
	{
		$key = $regexp[1];
		if (array_key_exists($key, $this->specificData))
		{
			return $this->specificData[$key];
		}
		else
		{
			return 'Переменная ' . $key . ' не найдена!';
		}
	}
	
	/* Подстановка параметров с директивой CONFIG */
	private function FromConfigFile($regexp)
	{
		if ($this->isConfigurationLoaded)
		{
			$pattern = '/' . $regexp[1] . '=([\w#%\-]+);/';
			if (preg_match($pattern, $this->configuration, $res) == 1)
			{
				return $res[1];
			}
			else
			{
				return "Параметр не найден!";
			}
		}
	}
	
	/* Подстановка параметров с директивой DB */
	private function FromDatabase($regexp)
	{
		return $this->dbclient->GetValueForTemplatesEngine($regexp[1]);
	}
	
	/* Подстановка параметров с директивой IF */
	private function WorkWithCondition($regexp)
	{	
		//var_dump($regexp);
		$var1 = $regexp[1];
		$var2 = $regexp[3];
		$op = $regexp[2];
		if ((is_numeric($var1)) && (is_numeric($var2)))
		{
			switch ($op)
			{
				case '==':
					$res = $var1 == $var2;
					break;
				case '!=':
					$res = $var1 != $var2;
					break;
				case '<':
					$res = $var1 < $var2;
					break;
				case '>':
					$res = $var1 > $var2;
					break;
				case '<=':
					$res = $var1 <= $var2;
					break;
				case '>=':
					$res = $var1 >= $var2;
					break;
				default:
					$res = false;
			}

			if ($res)
			{
				return $regexp[4];
			}
			else
			{
				if ((array_key_exists(5, $regexp)) && (array_key_exists(6, $regexp)))
				{
					return $regexp[6];
				}
				else
				{
					return '';
				}
			}
		}
		else
		{
			return $regexp[0];
		}
	}
}
