<title>Удалить Предмет</title>
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
<?php

 
$conn = mysqli_connect("localhost", "u1624528_lab", "club1920", "u1624528_lab");
echo "<link rel=\"stylesheet\" href=\"../style/style.css\">";
 
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

 
if (isset($_GET["id"]) && filter_var($_GET["id"], FILTER_VALIDATE_INT)) {
  $id = $_GET["id"];

 
  $sql = "DELETE FROM subjects WHERE id = $id";
  if (mysqli_query($conn, $sql)) {
    echo "<br><center>Предмет успешно удален. <a href=\"view_subjects.php\">Вернуться к просмотру предметов</a></center>";
  } else {
    echo "Ошибка удаления предмета: " . mysqli_error($conn);
  }
} else {
  echo "Неверный идентификатор предмета. <a href=\"view_subjects.php\">Вернуться к просмотру предметов</a>";
}

 
mysqli_close($conn);

?>
