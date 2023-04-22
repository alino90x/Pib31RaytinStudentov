<title>Просмотреть всех студентов</title>
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
<center><h1>Просмотреть всех студентов</h1></center>
<br>
<?php

 
$conn = mysqli_connect("localhost", "u1624528_lab", "club1920", "u1624528_lab");

 
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

 
$sql = "SELECT students.id, students.name, groups.name as group_name FROM students JOIN groups ON students.group_id = groups.id";
$result = mysqli_query($conn, $sql);
  echo "<link rel=\"stylesheet\" href=\"../style/style.css\">";

 
if (mysqli_num_rows($result) > 0) {
 
  echo "<table>";
  echo "<thead><tr><th>ИД</th><th>Имя</th><th>Имя группы</th><th>Действия</th></tr></thead>";
  echo "<tbody>";

 
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["name"] . "</td>";
    echo "<td>" . $row["group_name"] . "</td>";
    echo "<td><center><a href=\"edit_student.php?id=" . $row["id"] . "\" class=\"button edit\">Редактировать</a> | <a href=\"delete_student.php?id=" . $row["id"] . "\" class=\"button delete\">Удалить</a></center></td>";
    echo "</tr>";
  }

 
  echo "</tbody>";
  echo "</table>";
  echo "<center><a class=\"button add\" href=\"add_student.php\">Добавить нового студента</a></center>";
} else {
  echo "Студенты не найдены. <a href=\"add_student.php\"> Добавить нового студента</a>";
}

 
mysqli_close($conn);
?>
