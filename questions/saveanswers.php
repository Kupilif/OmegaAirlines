<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/oa.com/config.php';

include_once SITE_ROOT . '/questions/questionnaire.php';

$questionnaire = new Questionnaire();

$questionNames = $questionnaire->GetQuestionNames();
for ($i = 0; $i < count($questionNames); $i++)
{
	$results[$i] = $_POST[$questionNames[$i]];
}

$questionnaire->UpdateAnswers($results);

