<!DOCTYPE html>
<html>
{FILE="{COMMON="HEAD_PATH"}"}
<body>
	<div class="main">

		{FILE="{COMMON="BANNER_PATH"}"}
	
		{FILE="{COMMON="MENU_PATH"}"}
			
		<div class="content">
			<div class="indent">
				<div align=center>
					<p class="content_text">{VAR="MESSAGE"}</p>
					<a href={VAR="LINK"}><button>Назад</button></a>
				</div>
			</div>
		</div>
		
		{FILE="{COMMON="FOOTER_PATH"}"}
		
	</div>
  
</body>
</html>