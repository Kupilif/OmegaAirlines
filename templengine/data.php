<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/oa.com/config.php';

class TemplatesData
{
	public static $data_comon = array (
		'MOTTO' => 'OmegaAirlines — комфорт и надёжность!',
		'INDEX_PAGE_LINK' => '"' . SITE_ROOT_HTML . '/index.php?page=index"',
		'ROUTES_PAGE_LINK' => '"' . SITE_ROOT_HTML . '/index.php?page=popular_routes"',
		'AIRCRAFTS_PAGE_LINK' => '"' . SITE_ROOT_HTML . '/index.php?page=aircrafts"',
		'FRIENDS_PAGE_LINK' => '"' . SITE_ROOT_HTML . '/index.php?page=friends"',
		'DOCUMENTS_PAGE_LINK' => '"' . SITE_ROOT_HTML . '/index.php?page=documents"',
		'QUESTIONS_PAGE_LINK' => '"' . SITE_ROOT_HTML . '/index.php?page=questions"',
		'CURRENCY_PAGE_LINK' => '"' . SITE_ROOT_HTML . '/index.php?page=currency"',
		'AUTHORIZATION_PAGE_LINK' => '"' . SITE_ROOT_HTML . '/index.php?page=authorization"',
		'INDEX_PAGE_NAME' => 'Главная',
		'ROUTES_PAGE_NAME' => 'Популярные направления',
		'AIRCRAFTS_PAGE_NAME' => 'Наш авиапарк',
		'FRIENDS_PAGE_NAME' => 'Наши партнёры',
		'DOCUMENTS_PAGE_NAME' => 'Документы',
		'QUESTIONS_PAGE_NAME' => 'Опрос',
		'CURRENCY_PAGE_NAME' => 'Курсы валют',
		'AUTHORIZATION_PAGE_NAME' => 'Авторизация',
		'COPYRIGHT' => '&copyOmegaAirlines 2017, RD TC',
		
		'STYLES' => '"' . SITE_ROOT_HTML . '/styles/style.css"',
		
		'HEAD_PATH' => SITE_ROOT . '/templates/parts/head.tpl',
		'BANNER_PATH' => SITE_ROOT . '/templates/parts/banner.tpl',
		'MENU_PATH' => SITE_ROOT . '/templates/parts/menu.tpl',
		'FOOTER_PATH' => SITE_ROOT . '/templates/parts/footer.tpl',
		'REGISTRATION_FORM_PATH' => SITE_ROOT . '/templates/parts/registrationform.tpl',
		'AUTHORIZATION_FORM_PATH' => SITE_ROOT . '/templates/parts/authorizationform.tpl',
		'AUTHORIZED_PAGE_PATH' => SITE_ROOT . '/templates/parts/loggeduser.tpl',
		'UNACTIVATED_PAGE_PATH' => SITE_ROOT . '/templates/parts/unactivateduser.tpl',
		'QUESTIONS_PATH' => SITE_ROOT . '/ttemplates/parts/questionnaire.tpl',
		'QUESTIONS_RES_PATH' => SITE_ROOT . '/templates/parts/questionnaireres.tpl',
		
		'AUTHORIZATION_SCRIPT' => '"' . SITE_ROOT_HTML . '/auth/loguser.php"',
		'REGISTRATION_SCRIPT' => '"' . SITE_ROOT_HTML . '/reguser.php"',
		'LOGOUT_SCRIPT' => '"' . SITE_ROOT_HTML . '/logout.php"',
		'ACTIVATION_SCRIPT' => '"' . SITE_ROOT_HTML . '/activateuser.php"',
		'RESEND_CODE_SCRIPT' => '"' . SITE_ROOT_HTML . '/resendcode.php"',
		'SAVE_ANSWERS_SCRIPT' => '"' . SITE_ROOT_HTML . '/saveanswers.php"',
	);
	
	public static $data_index = array (
		'TITLE' => 'Главная',
		'PAGE_NUM' => '1',
		'LOGO1' => '"' . SITE_ROOT_HTML . '/images/main/logo.png"',
		'LOGO2' => '"' . SITE_ROOT_HTML . '/images/main/sale.png"',
		'LOGO3' => '"' . SITE_ROOT_HTML . '/images/main/comfort.png"',
		'LOGO4' => '"' . SITE_ROOT_HTML . '/images/main/safe.png"',
	);
	
	public static $data_routes = array (
		'TITLE' => 'Популярные направления',
		'PAGE_NUM' => '2',
		'ROUTE1_IMG' => '"' . SITE_ROOT_HTML . '/images/routes/newyork.jpg"',
		'ROUTE2_IMG' => '"' . SITE_ROOT_HTML . '/images/routes/london.jpg"',
		'ROUTE3_IMG' => '"' . SITE_ROOT_HTML . '/images/routes/paris.jpg"',
		'ROUTE4_IMG' => '"' . SITE_ROOT_HTML . '/images/routes/dubai.jpg"',
		'ROUTE5_IMG' => '"' . SITE_ROOT_HTML . '/images/routes/barcelona.jpg"',
	);
	
