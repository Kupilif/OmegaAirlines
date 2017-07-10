<!DOCTYPE html>
<html>
{FILE="templates/parts/head.tpl"}
<body>
	<div class="main">

		{FILE="templates/parts/banner.tpl"}
	
		{FILE="templates/parts/menu.tpl"}
			
		<div class="content">
			
			<div align=center>
				<form action="uploadfile.php" method="post" enctype="multipart/form-data">
					<input  type="file" name="uploadfile" required style="width: {CONFIG="DOCS_FILELOAD_WIDTH"}">
					<input type="submit" value="Загрузить">
				</form>
			</div>
			
			<div>{VAR="FILES"}</div>
		</div>
		
		{FILE="templates/parts/footer.tpl"}
		
	</div>
  
</body>
</html>