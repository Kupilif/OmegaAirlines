<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/oa.com/config.php';

include_once SITE_ROOT . '/templengine/data.php';
include_once SITE_ROOT . '/auth/authcontrol.php';
include_once SITE_ROOT . '/database/dbclient.php';
include_once SITE_ROOT . '/api/currency.php';
include_once SITE_ROOT . '/files/storagemanager.php';

class TemplatesManager
{	
	private $db;
	private $auth;
	
	public function __construct()
	{
		$this->auth = new AuthorizationControl();
		$this->db = new DatabaseClient();
	}

	public function GetErrorPageInfo($message, $link, &$pagePath, &$pageData, &$commonData)
	{
		$pagePath = SITE_ROOT . '/templates/error.tpl';
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
				$pagePath = '/templates/index.tpl';
				$pageData = TemplatesData::$data_index;
				break;
			case 'popular_routes':
				$pagePath = '/templates/popular_routes.tpl';
				$pageData = TemplatesData::$data_routes;
				break;
			case 'aircrafts':
				$pagePath = '/templates/aircrafts.tpl';
				$pageData = TemplatesData::$data_aircrafts;
				break;
			case 'friends':
				$pagePath = '/templates/friends.tpl';
				$pageData = TemplatesData::$data_friends;
				break;
			case 'documents':
				$pagePath = '/templates/documents.tpl';
				$pageData = $this->GetDataForDocumentsPage();
				break;
			case 'questions':
				$pagePath = '/templates/questions.tpl';
				$pageData = $this->GetQuestinnaire();
				break;
			case 'questionsres':
				$pagePath = '/templates/questions.tpl';
				$pageData = $this->GetResultsOfQuestinnaire();
				break;
			case 'currency':
				$pagePath = '/templates/currency.tpl';
				$pageData = $this->GetDataForCurrencyPage();
				break;
			case 'authorization':
				$pagePath = '/templates/authorization.tpl';
				$pageData = $this->GetDataForAuthorizationPage();
				break;
			default:
				$pagePath = '/templates/notfound.tpl';
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
			if (!$this->auth->IsUserActivated())
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
			
			if ($this->auth->IsUserActivated())
			{
				$data['ISUSERLOGGED'] = '1';
			}
			else
			{
				$data['ISUSERLOGGED'] = '2';
				$data['EMAIL'] = $this->auth->EMail();
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
		if ($this->auth->IsUserAuthorized())
		{
			$data['TITLE'] = 'Документы';
			$data['PAGE_NUM'] = '5';
		
			$storage = new StorageManager();
			$data['FILES'] = $storage->GetFilesList();
	
			return $data;
		}
		else
		{
			header('Location: ' . SITE_ROOT_HTML . '/index.php?page=authorization');
		}
	}
	
	private function GetQuestinnaire()
	{
		if ($this->auth->IsUserAuthorized())
		{
			if ($this->auth->IsUserVoted())
			{
				return $this->GetResultsOfQuestinnaire();
			}
			else
			{
				return TemplatesData::$data_questions;
			}
		}
		else
		{
			header('Location: ' . SITE_ROOT_HTML . '/index.php?page=authorization');
		}
	}
	
	private function GetResultsOfQuestinnaire()
	{
		if ($this->auth->IsUserAuthorized())
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
				$this->db->Disconnect();
			}

			return $res;
		}
		else
		{
			header('Location: ' . SITE_ROOT_HTML . '/index.php?page=authorization');
		}
	}
}
