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
					<img src={VAR="NOT_FOUND_IMG"} align={CONFIG="NOT_FOUND_IMG_ALIGN"} hspace={CONFIG="IMG_HSPACE"}></img>
				</div>
				<div align=center>
					<h1 class="content_text">{VAR="TEXT"}</h1>
				</div>
			</div>
		</div>
		
		{FILE="{COMMON="FOOTER_PATH"}"}
		
	</div>
  
</body>
</html>