	public static $data_aircrafts = array (
		'TITLE' => 'Наш авиапарк',
		'PAGE_NUM' => '3',
		'PLANE1_NAME' => '"Boeing 737 Wargaming"',
		'PLANE1_IMG1' => '"' . SITE_ROOT_HTML . '/images/planes/1_boeing737wg.jpg"',
		'PLANE1_IMG2' => '"' . SITE_ROOT_HTML . '/images/planes/2_boeing737wg.jpg"',
		'PLANE1_IMG3' => '"' . SITE_ROOT_HTML . '/images/planes/3_boeing737wg.jpg"',
		'PLANE2_NAME' => '"Boeing 747"',
		'PLANE2_IMG1' => '"' . SITE_ROOT_HTML . '/images/planes/1_boeing747.jpg"',
		'PLANE2_IMG2' => '"' . SITE_ROOT_HTML . '/images/planes/2_boeing747.jpg"',
		'PLANE2_IMG3' => '"' . SITE_ROOT_HTML . '/images/planes/3_boeing747.jpg"',
		'PLANE3_NAME' => '"Airbus A380"',
		'PLANE3_IMG1' => '"' . SITE_ROOT_HTML . '/images/planes/1_airbus_a380.jpg"',
		'PLANE3_IMG2' => '"' . SITE_ROOT_HTML . '/images/planes/2_airbus_a380.jpg"',
		'PLANE3_IMG3' => '"' . SITE_ROOT_HTML . '/images/planes/3_airbus_a380.jpg"',
		'PLANE4_NAME' => '"Boeing 787"',
		'PLANE4_IMG1' => '"' . SITE_ROOT_HTML . '/images/planes/1_boeing787.jpg"',
		'PLANE4_IMG2' => '"' . SITE_ROOT_HTML . '/images/planes/2_boeing787.jpg"',
		'PLANE4_IMG3' => '"' . SITE_ROOT_HTML . '/images/planes/3_boeing787.jpg"',
		'PLANE5_NAME' => '"Airbus A330"',
		'PLANE5_IMG1' => '"' . SITE_ROOT_HTML . '/images/planes/1_airbus_a330.jpg"',
		'PLANE5_IMG2' => '"' . SITE_ROOT_HTML . '/images/planes/2_airbus_a330.jpg"',
		'PLANE5_IMG3' => '"' . SITE_ROOT_HTML . '/images/planes/3_airbus_a330.jpg"',
		'PLANE6_NAME' => '"Airbus A320neo"',
		'PLANE6_IMG1' => '"' . SITE_ROOT_HTML . '/images/planes/1_airbus_a320_neo.jpg"',
		'PLANE6_IMG2' => '"' . SITE_ROOT_HTML . '/images/planes/2_airbus_a320_neo.jpg"',
		'PLANE6_IMG3' => '"' . SITE_ROOT_HTML . '/images/planes/3_airbus_a320_neo.jpg"',
	);
	
	public static $data_friends = array (
		'TITLE' => 'Наши партнёры',
		'PAGE_NUM' => '4',
		'FRIEND1_LINK' => '"https://www.aa.com"',
		'FRIEND1_LOGO' => '"' . SITE_ROOT_HTML . '/images/companies/american_airlines.jpg"',
		'FRIEND2_LINK' => '"https://www.britishairways.com"',
		'FRIEND2_LOGO' => '"' . SITE_ROOT_HTML . '/images/companies/british_airways.jpg"',
		'FRIEND3_LINK' => '"http://www.aeroflot.ru"',
		'FRIEND3_LOGO' => '"' . SITE_ROOT_HTML . '/images/companies/aeroflot.png"',
		'FRIEND4_LINK' => '"http://www.airfrance.ru"',
		'FRIEND4_LOGO' => '"' . SITE_ROOT_HTML . '/images/companies/air_france.jpg"',
		'FRIEND5_LINK' => '"https://belavia.by"',
		'FRIEND5_LOGO' => '"' . SITE_ROOT_HTML . '/images/companies/belavia.jpg"',
		'FRIEND6_LINK' => '"http://www.airarabia.com"',
		'FRIEND6_LOGO' => '"' . SITE_ROOT_HTML . '/images/companies/airarabia.png"',
		'FRIEND7_LINK' => '"https://www.brusselsairlines.com"',
		'FRIEND7_LOGO' => '"' . SITE_ROOT_HTML . '/images/companies/brussels_airlines.jpg"',
		'FRIEND8_LINK' => '"https://www.klmcityhopper.nl/"',
		'FRIEND8_LOGO' => '"' . SITE_ROOT_HTML . '/images/companies/klm.png"',
		'FRIEND9_LINK' => '"http://www.jetairways.com/IN/"',
		'FRIEND9_LOGO' => '"' . SITE_ROOT_HTML . '/images/companies/jet_airways.png"',
	);
	
	public static $data_questions = array (
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
	
	public static $question_names = array (
		0 => 'gender',
		1 => 'age',
		2 => 'amount',
		3 => 'flight',
		4 => 'service',
		5 => 'site'
	);
	
	public static $page_404 = array (
		'NOT_FOUND_IMG' => SITE_ROOT_HTML . '/images/404.png',
		'TEXT' => 'Запрашиваемая Вами страница не найдена!',
		'TITLE' => '404',
		'PAGE_NUM' => '100',
	);
	
	public static $error_page = array (
		'TITLE' => 'Ошибка',
		'PAGE_NUM' => '100',
	);
}
