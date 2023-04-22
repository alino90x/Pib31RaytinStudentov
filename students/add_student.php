
<html>
<head>
	<title>Добавить студента</title>
</head>
<body>
<div class="header"><nav>
    <br><hr>
  <ul>
    <li><a href="../index.php">Таблицы Рейтинга Группы</a>
    
    </li>
    <li><a href="./view_student.php">Студенты</a>
    
    </li>
    <li><a href="../subjects/view_subjects.php">Предметы</a>
      
    </li>
    <li><a href="../grades/view_grades.php">Оценки</a>
      
    </li>
    <li><a href="../groups/view_groups.php">Группы</a>
      
    </li>
  </ul>
</nav>
</div>
<hr><br>
<?php
 
$host = 'localhost';
$dbname = 'u1624528_lab';
$username = 'u1624528_lab';
$password = 'club1920';
  echo "<link rel=\"stylesheet\" href=\"../style/style.css\">";

 
$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, name FROM groups ORDER BY name ASC";
$result = $conn->query($sql);
?>
<br>
<center><h2>Добавить студента</h2></center>
<br>
<form method="post" action="">
	<label for="name">Имя:</label>
	<input type="text" name="name" id="name"><br><br>
	<label for="group">Группа:</label>
	<select name="group" id="group">
		<?php
		 
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		        echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
		    }
		}
		?>
	</select><br><br>
<center><input type="submit" name="submit" value="Добавить студента"></center>	
</form>

<?php
 
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$group_id = $_POST['group'];
	
 
	$stmt = $conn->prepare("INSERT INTO students (name, group_id) VALUES (?, ?)");
	$stmt->bind_param("si", $name, $group_id);
	
	if ($stmt->execute()) {
		echo "<br><center><p>Студент успешно добавлен! <a href=\"view_student.php\">Посмотреть список студентов</a></p></center>";
	} else {
		echo "<p>Ошибка при добавлении ученика: " . $conn->error . "</p>";
	}
	
	$stmt->close();
}

 
$conn->close();
?>

</body>
</html>
