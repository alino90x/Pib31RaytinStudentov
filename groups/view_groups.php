<div class="header"><nav>
    <br><hr>
  <ul>
    <li><a href="../index.php">Таблицы Рейтинга Группы</a>
    
    </li>
    <li><a href="../students/view_student.php">Студенты</a>
    
    </li>
    <li><a href="../subjects/view_subjects.php">Предметы</a>
      
    </li>
    <li><a href="../grades/view_grades.php">Оценки</a>
      
    </li>
    <li><a href="./view_groups.php">Группы</a>
      
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

 
try {
  $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Просмотр групп</title>

  <link rel="stylesheet" href="../style/style.css">

  </head>
  <body>
  <br><center> <h1>Просмотр групп</h1></center>   <br>

    <table>
      <thead>
        <tr>
          <th>ИД</th>
          <th>Имя группы</th>
          <th>Действие</th>
        </tr>
      </thead>
      <tbody>
        <?php
       
        $stmt = $db->query("SELECT * FROM groups");

  
        while ($row = $stmt->fetch()) {
          echo "<tr>";
          echo "<td>" . $row['id'] . "</td>";
          echo "<td>" . $row['name'] . "</td>";
          echo "<td><center><a class=\"button edit\" href=\"edit_group.php?id=" . $row['id'] . "\">Редактировать</a> | <a class=\"button delete\" href=\"delete_group.php?id=" . $row['id'] . "\">Удалить</a></center></td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>

    <br><br>

   <center><a class="button add" href="create_group.php">Создать новую группу</a></center> 
  </body>
</html>
