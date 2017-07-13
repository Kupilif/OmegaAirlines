<div class="content_text" align={CONFIG="QUESTIONS_ALIGN"} color={CONFIG="MAIN_COLOR"}>
	<form action={COMMON="SAVE_ANSWERS_SCRIPT"} method="post" enctype="multipart/form-data">
		<{CONFIG="QUESTION_FORMAT"}>{VAR="Q1"}</{CONFIG="QUESTION_FORMAT"}>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" checked value="0" name="{VAR="Q1_NAME"}">{VAR="Q1_1"}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="1" name="{VAR="Q1_NAME"}">{VAR="Q1_2"}</p>
		
		<{CONFIG="QUESTION_FORMAT"}>{VAR="Q2"}</{CONFIG="QUESTION_FORMAT"}>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" checked value="0" name="{VAR="Q2_NAME"}">{VAR="Q2_1"}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio"  value="1" name="{VAR="Q2_NAME"}">{VAR="Q2_2"}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio"  value="2" name="{VAR="Q2_NAME"}">{VAR="Q2_3"}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio"  value="3" name="{VAR="Q2_NAME"}">{VAR="Q2_4"}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio"  value="4" name="{VAR="Q2_NAME"}">{VAR="Q2_5"}</p>
		
		<{CONFIG="QUESTION_FORMAT"}>{VAR="Q3"}</{CONFIG="QUESTION_FORMAT"}>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" checked value="0" name="{VAR="Q3_NAME"}">{VAR="Q3_1"}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="1" name="{VAR="Q3_NAME"}">{VAR="Q3_2"}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="2" name="{VAR="Q3_NAME"}">{VAR="Q3_3"}</p>
		
		<{CONFIG="QUESTION_FORMAT"}>{VAR="Q4"}</{CONFIG="QUESTION_FORMAT"}>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" checked value="0" name="{VAR="Q4_NAME"}">{VAR="Q4_1"}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="1" name="{VAR="Q4_NAME"}">{VAR="Q4_2"}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="2" name="{VAR="Q4_NAME"}">{VAR="Q4_3"}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="3" name="{VAR="Q4_NAME"}">{VAR="Q4_4"}</p>
		
		<{CONFIG="QUESTION_FORMAT"}>{VAR="Q5"}</{CONFIG="QUESTION_FORMAT"}>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" checked value="0" name="{VAR="Q5_NAME"}">{VAR="Q4_1"}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="1" name="{VAR="Q5_NAME"}">{VAR="Q4_2"}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="2" name="{VAR="Q5_NAME"}">{VAR="Q4_3"}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="3" name="{VAR="Q5_NAME"}">{VAR="Q4_4"}</p>
		
		<{CONFIG="QUESTION_FORMAT"}>{VAR="Q6"}</{CONFIG="QUESTION_FORMAT"}>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" checked value="0" name="{VAR="Q6_NAME"}">{VAR="Q4_1"}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="1" name="{VAR="Q6_NAME"}">{VAR="Q4_2"}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="2" name="{VAR="Q6_NAME"}">{VAR="Q4_3"}</p>
		<p style="font-size: {CONFIG="ANSWER_SIZE"}"><input type="radio" value="3" name="{VAR="Q6_NAME"}">{VAR="Q4_4"}</p>
		
		<input type="submit" value="Голосовать">
	</form>
</div>