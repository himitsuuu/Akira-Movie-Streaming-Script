<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');

if ($role == "admin") {
if (!empty($_GET['node'])) {
$comment_id = $_GET['node'];
$href = $_GET['href'];
try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $conn->prepare("SELECT * FROM tbl_comments WHERE id = ?");
$stmt->execute([$comment_id]);
$result = $stmt->fetchAll();

if (count($result) < 1) {
  header("location:../");
}else{
  foreach($result as $row)
  {
    $item = $row[1];
  }

  $stmt = $conn->prepare("DELETE FROM tbl_comments WHERE id = ?");
  $stmt->execute([$comment_id]);

  $_SESSION['reply'] = "020";
  header("location:../$href");
}

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}

}else{
header("location:../");
}
}else{
header("location:../");
}
?>
