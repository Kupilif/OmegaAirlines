<!DOCTYPE html>
<html>
{FILE="{COMMON="HEAD_PATH"}"}
<body>
	<div class="main">

		{FILE="{COMMON="BANNER_PATH"}"}
	
		{FILE="{COMMON="MENU_PATH"}"}
			
		<div class="content">
			<div class="indent">
				{IF "{VAR="ISUSERLOGGED"}"=="0"}
					{FILE="{COMMON="AUTHORIZATION_FORM_PATH"}"}
				
					<div class="delim_empty"></div>
					<hr align="{CONFIG="HR_ALIGN"}" width="{CONFIG="AUTHORIZATION_HR_WIDTH"}" size="{CONFIG="HR_SIZE"}" color="{CONFIG="MAIN_COLOR"}" />
					<div class="delim_empty"></div>
				
					{FILE="{COMMON="REGISTRATION_FORM_PATH"}"}
				{ENDIF}
				{IF "{VAR="ISUSERLOGGED"}"=="1"}
					{FILE="{COMMON="AUTHORIZED_PAGE_PATH"}"}
				{ENDIF}
				{IF "{VAR="ISUSERLOGGED"}"=="2"}
					{FILE="{COMMON="UNACTIVATED_PAGE_PATH"}"}
				{ENDIF}
			</div>
		</div>
		
		{FILE="{COMMON="FOOTER_PATH"}"}
		
	</div>
  
</body>
</html>