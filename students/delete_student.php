<title>Удалить студента</title>

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
 


$conn = mysqli_connect("localhost", "u1624528_lab", "club1920", "u1624528_lab");
echo "<link rel=\"stylesheet\" href=\"../style/style.css\">";
 
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

 
if (isset($_GET["id"])) {
 
  $id = mysqli_real_escape_string($conn, $_GET["id"]);

  
  $sql = "DELETE FROM students WHERE id = '$id'";
  if (mysqli_query($conn, $sql)) {
    echo "<br><center>студент успешно удален. <a href=\"view_student.php\">Вернуться к списку студентов</a></center>";
  } else {
    echo "<br><center>Оценки этого студента уже сохранены в системе. Пожалуйста, <a href='../grades/view_grades.php'>удалите его оценки</a>, чтобы иметь возможность удалить студента из списка.</center>" ;
  }
} else {
  echo "Неверный запрос.";
}


 
mysqli_close($conn);




?>
