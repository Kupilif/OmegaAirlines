<?php

class CTemplatesManager
{
	private static $data_comon = array (
		'MOTTO' => 'OmegaAirlines — комфорт и надёжность!',
		'INDEX_PAGE_LINK' => '"index.php?page=index"',
		'ROUTES_PAGE_LINK' => '"index.php?page=popular_routes"',
		'AIRCRAFTS_PAGE_LINK' => '"index.php?page=aircrafts"',
		'FRIENDS_PAGE_LINK' => '"index.php?page=friends"',
		'DOCUMENTS_PAGE_LINK' => '"index.php?page=documents"',
		'QUESTIONS_PAGE_LINK' => '"index.php?page=questions"',
		'CURRENCY_PAGE_LINK' => '"index.php?page=currency"',
		'AUTHORIZATION_PAGE_LINK' => '"index.php?page=authorization"',
		'INDEX_PAGE_NAME' => 'Главная',
		'ROUTES_PAGE_NAME' => 'Популярные направления',
		'AIRCRAFTS_PAGE_NAME' => 'Наш авиапарк',
		'FRIENDS_PAGE_NAME' => 'Наши партнёры',
		'DOCUMENTS_PAGE_NAME' => 'Документы',
		'QUESTIONS_PAGE_NAME' => 'Опрос',
		'CURRENCY_PAGE_NAME' => 'Курсы валют',
		'AUTHORIZATION_PAGE_NAME' => 'Авторизация',
		'COPYRIGHT' => '&copyOmegaAirlines 2017, RD TC',
		'STYLES' => '"styles/style.css"',
	);
	
	private static $data_index = array (
		'TITLE' => 'Главная',
		'PAGE_NUM' => '1',
		'LOGO1' => '"images/main/logo.png"',
		'LOGO2' => '"images/main/sale.png"',
		'LOGO3' => '"images/main/comfort.png"',
		'LOGO4' => '"images/main/safe.png"',
	);
	
	private static $data_routes = array (
		'TITLE' => 'Популярные направления',
		'PAGE_NUM' => '2',
		'ROUTE1_IMG' => '"images/routes/newyork.jpg"',
		'ROUTE2_IMG' => '"images/routes/london.jpg"',
		'ROUTE3_IMG' => '"images/routes/paris.jpg"',
		'ROUTE4_IMG' => '"images/routes/dubai.jpg"',
		'ROUTE5_IMG' => '"images/routes/barcelona.jpg"',
	);
	
	private static $data_aircrafts = array (
		'TITLE' => 'Наш авиапарк',
		'PAGE_NUM' => '3',
		'PLANE1_NAME' => '"Boeing 737 Wargaming"',
		'PLANE1_IMG1' => '"images/planes/1_boeing737wg.jpg"',
		'PLANE1_IMG2' => '"images/planes/2_boeing737wg.jpg"',
		'PLANE1_IMG3' => '"images/planes/3_boeing737wg.jpg"',
		'PLANE2_NAME' => '"Boeing 747"',
		'PLANE2_IMG1' => '"images/planes/1_boeing747.jpg"',
		'PLANE2_IMG2' => '"images/planes/2_boeing747.jpg"',
		'PLANE2_IMG3' => '"images/planes/3_boeing747.jpg"',
		'PLANE3_NAME' => '"Airbus A380"',
		'PLANE3_IMG1' => '"images/planes/1_airbus_a380.jpg"',
		'PLANE3_IMG2' => '"images/planes/2_airbus_a380.jpg"',
		'PLANE3_IMG3' => '"images/planes/3_airbus_a380.jpg"',
		'PLANE4_NAME' => '"Boeing 787"',
		'PLANE4_IMG1' => '"images/planes/1_boeing787.jpg"',
		'PLANE4_IMG2' => '"images/planes/2_boeing787.jpg"',
		'PLANE4_IMG3' => '"images/planes/3_boeing787.jpg"',
		'PLANE5_NAME' => '"Airbus A330"',
		'PLANE5_IMG1' => '"images/planes/1_airbus_a330.jpg"',
		'PLANE5_IMG2' => '"images/planes/2_airbus_a330.jpg"',
		'PLANE5_IMG3' => '"images/planes/3_airbus_a330.jpg"',
		'PLANE6_NAME' => '"Airbus A320neo"',
		'PLANE6_IMG1' => '"images/planes/1_airbus_a320_neo.jpg"',
		'PLANE6_IMG2' => '"images/planes/2_airbus_a320_neo.jpg"',
		'PLANE6_IMG3' => '"images/planes/3_airbus_a320_neo.jpg"',
	);
	
