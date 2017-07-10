<div class="content_text" align={CONFIG="QUESTIONS_ALIGN"} color={CONFIG="MAIN_COLOR"}>
	<form action="saveanswers.php" method="post" enctype="multipart/form-data">
		<{CONFIG="QUESTION_FORMAT"}>{Q1}</{CONFIG="QUESTION_FORMAT"}>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" checked value="0" name="{Q1_NAME}">{Q1_1}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="1" name="{Q1_NAME}">{Q1_2}</p>
		
		<{CONFIG="QUESTION_FORMAT"}>{Q2}</{CONFIG="QUESTION_FORMAT"}>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" checked value="0" name="{Q2_NAME}">{Q2_1}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio"  value="1" name="{Q2_NAME}">{Q2_2}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio"  value="2" name="{Q2_NAME}">{Q2_3}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio"  value="3" name="{Q2_NAME}">{Q2_4}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio"  value="4" name="{Q2_NAME}">{Q2_5}</p>
		
		<{CONFIG="QUESTION_FORMAT"}>{Q3}</{CONFIG="QUESTION_FORMAT"}>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" checked value="0" name="{Q3_NAME}">{Q3_1}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="1" name="{Q3_NAME}">{Q3_2}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="2" name="{Q3_NAME}">{Q3_3}</p>
		
		<{CONFIG="QUESTION_FORMAT"}>{Q4}</{CONFIG="QUESTION_FORMAT"}>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" checked value="0" name="{Q4_NAME}">{Q4_1}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="1" name="{Q4_NAME}">{Q4_2}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="2" name="{Q4_NAME}">{Q4_3}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="3" name="{Q4_NAME}">{Q4_4}</p>
		
		<{CONFIG="QUESTION_FORMAT"}>{Q5}</{CONFIG="QUESTION_FORMAT"}>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" checked value="0" name="{Q5_NAME}">{Q4_1}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="1" name="{Q5_NAME}">{Q4_2}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="2" name="{Q5_NAME}">{Q4_3}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="3" name="{Q5_NAME}">{Q4_4}</p>
		
		<{CONFIG="QUESTION_FORMAT"}>{Q6}</{CONFIG="QUESTION_FORMAT"}>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" checked value="0" name="{Q6_NAME}">{Q4_1}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="1" name="{Q6_NAME}">{Q4_2}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="2" name="{Q6_NAME}">{Q4_3}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="3" name="{Q6_NAME}">{Q4_4}</p>
		
		<input type="submit" value="Голосовать">
	</form>
</div>