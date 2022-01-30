<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');

if ($role == "admin") {
if (!empty($_POST['submit'])) {

if (!empty($_POST['symbol'])) {
$symbol = $_POST['symbol'];
}else{
$symbol = "";
}
$iso = $_POST['iso'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_web_info SET currency = ?, iso = ?");
$stmt->execute([$symbol, $iso]);
$_SESSION['reply'] = "012";
header("location:../settings");
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
