<!DOCTYPE html>
<html>
{FILE="{COMMON="HEAD_PATH"}"}
<body>
	<div class="main">

		{FILE="{COMMON="BANNER_PATH"}"}
	
		{FILE="{COMMON="MENU_PATH"}"}
			
		<div class="content">
			<div class="indent">
			
				<div class="content_text" color="{CONFIG="MAIN_COLOR"}">
					<{CONFIG="CURRENCY_TEXT_FORMAT"} align="{CONFIG="CURRENCY_TEXT_ALIGN"}">{VAR="CURRENCY_TEXT"}{VAR="CUR_DATE"}</{CONFIG="CURRENCY_TEXT_FORMAT"}>
				</div>
				{VAR="CUR_DATE_CURRENCY"}
				
				<div class="content_text" color="{CONFIG="MAIN_COLOR"}">
					<{CONFIG="CURRENCY_TEXT_FORMAT"} align="{CONFIG="CURRENCY_TEXT_ALIGN"}">{VAR="CURRENCY_TEXT"}{VAR="PREV_DATE"}</{CONFIG="CURRENCY_TEXT_FORMAT"}>
				</div>
				{VAR="PREV_DATE_CURRENCY"}
			</div>
		</div>
		
		{FILE="{COMMON="FOOTER_PATH"}"}
		
	</div>
  
</body>
</html>