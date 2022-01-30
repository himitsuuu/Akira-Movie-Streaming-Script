<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');

if ($role == "admin") {
if (!empty($_POST['submit'])) {
$plan_name = strtoupper($_POST['plan']);
$valid_type = $_POST['valid_type'];
$valid = $_POST['valid'];
$price = $_POST['price'];
$id = $_POST['id'];
$max_size = $_POST['max_size'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_plans WHERE plan = ? AND id != ?");
$stmt->execute([$plan_name, $id]);
$result = $stmt->fetchAll();

if (count($result) > 0) {
$_SESSION['reply'] = "009";
header("location:../plans");
}else{
$stmt = $conn->prepare("UPDATE tbl_plans SET  plan = ?, valid = ?, cost = ?, valid_type = ?, max_size = ? WHERE id = ?");
$stmt->execute([$plan_name, $valid, $price, $valid_type, $max_size, $id]);
$_SESSION['reply'] = "012";
header("location:../plans");
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
