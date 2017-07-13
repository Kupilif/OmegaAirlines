<!DOCTYPE html>
<html>
{FILE="{COMMON="HEAD_PATH"}"}
<body>
	<div class="main">

		{FILE="{COMMON="BANNER_PATH"}"}
	
		{FILE="{COMMON="MENU_PATH"}"}
			
		<div class="content">
			<div class="indent">
				{IF "{VAR="ACTION"}"=="1"}{FILE="{COMMON="QUESTIONS_PATH"}"}{ELSE}{FILE="{COMMON="QUESTIONS_RES_PATH"}"}{ENDIF}
			</div>
		</div>
		
		{FILE="{COMMON="FOOTER_PATH"}"}
		
	</div>
  
</body>
</html>