<?php

include 'config.php';

class DataBaseClient
{
	private $db;
	private $isConnected;
	
	public function __construct()
	{
		$this->isConnected = false;
	}
	
	public function Connect()
	{
		$this->db = new mysqli(SERVER, USER, PASSWORD, BASE);
		$this->db->query("SET CHARACTER SET 'UTF8'");
		$this->db->query("SET CHARSET 'UTF8'");
		$this->db->query("SET NAMES 'UTF8'");
		$this->isConnected = true;
	}
	
	public function Disconnect()
	{
		$this->db->close();
		$this->isConnected = false;
	}
	
	public function IsConnected()
	{
		return $this->isConnected;
	}
	
	public function GetValueForTemplatesEngine($key)
	{
		if (! $this->isConnected)
		{
			return 'Не удалось подключиться к базе данных!';
		}
		
		$queryResult = $this->db->query("SELECT `value` FROM `description` WHERE `name` = '" . $key . "'");
		if ($queryResult === false)
		{
			return 'Ошибка при обращении к базе данных!';
		}
		
		if ($queryResult->num_rows == 0)
		{
			return 'Запрашиваемый элемент не найден!';
		}
		
		$res = '';
		while (($curElem = $queryResult->fetch_assoc()) !== NULL)
		{
			$res .= $curElem['value'];
			$res = nl2br($res);
		}
		return $res;
	}
}
