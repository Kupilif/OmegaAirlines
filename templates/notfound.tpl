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
					<img src={VAR="NOT_FOUND_IMG"} align={CONFIG="NOT_FOUND_IMG_ALIGN"} hspace={CONFIG="IMG_HSPACE"}></img>
				</div>
				<div align=center>
					<h1 class="content_text">{VAR="TEXT"}</h1>
				</div>
			</div>
		</div>
		
		{FILE="templates/parts/footer.tpl"}
		
	</div>
  
</body>
</html>