<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');
require_once('../../const/web-info.php');

if ($role == "admin") {
if (!empty($_POST['submit'])) {
$account = $_POST['user_id'];
$plan = $_POST['plan'];
$days = $_POST['days'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_plans WHERE id = ?");
$stmt->execute([$plan]);
$result = $stmt->fetchAll();

if (count($result) < 1) {
header("location:../edit-user?node=$account");
}else{
foreach($result as $row) {
$new_plan = ''.$row[1].' Plan';
$max_vid_size = $row[5];
$plan_valid = $days;
$plan_type = "Days";
$plan_due = Date('Y-m-d h:i:s', strtotime('+'.$plan_valid.' '.$plan_type.''));
$purchase_date = date('d M Y');
}

$stmt = $conn->prepare("DELETE FROM tbl_user_plans WHERE user = ?");
$stmt->execute([$account]);

$stmt = $conn->prepare("INSERT INTO tbl_user_plans (user, plan_name, purchase_date, expire_date, max_size) VALUES (?,?,?,?,?)");
$stmt->execute([$account, $new_plan, $purchase_date, $plan_due, $max_vid_size]);

$_SESSION['reply'] = "030";
header("location:../edit-user?node=$account");
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
