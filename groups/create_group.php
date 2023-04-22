<!DOCTYPE html>
<html>
  <head>
    <title>Создать/Редактировать группу</title>
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
<hr><br>
<center><h1>Создать/Редактировать группу</h1></center><br>

    

    <form method="post" action="save_group.php">
      <label for="name">Имя группы:</label>
      <input type="text" id="name" name="name" required><br><br>

      <input type="hidden" name="id" value="0">

   <center><input type="submit" value="Обновлять"></center>   
    </form>
  </body>
</html>