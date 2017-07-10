<?php
include 'templengine/manager.php';

/* Вывод сообщения об ошибке */
function PrintMessage($messg)
{
	$res = "<div align=center>";
	$res .= "<p>" . $messg . "</p>";
	$res .= "<a href=\"index.php?page=questions\"><button>Назад</button></a>";
	$res .= "</div>";
	echo $res;
}

/* Подключение к базе данных */
function ConnectToDatabase()
{
	$db = new mysqli('localhost', 'root', '2019755', 'site');
	if ($db == null)
	{
		return null;
	}
	
	$db->query("SET CHARACTER SET 'UTF8'");
	$db->query("SET CHARSET 'UTF8'");
	$db->query("SET NAMES 'UTF8'");
	return $db;
}

/* Обновление результатов заданного вопроса */
function UpdateResult($question, $answerInd, $db)
{
	$searchRes = $db->query("SELECT `results` FROM `questionnaire` WHERE `question` = '" . $question . "'");
	if ($searchRes !== false)
	{
		if (mysqli_num_rows($searchRes) > 0)
		{
			$elem = $searchRes->fetch_assoc();
			$strAnswers = $elem['results'];
			$answers = preg_split("/-/", $strAnswers);
			$answers[$answerInd] = $answers[$answerInd] + 1;
			$strNewAswers = "";
			
			$answersAmo = count($answers); 
			for ($i = 0; $i < $answersAmo; $i++)
			{
				$strNewAswers .= $answers[$i];
				if ($i != $answersAmo - 1)
				{
					$strNewAswers .= "-";
				}
			}
			
			$db->query("UPDATE `questionnaire` SET `results` = '" . $strNewAswers ."' WHERE `question` = '" . $question . "'");
		}
		else
		{
			PrintMessage("Элемент $question не найден в базе данных!");
			return ;
		}
	}
	else
	{
		PrintMessage("Элемент $question не найден в базе данных!");
		return ;
	}
}

/* Обновление результатов всех вопросов */
function SaveNewResultsToDatabase($results, $questions, $db)
{
	for ($i = 0; $i < count($questions); $i++)
	{
		UpdateResult($questions[$i], $results[$i], $db);
	}
}

$questions = CTemplatesManager::GetQuestionNames(); 

$database = ConnectToDatabase();
if ($database == null)
{
	PrintMessage("Не удалось подключиться к базе данных!");
	exit(1);
}

for ($i = 0; $i < count($questions); $i++)
{
	$results[$i] = $_POST[$questions[$i]];
}

SaveNewResultsToDatabase($results, $questions, $database);

session_start();
if (CTemplatesManager::IsUserAuthorized())
{
	$database->query("UPDATE `users` SET `vote` = 1 WHERE BINARY `login` = '" . $_SESSION['username'] . "'");
}

$database->close();

header('Location: index.php?page=questionsres');