<?php

	if (isset($_GET['filename']))
	{
		$file = "files/" . $_GET['filename'];
		
		if (file_exists($file))
		{
			if (unlink($file))
			{
				header('Location: index.php?page=documents');
			}
			else
			{
				echo "<div align=center>";
				echo "Ошибка удаления файла!<br>";
				echo "<a href=\"index.php?page=documents\"><button>Назад</button></a>";
				echo "</div>";
			}
		}
		else
		{
			echo "<div align=center>";
			echo "Запрашиваемый файл не существует!<br>";
			echo "<a href=\"index.php?page=documents\"><button>Назад</button></a>";
			echo "</div>";
		}
	}
	else
	{
		echo "<div align=center>";
		echo "Необходимо указать файл для удаления!<br>";
		echo "<a href=\"index.php?page=documents\"><button>Назад</button></a>";
		echo "</div>";
	}