<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');

if ($role == "admin") {
if (!empty($_GET['node'])) {
$account = $_GET['node'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $conn->prepare("SELECT * FROM tbl_users WHERE id = ?");
$stmt->execute([$account]);
$result = $stmt->fetchAll();

if (count($result) < 1) {
  header("location:../");
}else{
  foreach($result as $row)
  {
    $avaor = $row[8];
  }

  $stmt = $conn->prepare("DELETE FROM tbl_comments WHERE user = ?");
  $stmt->execute([$account]);

  $stmt = $conn->prepare("DELETE FROM tbl_favourites WHERE user = ?");
  $stmt->execute([$account]);

  $stmt = $conn->prepare("DELETE FROM tbl_reviews WHERE user = ?");
  $stmt->execute([$account]);

  $stmt = $conn->prepare("DELETE FROM tbl_sessions WHERE user = ?");
  $stmt->execute([$account]);

  $stmt = $conn->prepare("DELETE FROM tbl_user_plans WHERE user = ?");
  $stmt->execute([$account]);

  $stmt = $conn->prepare("DELETE FROM tbl_users WHERE id = ?");
  $stmt->execute([$account]);

  if ($avaor == "user.svg") {

  }else{

  unlink('../../img/users/'.$avaor.'');

  }


  $_SESSION['reply'] = "022";
  header("location:../users");
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
