<?php

class Currency
{
	public function GetCurrencyForDate($date)
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
}

