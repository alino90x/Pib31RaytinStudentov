<?php
 
$conn = mysqli_connect("localhost", "u1624528_lab", "club1920", "u1624528_lab");

 
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

 
if (isset($_GET["id"])) {
  $id = $_GET["id"];

 
  $sql = "DELETE FROM grades WHERE id = $id";
  if (mysqli_query($conn, $sql)) {
   
    header("Location: view_grades.php");
    exit();
  } else {
    echo "Не удалось удалить оценку: " . mysqli_error($conn);
  }
}

 
mysqli_close($conn);
?>
