<!DOCTYPE html>
<html>
{FILE="{COMMON="HEAD_PATH"}"}
<body>
	<div class="main">

		{FILE="{COMMON="BANNER_PATH"}"}
	
		{FILE="{COMMON="MENU_PATH"}"}
			
		<div class="content">
			
			<div align=center>
				<form action={COMMON="UPLOAD_FILE_SCRIPT"} method="post" enctype="multipart/form-data">
					<input  type="file" name="uploadfile" required style="width: {CONFIG="DOCS_FILELOAD_WIDTH"}">
					<input type="submit" value="Загрузить">
				</form>
			</div>
			
			<div>{VAR="FILES"}</div>
		</div>
		
		{FILE="{COMMON="FOOTER_PATH"}"}
		
	</div>
  
</body>
</html>