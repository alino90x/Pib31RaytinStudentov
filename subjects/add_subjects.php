
<html>
<head>
	<title>Добавить новый предмет</title>
	<link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="header"><nav>
        <br><hr>
  <ul>
    <li><a href="../index.php">Таблицы Рейтинга Группы</a>
    
    </li>
    <li><a href="../students/view_student.php">Студенты</a>
    
    </li>
    <li><a href="./view_subjects.php">Предметы</a>
      
    </li>
    <li><a href="../grades/view_grades.php">Оценки</a>
      
    </li>
    <li><a href="../groups/view_groups.php">Группы</a>
      
    </li>
  </ul>
</nav>
</div>
<hr><br>
<center><h1>Добавить новый предмет</h1></center>
<br>
	<?php
	 
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 
			$conn = mysqli_connect("localhost", "u1624528_lab", "club1920", "u1624528_lab");
		 
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
 
			$stmt = mysqli_prepare($conn, "INSERT INTO subjects (name) VALUES (?)");
			mysqli_stmt_bind_param($stmt, "s", $name);
		 
			$name = $_POST["name"];
			mysqli_stmt_execute($stmt);
	 
			if (mysqli_affected_rows($conn) > 0) {
				echo "<br><center><p>Предмет успешно добавлен.</p></center>";
			} else {
				echo "<p>Ошибка добавления Предмет.</p>";
			}
		 
			mysqli_stmt_close($stmt);
			mysqli_close($conn);
		}
	?>
	<form method="post">
		<label for="name">Предмет:</label>
		<input type="text" id="name" name="name" required>
		<br>
	<center><input type="submit" value="Добавить предмет"></center>	
	</form>
	<br>
<center><a href="view_subjects.php">Просмотреть все предметы</a></center>	
</body>
</html>
