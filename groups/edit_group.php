<?php
$host = 'localhost';
$dbname = 'u1624528_lab';
$username = 'u1624528_lab';
$password = 'club1920';

// Connect to the database
try {
  $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die();
}

 
if (isset($_POST['submit'])) {
 
  $id = $_POST['id'];
  $name = $_POST['name'];

  
  $stmt = $db->prepare("UPDATE groups SET name = :name WHERE id = :id");
  $stmt->execute(array(':name' => $name, ':id' => $id));

 
  header('Location: view_groups.php');
  exit();
}

 
$id = $_GET['id'];

 
$stmt = $db->prepare("SELECT * FROM groups WHERE id = :id");
$stmt->execute(array(':id' => $id));
$row = $stmt->fetch();

 
if (!$row) {
  header('Location: view_groups.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Редактировать группу</title>
    <link rel="stylesheet" href="../style/style.css">
  </head>
  <body>
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
<hr><br><center><h1>Редактировать группу</h1></center><br>
    

    <form method="post">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
      <label for="name">Имя группы:</label>
      <input type="text" name="name" value="<?php echo $row['name']; ?>">
    <center>  <input type="submit" name="submit" value="Сохранять"></center>
    </form>

    <br><br>

   <center><a href="view_groups.php">Отмена</a></center> 
  </body>
</html>
