<?php

$conn = mysqli_connect("localhost", "u1624528_lab", "club1920", "u1624528_lab");
echo "<link rel=\"stylesheet\" href=\"./style/style.css\">";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo '<html>
    <head><title>Система рейтинга студентов</title></head>
<body>

<div class="header"><nav>
    <br><hr>
  <ul>
    <li><a href="index.php">Таблицы Рейтинга Группы</a>
    
    </li>
    <li><a href="./students/view_student.php">Студенты</a>
    
    </li>
    <li><a href="./subjects/view_subjects.php">Предметы</a>
      
    </li>
    <li><a href="./grades/view_grades.php">Оценки</a>
      
    </li>
    <li><a href="./groups/view_groups.php">Группы</a>
      
    </li>
  </ul>
</nav>

</div>
<hr><br>';

$groupSql = "SELECT * FROM groups";
$groupResult = mysqli_query($conn, $groupSql);


if (mysqli_num_rows($groupResult) > 0) {

    while ($groupRow = mysqli_fetch_assoc($groupResult)) {
        echo "<h2>Группа : " . $groupRow["name"] . "</h2>";

        
        $studentSql = "SELECT * FROM students WHERE group_id=" . $groupRow["id"];
        $studentResult = mysqli_query($conn, $studentSql);

     
        if (mysqli_num_rows($studentResult) > 0) {
            
            echo "<table>";
            echo "<thead><tr><th>Студент</th>";
            
            
            $subjectSql = "SELECT * FROM subjects";
            $subjectResult = mysqli_query($conn, $subjectSql);
            
           
            while ($subjectRow = mysqli_fetch_assoc($subjectResult)) {
                echo "<th>" . $subjectRow["name"] . "</th>";
            }
            
            echo "<th>Всего баллов</th></tr></thead>";
            echo "<tbody>";
            
            
            while ($studentRow = mysqli_fetch_assoc($studentResult)) {
                echo "<tr><td>" . $studentRow["name"] . "</td>";
                
                
                $totalGrade = 0;
                $subjectResult = mysqli_query($conn, $subjectSql);
                while ($subjectRow = mysqli_fetch_assoc($subjectResult)) {
                    $gradeSql = "SELECT rating FROM grades WHERE subject_id=" . $subjectRow["id"] . " AND student_id=" . $studentRow["id"];
                    $gradeResult = mysqli_query($conn, $gradeSql);
                    
                    if (mysqli_num_rows($gradeResult) > 0) {
                        $gradeRow = mysqli_fetch_assoc($gradeResult);
                        $grade = $gradeRow["rating"];
                    } else {
                        $grade = 0;
                    }
                    
                    echo "<td>" . $grade . "</td>";
                    $totalGrade += $grade;
                }
                
                echo "<td>" . $totalGrade . "</td></tr>";
            }
            
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "No students found in this group.";
        }
    }
} else {
    echo "No groups found.";
}

echo '<br><hr><br>
<center><p>Система рейтинга студентов, созданная Али Абделькадер - ПИБ-31</p></center>
</body>
</html>';

mysqli_close($conn);
?>
