<!DOCTYPE html>
<html>
{FILE="{COMMON="HEAD_PATH"}"}
<body>
	<div class="main">

		{FILE="{COMMON="BANNER_PATH"}"}
	
		{FILE="{COMMON="MENU_PATH"}"}
			
		<div class="content">
			<div class="indent">
				<div class="frame">
					<img src={VAR="LOGO1"} align={CONFIG="MAIN_IMG_ALIGN"} hspace={CONFIG="IMG_HSPACE"}></img>
					<p class="content_text">{DB="main_text1"}</p>
				</div>
				
				<div class="delim_empty"></div>
				
				<div class="frame">
					<img src={VAR="LOGO2"} align={CONFIG="MAIN_IMG_ALIGN"} hspace={CONFIG="IMG_HSPACE"}></img>
					<p class="content_text">{DB="main_text2"}</p>
				</div>
				
				<div class="delim_empty"></div>
				
				<div class="frame">
					<img src={VAR="LOGO3"} align={CONFIG="MAIN_IMG_ALIGN"} hspace={CONFIG="IMG_HSPACE"}></img>
					<p class="content_text">{DB="main_text3"}</p>
				</div>
				
				<div class="delim_empty"></div>
				
				<div class="frame">
					<img src={VAR="LOGO4"} align={CONFIG="MAIN_IMG_ALIGN"} hspace={CONFIG="IMG_HSPACE"}></img>
					<p class="content_text">{DB="main_text4"}</p>
				</div>
			</div>
		</div>
		
		{FILE="{COMMON="FOOTER_PATH"}"}
		
	</div>
  
</body>
</html>