	private static $data_friends = array (
		'TITLE' => 'Наши партнёры',
		'PAGE_NUM' => '4',
		'FRIEND1_LINK' => '"https://www.aa.com"',
		'FRIEND1_LOGO' => '"images/companies/american_airlines.jpg"',
		'FRIEND2_LINK' => '"https://www.britishairways.com"',
		'FRIEND2_LOGO' => '"images/companies/british_airways.jpg"',
		'FRIEND3_LINK' => '"http://www.aeroflot.ru"',
		'FRIEND3_LOGO' => '"images/companies/aeroflot.png"',
		'FRIEND4_LINK' => '"http://www.airfrance.ru"',
		'FRIEND4_LOGO' => '"images/companies/air_france.jpg"',
		'FRIEND5_LINK' => '"https://belavia.by"',
		'FRIEND5_LOGO' => '"images/companies/belavia.jpg"',
		'FRIEND6_LINK' => '"http://www.airarabia.com"',
		'FRIEND6_LOGO' => '"images/companies/airarabia.png"',
		'FRIEND7_LINK' => '"https://www.brusselsairlines.com"',
		'FRIEND7_LOGO' => '"images/companies/brussels_airlines.jpg"',
		'FRIEND8_LINK' => '"https://www.klmcityhopper.nl/"',
		'FRIEND8_LOGO' => '"images/companies/klm.png"',
		'FRIEND9_LINK' => '"http://www.jetairways.com/IN/"',
		'FRIEND9_LOGO' => '"images/companies/jet_airways.png"',
	);
	
	private static $data_questions = array (
		'TITLE' => 'Опрос',
		'PAGE_NUM' => '6',
		'ACTION' => '1',
		'Q1' => 'Ваш пол',
		'Q2' => 'Ваш возраст',
		'Q3' => 'Сколько раз Вы летали нашей авиакомпанией',
		'Q4' => 'Оцените качество перелёта',
		'Q5' => 'Оцените качество обслуживания во время полёта',
		'Q6' => 'Оцените информативность и удобство сайта',
		'Q1_NAME' => 'gender',
		'Q2_NAME' => 'age',
		'Q3_NAME' => 'amount',
		'Q4_NAME' => 'flight',
		'Q5_NAME' => 'service',
		'Q6_NAME' => 'site',
		'Q1_1' => 'Мужской',
		'Q1_2' => 'Женский',
		'Q2_1' => '<18',
		'Q2_2' => '18-25',
		'Q2_3' => '25-35',
		'Q2_4' => '35-50',
		'Q2_5' => '>50',
		'Q3_1' => '<5',
		'Q3_2' => '5-10',
		'Q3_3' => '>10',
		'Q4_1' => 'Отлично',
		'Q4_2' => 'Хорошо',
		'Q4_3' => 'Удовлетворительно',
		'Q4_4' => 'Плохо',
	);
	
	private static $question_names = array (
		0 => 'gender',
		1 => 'age',
		2 => 'amount',
		3 => 'flight',
		4 => 'service',
		5 => 'site'
	);
	
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
		return self::$question_names;
	}
	
	public static function GetPageInfo($pageName, &$pagePath, &$pageData, &$commonData)
	{
		switch ($pageName)
		{
			case 'index':
				$pagePath = 'templates/index.tpl';
				$pageData = self::$data_index;
				break;
			case 'popular_routes':
				$pagePath = 'templates/popular_routes.tpl';
				$pageData = self::$data_routes;
				break;
			case 'aircrafts':
				$pagePath = 'templates/aircrafts.tpl';
				$pageData = self::$data_aircrafts;
				break;
			case 'friends':
				$pagePath = 'templates/friends.tpl';
				$pageData = self::$data_friends;
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
	
	private static function GetCommonData()
	{
		$data = self::$data_comon;
		
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
	
	private static function GetDataForAuthorizationPage()
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
	
	private static function IsAuthorisationInCookies()
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
	
	private static function UpdateHash($login, $db)
	{
		$newHash = self::GetHashCode();
		$db->query("UPDATE `users` SET `hash` = '" . $newHash ."' WHERE BINARY `login` = '" . $login . "'");
		setcookie('oaAuth', $newHash, time() + 30 * 24* 60 * 60);
	}
	
	private static function GetDataForCurrencyPage()
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
	
	private static function GetCurrencyForDate($date)
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
			$res .= '<td class="border" width={CONFIG="CURRENCY_COL1_WIDTH"}>{COL1_NAME}</td>';
			$res .= '<td class="border" width={CONFIG="CURRENCY_COL2_WIDTH"}>{COL2_NAME}</td>';
			$res .= '<td class="border" width={CONFIG="CURRENCY_COL3_WIDTH"}>{COL3_NAME}</td>';
			$res .= '<td class="border" width={CONFIG="CURRENCY_COL4_WIDTH"}>{COL4_NAME}</td>';
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
	
	private static function GetDataForDocumentsPage()
	{
		$data['TITLE'] = 'Документы';
		$data['PAGE_NUM'] = '5';
		$data['FILES'] = self::GetFilesList();
	
		return $data;
	}
	
	private static function IsUserAlreadyVote()
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
	
	private static function GetQuestinnaire()
	{
		if (self::IsUserAlreadyVote())
		{
			return self::GetResultsOfQuestinnaire();
		}
		else
		{
			return self::$data_questions;
		}
	}
	
	private static function GetResultsOfQuestinnaire()
	{
		$res = self::$data_questions;
		$res['TITLE'] = 'Результаты';
		$res['ACTION'] = '2';
		
		$database = self::ConnectToDatabase();
		if ($database != null)
		{
			for ($i = 1; $i <= count(self::$question_names); $i++)
			{
				self::LoadAnswersFromDatabase(self::$question_names[$i - 1], $i, $res, $database);
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
	
	private static function LoadAnswersFromDatabase($question, $number, &$results, $db)
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
	
	private static function GetFilesList()
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