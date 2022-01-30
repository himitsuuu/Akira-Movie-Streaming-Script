<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');

if ($role == "admin") {
if (!empty($_POST['submit'])) {
$coupon = strtoupper($_POST['coupon']);
$discount = $_POST['discount'];
$limitation = $_POST['limitation'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_coupons WHERE code = ?");
$stmt->execute([$coupon]);
$result = $stmt->fetchAll();

if (count($result) > 0) {
$_SESSION['reply'] = "009";
header("location:../coupons");
}else{
$stmt = $conn->prepare("INSERT INTO tbl_coupons (code, discount, limit_c) VALUES (?,?,?)");
$stmt->execute([$coupon, $discount, $limitation]);
$_SESSION['reply'] = "010";
header("location:../coupons");
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
