<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include_once SITE_ROOT . '/database/dbclient.php';
include_once SITE_ROOT . '/auth/authcontrol.php';
include_once SITE_ROOT . '/templengine/generator.php';
include_once SITE_ROOT . '/templengine/data.php';

class Questionnaire
{
	public function UpdateAnswers($results)
	{
		$db = new DataBaseClient();
		$auth = new AuthorizationControl();
		$generator = new PageGenerator();
		
		if ($auth->IsUserAuthorized())
		{
			try
			{
				$db->Connect();
			}
			catch (Excetion $e)
			{
				echo $generator->GetErrorPage('Не удалось подключиться к базе данных!', SITE_ROOT_HTML . '/index.php?page=questions');
				exit(1);
			}
			
			$questionNames = TemplatesData::$question_names;
			for ($i = 0; $i < count($questionNames); $i++)
			{
				$oldResult = $db->GetQuestionResults($questionNames[$i]);
				if ($oldResult !== false)
				{
					$newResult = $this->UpdateResult($oldResult, $results[$i]);
					$db->SetQuestionResults($questionNames[$i], $newResult);
				}
			}
			$db->NoteUserVote($auth->Username());
			
			$db->Disconnect();
			header('Location: ' . SITE_ROOT_HTML . '/index.php?page=questionsres');
		}
		else
		{
			header('Location: ' . SITE_ROOT_HTML . '/index.php?page=authorization');	
		}
	}
	
	public function GetQuestionNames()
	{
		return TemplatesData::$question_names;
	}
	
	private function UpdateResult($answers, $voteInd)
	{
		$splitedAnswers = preg_split("/-/", $answers);
		$splitedAnswers[$voteInd]++; // = $splitedAnswers[$voteInd] + 1;
		
		$newAnswers = '';
		$length = count($splitedAnswers);
		for ($i = 0; $i < $length; $i++)
		{
			$newAnswers .= $splitedAnswers[$i];
			if ($i != $length - 1)
			{
				$newAnswers .= '-';
			}
		}
		return $newAnswers;
	}
}