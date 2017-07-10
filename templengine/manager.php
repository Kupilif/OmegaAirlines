<?php

class TemplatesManager
{	
	public static function GetHashCode($length = 10)
	{
		$chars = 'ABCDEFGHIJKLMNOPQRSTYVWXYZabcdefghijklmnopqrstuvwxyz0123456789 ';
		$charslen = strlen($chars) - 1;
		$code = '';
		
		for ($i = 0; $i < $length; $i++)
		{
			$code .= $chars{mt_rand(0, $charslen)};
		}
		
		return sha1($code);
	}
	
	public static function GetQuestionNames()
	{
		return TemplatesData::$question_names;
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
				$pageData = self::GetDataForDocumentsPage();
				break;
			case 'questions':
				$pagePath = 'templates/questions.tpl';
				$pageData = self::GetQuestinnaire();
				break;
			case 'questionsres':
				$pagePath = 'templates/questions.tpl';
				$pageData = self::GetResultsOfQuestinnaire();
				break;
			case 'currency':
				$pagePath = 'templates/currency.tpl';
				$pageData = self::GetDataForCurrencyPage();
				break;
			case 'authorization':
				$pagePath = 'templates/authorization.tpl';
				$pageData = self::GetDataForAuthorizationPage();
				break;
			default:
				$pagePath = 'templates/index.tpl';
				$pageData = self::$data_index;
		}
		
