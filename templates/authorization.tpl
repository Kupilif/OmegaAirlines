<!DOCTYPE html>
<html>
{FILE="templates/parts/head.tpl"}
<body>
	<div class="main">

		{FILE="templates/parts/banner.tpl"}
	
		{FILE="templates/parts/menu.tpl"}
			
		<div class="content">
			<div class="indent">
				{IF "{ISUSERLOGGED}"=="0"}
					{FILE="templates/parts/authorizationform.tpl"}
				
					<div class="delim_empty"></div>
					<hr align="{CONFIG="HR_ALIGN"}" width="{CONFIG="AUTHORIZATION_HR_WIDTH"}" size="{CONFIG="HR_SIZE"}" color="{CONFIG="MAIN_COLOR"}" />
					<div class="delim_empty"></div>
				
					{FILE="templates/parts/registrationform.tpl"}
				{ENDIF}
				{IF "{ISUSERLOGGED}"=="1"}
					{FILE="templates/parts/loggeduser.tpl"}
				{ENDIF}
				{IF "{ISUSERLOGGED}"=="2"}
					{FILE="templates/parts/unactivateduser.tpl"}
				{ENDIF}
			</div>
		</div>
		
		{FILE="templates/parts/footer.tpl"}
		
	</div>
  
</body>
</html>