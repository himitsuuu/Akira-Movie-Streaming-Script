<?php
session_start();
require_once('../db/config.php');
require_once('../const/check_session.php');
require_once('../const/web-info.php');

if ($res == "1") {
if (!empty($_POST['submit'])) {
$coupon = $_POST['discount_code'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_used_coupons WHERE coupon = ? AND user = ?");
$stmt->execute([$coupon, $user_id]);
$result = $stmt->fetchAll();

if (count($result) > 0) {
$_SESSION['s_error'] = 'You have used this coupon before';
header("location:../checkout");
}else{

$stmt = $conn->prepare("SELECT * FROM tbl_coupons WHERE code = ?");
$stmt->execute([$coupon]);
$result = $stmt->fetchAll();

if (count($result) < 1) {
$_SESSION['s_error'] = 'Coupon code was not found';
header("location:../checkout");
}else{
foreach($result as $row)
{
$coup_id = $row[0];
$coup_dis = $row[2];
$coup_limt = $row[3];
$coup_usage = $row[4];
}

if ($coup_usage >= $coup_limt) {
$_SESSION['s_error'] = 'Coupon have reached maximum usage';
header("location:../checkout");
}else{
$new_cost = $_SESSION['plan_cost'] - ($coup_dis/100)*$_SESSION['plan_cost'];
//echo $new_cost * 100;
$_SESSION['unit_amount'] = ($new_cost * 100);
$_SESSION['plan_cost'] = $new_cost;
$_SESSION['s_success'] = 'You have get <b>'.$coup_dis.'%</b> off on your checkout!';
$_SESSION['discounted'] = 1;
$_SESSION['discount_code_id'] = $coup_id;
$_SESSION['discount_code'] = $coupon;
header("location:../checkout");
}
}

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
