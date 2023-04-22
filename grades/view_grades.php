<title>Просмотреть все оценки</title>
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

<center><h1>Просмотреть все оценки</h1></center>
<br>
<?php

 
$conn = mysqli_connect("localhost", "u1624528_lab", "club1920", "u1624528_lab");
echo "<link rel=\"stylesheet\" href=\"../style/style.css\">";
 
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

 
$sql = "SELECT grades.id, students.name as student_name, subjects.name as subject_name, grades.rating FROM grades JOIN students ON grades.student_id = students.id JOIN subjects ON grades.subject_id = subjects.id";
$result = mysqli_query($conn, $sql);

 
if (mysqli_num_rows($result) > 0) {
  
  echo "<table>";
  echo "<thead><tr><th>ИД</th><th>Имя студента</th><th>Предмет</th><th>Оценки</th><th>Действия</th></tr></thead>";
  echo "<tbody>";

  
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["student_name"] . "</td>";
    echo "<td>" . $row["subject_name"] . "</td>";
    echo "<td>" . $row["rating"] . "</td>";
    echo "<td><center><a class=\"button edit\" href=\"edit_grades.php?id=" . $row["id"] . "\">Редактировать</a> | <a href=\"delete_grades.php?id=" . $row["id"] . "\" class=\"button delete\">Удалить</a></center></td>";
    echo "</tr>";
  }

 
  echo "</tbody>";
  echo "</table>";
  echo "<center><a class=\"button add\" href=\"add_grades.php\">Добавить новую оценку</a></center><br>";
} else {
  echo "No grades found. <a href=\"add_grades.php\">Добавить новую оценку</a>";
}

 
mysqli_close($conn);
?>
