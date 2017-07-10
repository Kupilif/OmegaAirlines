<!DOCTYPE html>
<html>
{FILE="templates/parts/head.tpl"}
<body>
	<div class="main">

		{FILE="templates/parts/banner.tpl"}
	
		{FILE="templates/parts/menu.tpl"}
			
		<div class="content">
			<div class="indent">
				<div class="frame">
					<img src={LOGO1} align={CONFIG="MAIN_IMG_ALIGN"} hspace={CONFIG="IMG_HSPACE"}></img>
					<p class="content_text">{DB="main_text1"}</p>
				</div>
				
				<div class="delim_empty"></div>
				
				<div class="frame">
					<img src={LOGO2} align={CONFIG="MAIN_IMG_ALIGN"} hspace={CONFIG="IMG_HSPACE"}></img>
					<p class="content_text">{DB="main_text2"}</p>
				</div>
				
				<div class="delim_empty"></div>
				
				<div class="frame">
					<img src={LOGO3} align={CONFIG="MAIN_IMG_ALIGN"} hspace={CONFIG="IMG_HSPACE"}></img>
					<p class="content_text">{DB="main_text3"}</p>
				</div>
				
				<div class="delim_empty"></div>
				
				<div class="frame">
					<img src={LOGO4} align={CONFIG="MAIN_IMG_ALIGN"} hspace={CONFIG="IMG_HSPACE"}></img>
					<p class="content_text">{DB="main_text4"}</p>
				</div>
			</div>
		</div>
		
		{FILE="templates/parts/footer.tpl"}
		
	</div>
  
</body>
</html>