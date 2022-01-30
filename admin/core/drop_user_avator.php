<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');

if ($role == "admin") {

if (!empty($_GET['node'])) {
$user = $_GET['node'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_users WHERE id = ?");
$stmt->execute([$user]);
$result = $stmt->fetchAll();

if (count($result) > 0) {
foreach($result as $row) {
  $img = $row[8];
}

if ($img == "user.svg") {
header("location:../edit-user?node=$user");
}else{
unlink("../../img/users/$img");

$stmt = $conn->prepare("UPDATE tbl_users SET image = 'user.svg' WHERE id = ?");
$stmt->execute([$user]);
$_SESSION['reply'] = "012";
header("location:../edit-user?node=$user");
}

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
header("location:../");
}
?>
