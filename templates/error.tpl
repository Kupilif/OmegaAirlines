<!DOCTYPE html>
<html>
{FILE="templates/parts/head.tpl"}
<body>
	<div class="main">

		{FILE="templates/parts/banner.tpl"}
	
		{FILE="templates/parts/menu.tpl"}
			
		<div class="content">
			<div class="indent">
				<div align=center>
					<p class="content_text">{VAR="MESSAGE"}</p>
					<a href={VAR="LINK"}><button>Назад</button></a>
				</div>
			</div>
		</div>
		
		{FILE="templates/parts/footer.tpl"}
		
	</div>
  
</body>
</html>