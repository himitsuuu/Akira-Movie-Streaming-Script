<?php
session_start();
require_once('../db/config.php');
require_once('../const/check_session.php');
require_once('../const/web-info.php');
require_once('../const/uniques.php');

if ($role == "user") {

if (isset($_GET['node'])) {
$plan_id = $_GET['node'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_user_plans WHERE user = ?");
$stmt->execute([$user_id]);
$result = $stmt->fetchAll();

if (count($result) > 0) {
foreach($result as $row) {
$expire__date = $row[4];

if (new DateTime() > new DateTime($expire__date)) {
  $_SESSION['has_plan'] = "0";
} else {
  $_SESSION['current_plan'] = $row[2];
  $old_date = $expire__date;
  $old_date_timestamp = strtotime($old_date);
  $new_date = date('d M, Y h:i:s A', $old_date_timestamp);
  $_SESSION['current_end_plan'] = $new_date;
  $_SESSION['has_plan'] = "1";
}

}


}else{
  $_SESSION['has_plan'] = "0";
}


$stmt = $conn->prepare("SELECT * FROM tbl_plans WHERE id = ?");
$stmt->execute([$plan_id]);
$result = $stmt->fetchAll();

if (count($result) < 1) {
header("location:../pricing");
}else{
foreach($result as $row) {
$_SESSION['select_plan_started'] = "1";
$_SESSION['new_plan'] = ''.$row[1].' Plan';
$_SESSION['plan_cost'] = $row[3];
$_SESSION['max_vid_size'] = $row[5];
$plan_valid = $row[2];
$plan_type = $row[4];
$_SESSION['plan_due'] = Date('Y-m-d h:i:s', strtotime('+'.$plan_valid.' '.$plan_type.''));

$unsec_trans = 'FLIX'.get_rand_numbers(10).'';
$trans_id = password_hash($unsec_trans, PASSWORD_DEFAULT);
$red = $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['HTTP_HOST']. explode('?', $_SERVER['REQUEST_URI'], 2)[0];
$strtorep = "core/select_plan";

$_SESSION['success_url'] = 'core/upgrade-plan?call_back='.$unsec_trans.'';
$_SESSION['cancel_url'] = "checkout";
$_SESSION['domain'] = rtrim(str_replace($strtorep,"",$red), '/');
$_SESSION['st_currency'] = strtolower(AppISO);
$_SESSION['unit_amount'] = ($_SESSION['plan_cost'] * 100);
$_SESSION['trans_name'] = $_SESSION['new_plan'];
$_SESSION['item_id'] = $user_id;
$_SESSION['transaction_id'] = $trans_id;
$_SESSION['item_name'] = $_SESSION['new_plan'];
$_SESSION['unsec_trans'] = $unsec_trans;
$_SESSION['tran_no'] = get_rand_numbers(5);
$_SESSION['discounted'] = 0;

header("location:../checkout");
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
