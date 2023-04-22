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
 
$id = $_GET['id'];

 
$stmt = $db->prepare("DELETE FROM groups WHERE id = :id");
$stmt->execute(array(':id' => $id));

 
header('Location: view_groups.php');
exit();
?>
