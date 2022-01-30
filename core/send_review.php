<?php
session_start();
require_once('../db/config.php');
require_once('../const/check_session.php');
require_once('../const/web-info.php');

if ($res == "1") {
if (!empty($_POST['submit'])) {
$title = ucwords($_POST['title']);
switch($_POST['rating']) {
  case '1';
  $rating = "1";
  break;

  case '2';
  $rating = "2";
  break;

  case '3';
  $rating = "3";
  break;

  case '4';
  $rating = "4";
  break;

  case '5';
  $rating = "5";
  break;

  case '6';
  $rating = "6";
  break;

  case '7';
  $rating = "7";
  break;

  case '8';
  $rating = "8";
  break;

  case '9';
  $rating = "9";
  break;

  case '10';
  $rating = "10";
  break;

  default;
  $rating = "10";
  break;
}
$review_date = date('Y-m-d h:i:s');
$item = $_POST['item'];
$red = $_POST['red'];
$comment = $_POST['review'];
try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_reviews WHERE item = ? AND user = ?");
$stmt->execute([$item, $user_id]);
$result = $stmt->fetchAll();

if (count($result) < 1) {
$stmt = $conn->prepare("INSERT INTO tbl_reviews (item, user, reason, date_time, rates, comment) VALUES (?,?,?,?,?,?)");
$stmt->execute([$item, $user_id, $title, $review_date, $rating, $comment]);

$stmt = $conn->prepare("SELECT * FROM tbl_reviews WHERE item = ?");
$stmt->execute([$item]);
$result = $stmt->fetchAll();
$total_reviews = count($result);
$total_rates = 0;

foreach($result as $row) {
$total_rates = $total_rates + $row[5];
}

$updated_reviews = $total_rates/$total_reviews;

$stmt = $conn->prepare("UPDATE tbl_items SET rates = ? WHERE item_id = ?");
$stmt->execute([$updated_reviews, $item]);

header("location:$red");
}else{
header("location:../");
}

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}


}else{
header("location:../");
}
}else{
//header("location:../");
}
?>
