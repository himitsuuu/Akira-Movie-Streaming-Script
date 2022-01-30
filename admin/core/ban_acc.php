<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');

if ($role == "admin") {
if (!empty($_GET['node'])) {
$account = $_GET['node'];
$ref = $_GET['ref'];
try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_users SET status = '0' WHERE id = ?");
$stmt->execute([$account]);
$_SESSION['reply'] = "021";
header("location:../$ref");

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
