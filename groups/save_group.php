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

 
$id = isset($_POST['id']) ? $_POST['id'] : 0;
$name = $_POST['name'];

 
try {
  if ($id == 0) {
    $stmt = $db->prepare("INSERT INTO groups (name) VALUES (:name)");
    $stmt->bindParam(':name', $name);
    $stmt->execute();
  } else {
    $stmt = $db->prepare("UPDATE groups SET name=:name WHERE id=:id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
  }

  header("Location: view_groups.php");
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
