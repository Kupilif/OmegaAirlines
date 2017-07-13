<!DOCTYPE html>
<html>
{FILE="{COMMON="HEAD_PATH"}"}
<body>
	<div class="main">

		{FILE="{COMMON="BANNER_PATH"}"}
	
		{FILE="{COMMON="MENU_PATH"}"}
			
		<div class="content">
			<div class="indent">
				<img src={VAR="ROUTE1_IMG"} width="{CONFIG="ROUTE_IMG_WIDTH"}" align={CONFIG="ROUTE_IMG_ALIGN"} hspace={CONFIG="IMG_HSPACE"}></img>
				<div class="content_text">{DB="route1_disc"}</div>
				
				<div class="delim_empty"></div>
				<hr align="{CONFIG="HR_ALIGN"}" width="{CONFIG="HR_WIDTH"}" size="{CONFIG="HR_SIZE"}" color="{CONFIG="MAIN_COLOR"}" />
				<div class="delim_empty"></div>
				
				<img src={VAR="ROUTE2_IMG"} width="{CONFIG="ROUTE_IMG_WIDTH"}" align={CONFIG="ROUTE_IMG_ALIGN"} hspace={CONFIG="IMG_HSPACE"}></img>
				<div class="content_text">{DB="route2_disc"}</div>
				
				<div class="delim_empty"></div>
				<hr align="{CONFIG="HR_ALIGN"}" width="{CONFIG="HR_WIDTH"}" size="{CONFIG="HR_SIZE"}" color="{CONFIG="MAIN_COLOR"}" />
				<div class="delim_empty"></div>
				
				<img src={VAR="ROUTE3_IMG"} width="{CONFIG="ROUTE_IMG_WIDTH"}" align={CONFIG="ROUTE_IMG_ALIGN"} hspace={CONFIG="IMG_HSPACE"}></img>
				<div class="content_text">{DB="route3_disc"}</div>
				
				<div class="delim_empty"></div>
				<hr align="{CONFIG="HR_ALIGN"}" width="{CONFIG="HR_WIDTH"}" size="{CONFIG="HR_SIZE"}" color="{CONFIG="MAIN_COLOR"}" />
				<div class="delim_empty"></div>
				
				<img src={VAR="ROUTE4_IMG"} width="{CONFIG="ROUTE_IMG_WIDTH"}" align={CONFIG="ROUTE_IMG_ALIGN"} hspace={CONFIG="IMG_HSPACE"}></img>
				<div class="content_text">{DB="route4_disc"}</div>
				
				<div class="delim_empty"></div>
				<hr align="{CONFIG="HR_ALIGN"}" width="{CONFIG="HR_WIDTH"}" size="{CONFIG="HR_SIZE"}" color="{CONFIG="MAIN_COLOR"}" />
				<div class="delim_empty"></div>
				
				<img src={VAR="ROUTE5_IMG"} width="{CONFIG="ROUTE_IMG_WIDTH"}" align={CONFIG="ROUTE_IMG_ALIGN"} hspace={CONFIG="IMG_HSPACE"}></img>
				<div class="content_text">{DB="route5_disc"}</div>
			</div>
		</div>
		
		{FILE="{COMMON="FOOTER_PATH"}"}
		
	</div>
  
</body>
</html>