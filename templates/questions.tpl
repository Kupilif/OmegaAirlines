<!DOCTYPE html>
<html>
{FILE="templates/parts/head.tpl"}
<body>
	<div class="main">

		{FILE="templates/parts/banner.tpl"}
	
		{FILE="templates/parts/menu.tpl"}
			
		<div class="content">
			<div class="indent">
				{IF "{VAR="ACTION"}"=="1"}{FILE="templates/parts/questionnaire.tpl"}{ELSE}{FILE="templates/parts/questionnaireres.tpl"}{ENDIF}
			</div>
		</div>
		
		{FILE="templates/parts/footer.tpl"}
		
	</div>
  
</body>
</html>