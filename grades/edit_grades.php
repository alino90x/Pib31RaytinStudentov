<?php
ob_start();

echo '<title>Изменить оценку</title>
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
<hr><br>';



 

$conn = mysqli_connect("localhost", "u1624528_lab", "club1920", "u1624528_lab");
echo "<link rel=\"stylesheet\" href=\"../style/style.css\">";

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $id = $_POST["id"];
  $student_id = $_POST["student_id"];
  $subject_id = $_POST["subject_id"];
  $rating = $_POST["rating"];

 
  $sql = "UPDATE grades SET student_id='$student_id', subject_id='$subject_id', rating='$rating' WHERE id='$id'";
  if (mysqli_query($conn, $sql)) {
   
    header("Location: view_grades.php");
    exit();
  } else {
    echo "Error updating grade: " . mysqli_error($conn);
  }
} else {
   
  $id = $_GET["id"];

  
  $sql = "SELECT * FROM grades WHERE id='$id'";
  $result = mysqli_query($conn, $sql);

 
  if (mysqli_num_rows($result) == 1) {
     
    $row = mysqli_fetch_assoc($result);
    $student_id = $row["student_id"];
    $subject_id = $row["subject_id"];
    $rating = $row["rating"];

     
    $sql_students = "SELECT * FROM students";
    $result_students = mysqli_query($conn, $sql_students);

    
    $sql_subjects = "SELECT * FROM subjects";
    $result_subjects = mysqli_query($conn, $sql_subjects);

  
    echo "<br><center><h2>Изменить оценку</h2></center><br>";
    echo "<form method=\"post\">";
    echo "<input type=\"hidden\" name=\"id\" value=\"" . $id . "\">";
    echo "<label for=\"student_id\">Студент:</label>";
    echo "<select name=\"student_id\" id=\"student_id\">";
    while ($row_student = mysqli_fetch_assoc($result_students)) {
      echo "<option value=\"" . $row_student["id"] . "\"";
      if ($student_id == $row_student["id"]) {
        echo " selected";
      }
      echo ">" . $row_student["name"] . "</option>";
    }
    echo "</select><br>";
    echo "<label for=\"subject_id\">Предмет:</label>";
    echo "<select name=\"subject_id\" id=\"subject_id\">";
    while ($row_subject = mysqli_fetch_assoc($result_subjects)) {
      echo "<option value=\"" . $row_subject["id"] . "\"";
      if ($subject_id == $row_subject["id"]) {
        echo " selected";
      }
      echo ">" . $row_subject["name"] . "</option>";
    }
    echo "</select><br>";
    echo "<label for=\"rating\">Оценка:</label>";
    echo "<input type=\"number\" name=\"rating\" id=\"rating\" value=\"" . $rating . "\" min=\"0\" max=\"100\"  required><br><br>";
    echo "<center><input type=\"submit\" value=\"Сохранять\"></center>";
    echo "</form>";
  } else {
    echo "Оценка не найдена.";
  }
}

mysqli_close($conn);

ob_end_flush();



