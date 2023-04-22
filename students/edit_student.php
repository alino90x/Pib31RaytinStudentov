<?php
 
ob_start();
$servername = "localhost";
$username = "u1624528_lab";
$password = "club1920";
$dbname = "u1624528_lab";
  echo "<link rel=\"stylesheet\" href=\"../style/style.css\">";

 
$conn = new mysqli($servername, $username, $password, $dbname);

 
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

 
if (isset($_POST['submit'])) {
 
  $student_id = $_POST['student_id'];
  $name = $_POST['name'];
  $group_id = $_POST['group_id'];

 
  $sql = "UPDATE students SET name=?, group_id=? WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sii", $name, $group_id, $student_id);
  $result = $stmt->execute();

 
  if ($result) {
 
    header("Location: view_student.php");
    exit();
  } else {
 
    echo "Error updating student: " . $conn->error;
  }
}

 
if (isset($_GET['id'])) {
  $student_id = $_GET['id'];

 
  $sql = "SELECT * FROM students WHERE id=$student_id";
  $result = $conn->query($sql);

 
  if ($result->num_rows > 0) {
 
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $group_id = $row['group_id'];
  } else {
    
    echo "Ошибка: студент не найден";
    exit();
  }
} else {
 
  echo "Ошибка: не указан студенческий билет";
  exit();
}

 
$sql = "SELECT * FROM groups";
$result = $conn->query($sql);

 
$conn->close();
?>

 
<html>
<head>
  <title>Изменить студента</title>
  <link rel="stylesheet" href="style.css">
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

  <center><h1>Изменить студента</h1></center>
<br>
  <form method="post" action="edit_student.php">
    <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
    <label>Имя:</label>
    <input type="text" name="name" value="<?php echo $name; ?>"><br>
    <label>Группа:</label>
    <select name="group_id">
      <?php while ($row = $result->fetch_assoc()): ?>
        <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $group_id) echo "selected"; ?>><?php echo $row['name']; ?></option>
      <?php endwhile; ?>
    </select><br>
   <center><input type="submit"  name="submit" value="Сохранять">
    <a class="button delete" href="view_student.php">Отмена</a></center> 
    
  </form>

</body>
</html>
