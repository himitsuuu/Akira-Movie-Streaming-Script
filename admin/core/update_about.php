<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');

if ($role == "admin") {
if (!empty($_POST['submit'])) {
$tagline = ucwords($_POST['tagline']);
$about = $_POST['about'];
$create_account = ucfirst($_POST['create_account']);
$choose_plan = ucfirst($_POST['choose_plan']);
$enjoy = ucfirst($_POST['enjoy']);

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_about SET about = ?, tagline = ?, choose_plan = ?, account = ?, enjoy = ?");
$stmt->execute([$about, $tagline, $choose_plan, $create_account, $enjoy]);
$_SESSION['reply'] = "012";
header("location:../more_settings");
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
