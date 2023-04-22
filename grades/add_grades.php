
<title>Добавить оценку</title>
<div class="header"><nav>
    <br><hr>
  <ul>
    <li><a href="../index.php">Таблицы Рейтинга Группы</a>
    
    </li>
    <li><a href="../students/view_student.php">Студенты</a>
    
    </li>
    <li><a href="../subjects/view_subjects.php">Предметы</a>
      
    </li>
    <li><a href="./view_grades.php">Оценки</a>
      
    </li>
    <li><a href="../groups/view_groups.php">Группы</a>
      
    </li>
  </ul>
</nav>
</div>
<hr><br>
<?php
 
$conn = mysqli_connect("localhost", "u1624528_lab", "club1920", "u1624528_lab");
echo "<link rel=\"stylesheet\" href=\"../style/style.css\">";
 
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
  $student_id = $_POST["student_id"];
  $subject_id = $_POST["subject_id"];
  $rating = $_POST["rating"];

  
  $sql = "INSERT INTO grades (student_id, subject_id, rating) VALUES ('$student_id', '$subject_id', '$rating')";
  
  if (mysqli_query($conn, $sql)) {
    echo "<br><center>Оценка успешно добавлена. <a href=\"view_grades.php\">Посмотреть оценки</a></center>";
  } else {
    echo "Error: " . mysqli_error($conn);
  }

 
  mysqli_close($conn);

  exit();
}

 
$sql_students = "SELECT * FROM students";
$result_students = mysqli_query($conn, $sql_students);

 
$sql_subjects = "SELECT * FROM subjects";
$result_subjects = mysqli_query($conn, $sql_subjects);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Добавить оценку</title>
  <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <br>
  <center><h1>Добавить оценку</h1></center>
<br>
  <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="student_id">Студент:</label>
    <select name="student_id" required>
      <?php while ($row = mysqli_fetch_assoc($result_students)): ?>
        <option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
      <?php endwhile; ?>
    </select><br><br>

    <label for="subject_id">Предмет:</label>
    <select name="subject_id" required>
      <?php while ($row = mysqli_fetch_assoc($result_subjects)): ?>
        <option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
      <?php endwhile; ?>
    </select><br><br>

    <label for="rating">Оценка:</label>
    <input type="number" name="rating" required><br><br>

   <center><input type="submit" value="Добавить оценку"></center> 
  </form>
</body>
</html>
