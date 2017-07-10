<?php
	
	$uploaddir = 'files/';
	
	if (count($_FILES) != 0)
	{
		$uploadfile = $uploaddir . basename($_FILES['uploadfile']['name']);
	
		
		if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile))
		{
			header('Location: index.php?page=documents');
		}
		else
		{
			echo "<div align=center>";
			echo "Ошибка при загрузке файла!<br>";
			echo "<a href=\"index.php?page=documents\"><button>Назад</button></a>";
			echo "</div>";
		}
	}
	else
	{
		echo "<div align=center>";
		echo "Необходимо выбрать файл для загрузки!<br>";
		echo "<a href=\"index.php?page=documents\"><button>Назад</button></a>";
		echo "</div>";
	}
	
?>