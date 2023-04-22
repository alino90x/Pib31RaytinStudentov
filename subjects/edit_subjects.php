<?php
ob_start();
$conn = mysqli_connect("localhost", "u1624528_lab", "club1920", "u1624528_lab");

 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

 
if (isset($_POST["submit"])) {
    
    $id = $_GET["id"];

 
    $name = $_POST["name"];

 
    $sql = "UPDATE subjects SET name='$name' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
   
        header("Location: view_subjects.php");
        exit();
    } else {
        echo "Ошибка при обновлении темы: " . mysqli_error($conn);
    }
}

 
$id = $_GET["id"];

 
$sql = "SELECT * FROM subjects WHERE id=$id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row["name"];
} else {
    echo "Subject not found.";
    exit();
}

 
mysqli_close($conn);
?>

 
<html>
<head>
    <title>Изменить Предметы</title>
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
    
    <center><h1>Изменить Предметы</h1></center>
    <br>
    <form method="post">
        <label for="name">Предмет:</label>
        <input type="text" name="name" value="<?php echo $name; ?>" required>

       <center><input type="submit" name="submit" value="Обновлять"></center> 
    </form>
<br>
   <center><a href="view_subjects.php">Назад к элементам</a></center> 
</body>
</html>
