<?php
session_start();
require_once('../db/config.php');
require_once('../const/check_session.php');

if ($role == "user") {
if (isset($_GET['node'])) {
$review_id = $_GET['node'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $conn->prepare("SELECT * FROM tbl_reviews WHERE id = ? AND user = ?");
$stmt->execute([$review_id, $user_id]);
$result = $stmt->fetchAll();

if (count($result) < 1) {
  header("location:../");
}else{
  foreach($result as $row)
  {
    $item = $row[1];
  }

  $stmt = $conn->prepare("DELETE FROM tbl_reviews WHERE id = ?");
  $stmt->execute([$review_id]);

  $stmt = $conn->prepare("SELECT * FROM tbl_reviews WHERE item = ?");
  $stmt->execute([$item]);
  $result = $stmt->fetchAll();
  $total_reviews = count($result);
  $total_rates = 0;



  foreach($result as $row) {
  $total_rates = $total_rates + $row[5];
  }

  if (count($result) > 0) {
    $updated_reviews = $total_rates/$total_reviews;
  }else{
    $updated_reviews = 0;
  }



  $stmt = $conn->prepare("UPDATE tbl_items SET rates = ? WHERE item_id = ?");
  $stmt->execute([$updated_reviews, $item]);

  $_SESSION['reply'] = "019";
  header("location:../user");
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
