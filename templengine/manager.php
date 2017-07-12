<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/oa.com/config.php';

include_once SITE_ROOT . 'templengine/data.php';
include_once SITE_ROOT . 'auth/authcontrol.php';
include_once SITE_ROOT . 'database/client.php';
include_once SITE_ROOT . 'api/currency.php';

class TemplatesManager
{	
	private $db;
	private $auth;
	
	public function __construct()
	{
		$this->auth = new AuthorizationControl();
		$this->db = new DatabaseClient();
	}
	
	public function GetQuestionNames()
	{
		return TemplatesData::$question_names;
	}
	
	public function GetErrorPageInfo($message, $link, &$pagePath, &$pageData, &$commonData)
	{
		$pagePath = SITE_ROOT . 'templates/error.tpl';
		$pageData = TemplatesData::$error_page;
		$pageData['MESSAGE'] = $message;
		$pageData['LINK'] = $link;
		$commonData = $this->GetCommonData();
	}
	
	public function GetPageInfo($pageName, &$pagePath, &$pageData, &$commonData)
	{
		switch ($pageName)
		{
			case 'index':
				$pagePath = 'templates/index.tpl';
				$pageData = TemplatesData::$data_index;
				break;
			case 'popular_routes':
				$pagePath = 'templates/popular_routes.tpl';
				$pageData = TemplatesData::$data_routes;
				break;
			case 'aircrafts':
				$pagePath = 'templates/aircrafts.tpl';
				$pageData = TemplatesData::$data_aircrafts;
				break;
			case 'friends':
				$pagePath = 'templates/friends.tpl';
				$pageData = TemplatesData::$data_friends;
				break;
			case 'documents':
				$pagePath = 'templates/documents.tpl';
				$pageData = $this->GetDataForDocumentsPage();
				break;
			case 'questions':
				$pagePath = 'templates/questions.tpl';
				$pageData = $this->GetQuestinnaire();
				break;
			case 'questionsres':
				$pagePath = 'templates/questions.tpl';
				$pageData = $this->GetResultsOfQuestinnaire();
				break;
			case 'currency':
				$pagePath = 'templates/currency.tpl';
				$pageData = $this->GetDataForCurrencyPage();
				break;
			case 'authorization':
				$pagePath = 'templates/authorization.tpl';
				$pageData = $this->GetDataForAuthorizationPage();
				break;
			default:
				$pagePath = 'templates/notfound.tpl';
				$pageData = TemplatesData::$page_404;
		}
		
		$pagePath = SITE_ROOT . $pagePath;
		$commonData = $this->GetCommonData();
	}
	
	private function GetCommonData()
	{
		$data = TemplatesData::$data_comon;
		
		if ( ($this->auth->IsUserAuthorized()) )
		{
			$data['AUTHORIZATION_PAGE_NAME'] = $this->auth->Username();
			if (!$this->auth->IsUserActvated())
			{
				$data['DOCUMENTS_PAGE_LINK'] = 'index.php?page=authorization';
				$data['QUESTIONS_PAGE_LINK'] = 'index.php?page=authorization';
			}
		}
		else
		{
			$data['DOCUMENTS_PAGE_LINK'] = 'index.php?page=authorization';
			$data['QUESTIONS_PAGE_LINK'] = 'index.php?page=authorization';
		}
		
		return $data;
	}
	
	private function GetDataForAuthorizationPage()
	{
		$data['PAGE_NUM'] = '8';
		
		if ( $this->auth->IsUserAuthorized() )
		{
			$data['TITLE'] = $this->auth->Username();
			$data['USERNAME'] = $this->auth->Username();
			
			if ($this->$auth->IsUserActivated())
			{
				$data['ISUSERLOGGED'] = '1';
			}
			else
			{
				$data['ISUSERLOGGED'] = '2';
				$data['EMAIL'] = $auth->EMail();
			}
		}
		else
		{
			$data['TITLE'] = 'Авторизация';
			$data['ISUSERLOGGED'] = '0';
		}
		
		return $data;
	}
	
	private function GetDataForCurrencyPage()
	{
		$curDay = date("Y-m-d");
		$prevDay = date("Y-m-d" ,time() - 24 * 60 * 60);
		
		$data['TITLE'] = 'Курсы валют';
		$data['PAGE_NUM'] = '7';
		$data['CURRENCY_TEXT'] = 'Курсы валют на ';
		$data['COL1_NAME'] = 'Код валюты';
		$data['COL2_NAME'] = 'Количество';
		$data['COL3_NAME'] = 'Наименование';
		$data['COL4_NAME'] = 'Официальный курс, BYN';
		$data['CUR_DATE'] = $curDay;
		$data['PREV_DATE'] = $prevDay;
		
		$currency = new Currency();
		$data['CUR_DATE_CURRENCY'] = $currency->GetCurrencyForDate($curDay);
		$data['PREV_DATE_CURRENCY'] = $currency->GetCurrencyForDate($prevDay);
	
		return $data;
	}
	
	private function GetDataForDocumentsPage()
	{
		$data['TITLE'] = 'Документы';
		$data['PAGE_NUM'] = '5';
		$data['FILES'] = $this->GetFilesList();
	
		return $data;
	}
	
	private function GetQuestinnaire()
	{
		if ($this->auth->IsUserAlreadyVote())
		{
			return $this->GetResultsOfQuestinnaire();
		}
		else
		{
			return TemplatesData::$data_questions;
		}
	}
	
	private function GetResultsOfQuestinnaire()
	{
		$res = TemplatesData::$data_questions;
		$res['TITLE'] = 'Результаты';
		$res['ACTION'] = '2';
		
		try
		{
			$this->db->Connect();
			for ($i = 1; $i <= count(TemplatesData::$question_names); $i++)
			{
				$this->db->GetQuestionAnswers(TemplatesData::$question_names[$i - 1], $i, $res);
			}
		}
		catch(Excption $e) { }
		finally
		{
			$this->db-Disconnect();
		}
		
		return $res;
	}
	
	private function GetFilesList()
	{
		$filesDir = 'files/';
		$files = scandir($filesDir);
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