		$pagePath = $_SERVER['DOCUMENT_ROOT'] . '/oa.com/' . $pagePath;
		$commonData = self::GetCommonData();
	}
	
	private function GetCommonData()
	{
		$data = TemplatesData::$data_comon;
		
		if ( (self::IsUserAuthorized()) )
		{
			$data['AUTHORIZATION_PAGE_NAME'] = $_SESSION['username'];
			if (!$_SESSION['isUserActivated'])
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
		
		if ( self::IsUserAuthorized() )
		{
			$data['TITLE'] = $_SESSION['username'];
			$data['USERNAME'] = $_SESSION['username'];
			
			if ($_SESSION['isUserActivated'])
			{
				$data['ISUSERLOGGED'] = '1';
			}
			else
			{
				$data['ISUSERLOGGED'] = '2';
				$data['EMAIL'] = $_SESSION['email'];
			}
		}
		else
		{
			$data['TITLE'] = 'Авторизация';
			$data['ISUSERLOGGED'] = '0';
		}
		
		return $data;
	}
	
	public static function IsUserAuthorized()
	{
		if ( ((isset($_SESSION['isUserLogged'])) && ($_SESSION['isUserLogged'] == true)) )
		{
			return true;
		}
		else
		{
			return (self::IsAuthorisationInCookies());
		}
	}
	
	private function IsAuthorisationInCookies()
	{
		if (!isset($_COOKIE['oaAuth']))
		{
			return false;
		}
			
		$savedHash = $_COOKIE['oaAuth'];
		$database = self::ConnectToDatabase();
		if ($database == null)
		{
			
			return false;
		}
			
		$searchRes = $database->query("SELECT * FROM `users` WHERE `hash` = '$savedHash'");
		if ($searchRes === false)
		{
			$database->close();
			setcookie('oaAuth', '', time() - 60);
			return false;
		}
		
		if (mysqli_num_rows($searchRes) != 1)
		{
			$database->close();
			setcookie('oaAuth', '', time() - 60);
			return false;
		}
		
		$elems = $searchRes->fetch_assoc();
		$_SESSION['isUserLogged'] = true;
		$_SESSION['username'] = $elems['login'];
		$_SESSION['email'] = $elems['email'];
		$_SESSION['isUserActivated'] = ($elems['activation'] == 'ACTIVATED');
		self::UpdateHash($elems['login'], $database);
		$database->close();
		
		return true;
	}
	
	private function UpdateHash($login, $db)
	{
		$newHash = self::GetHashCode();
		$db->query("UPDATE `users` SET `hash` = '" . $newHash ."' WHERE BINARY `login` = '" . $login . "'");
		setcookie('oaAuth', $newHash, time() + 30 * 24* 60 * 60);
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
		$data['CUR_DATE_CURRENCY'] = self::GetCurrencyForDate($curDay);
		$data['PREV_DATE_CURRENCY'] = self::GetCurrencyForDate($prevDay);
	
		return $data;
	}
	
	private  function GetCurrencyForDate($date)
	{
		$link = "http://www.nbrb.by/API/ExRates/Rates?Periodicity=0&onDate=" . $date;
		
		$request = curl_init($link);
		curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($request, CURLOPT_HEADER, 0);
		curl_setopt($request, CURLOPT_TIMEOUT, 3);
		$answer = curl_exec($request);
		curl_close($request);
	
		if ($answer === false)
		{
			return "Не удалось получить курсы валют для даты " . $date;
		}
		else
		{
			$res = '<table class="currency_table" width={CONFIG="CURRENCY_TABLE_WIDTH"} align="{CONFIG="CURRENCY_TABLE_ALIGN"}">';
			$res .= '<tr class="caption" align="{CONFIG="CURRENCY_TABLE_CONTENT_ALIGN"}">';
			$res .= '<td class="border" width={CONFIG="CURRENCY_COL1_WIDTH"}>{VAR="COL1_NAME"}</td>';
			$res .= '<td class="border" width={CONFIG="CURRENCY_COL2_WIDTH"}>{VAR="COL2_NAME"}</td>';
			$res .= '<td class="border" width={CONFIG="CURRENCY_COL3_WIDTH"}>{VAR="COL3_NAME"}</td>';
			$res .= '<td class="border" width={CONFIG="CURRENCY_COL4_WIDTH"}>{VAR="COL4_NAME"}</td>';
			$res .= '</tr>';
			
			$currency = json_decode($answer);
			for ($i = 0; $i < count($currency); $i++)
			{
				if (($i + 1) % 2 == 0)
				{
					$curClass = "even_row";
				}
				else
				{
					$curClass = "odd_row";
				}	
				$res .= '<tr class="' . $curClass . '" align="{CONFIG="CURRENCY_TABLE_CONTENT_ALIGN"}">';
				$res .= "<td class=\"border column1\">{$currency[$i]->Cur_Abbreviation}</td>";
				$res .= "<td class=\"border column2\">{$currency[$i]->Cur_Scale}</td>";
				$res .= "<td class=\"border column3\">{$currency[$i]->Cur_Name}</td>";
				$res .= "<td class=\"border column4\">{$currency[$i]->Cur_OfficialRate}</td>";
				$res .= '</tr>';
			}
			
			$res .= '</table>';
			return $res;
		}
	}
	
	private function GetDataForDocumentsPage()
	{
		$data['TITLE'] = 'Документы';
		$data['PAGE_NUM'] = '5';
		$data['FILES'] = self::GetFilesList();
	
		return $data;
	}
	
	private function IsUserAlreadyVote()
	{
		$db = self::ConnectToDatabase();
		if ($db == null)
		{
			return false;
		}
		
		$searchRes = $db->query("SELECT * FROM `users` WHERE BINARY `login` = '" . $_SESSION['username'] . "'");
		if ($searchRes === false)
		{
			return false;
		}
		
		if (mysqli_num_rows($searchRes) != 1)
		{
			return false;
		}
		
		$elems = $searchRes->fetch_assoc();
		if ($elems['vote'] == 0)
		{
			$db->close();
			return false;
		}
		else
		{
			$db->close();
			return true;
		}
	}
	
	private function GetQuestinnaire()
	{
		if (self::IsUserAlreadyVote())
		{
			return self::GetResultsOfQuestinnaire();
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
		
		$database = self::ConnectToDatabase();
		if ($database != null)
		{
			for ($i = 1; $i <= count(TemplatesData::$question_names); $i++)
			{
				self::LoadAnswersFromDatabase(TemplatesData::$question_names[$i - 1], $i, $res, $database);
			}
			$database->close();
		}
		
		return $res;
	}
	
	public static function ConnectToDatabase()
	{
		$database = new mysqli('localhost', 'root', '2019755', 'site');
		if ($database != null)
		{
			$database->query("SET CHARACTER SET 'UTF8'");
			$database->query("SET CHARSET 'UTF8'");
			$database->query("SET NAMES 'UTF8'");
			return $database;
		}
		else
		{
			return null;
		}
	}
	
	private function LoadAnswersFromDatabase($question, $number, &$results, $db)
	{
		$searchRes = $db->query("SELECT `results` FROM `questionnaire` WHERE `question` = '" . $question . "'");
		if ($searchRes !== false)
		{
			if (mysqli_num_rows($searchRes) > 0)
			{
				$elem = $searchRes->fetch_assoc();
				$strAnswers = $elem['results'];
				$answers = preg_split("/-/", $strAnswers);
				
				$size = count($answers);
				for ($i = 1; $i <= $size; $i++)
				{
					$name = "A" . $number . "_" . $i;
					$results["$name"] = $answers[$i - 1];
				}
			}
		}
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