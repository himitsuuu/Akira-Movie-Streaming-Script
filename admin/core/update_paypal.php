<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');

if ($role == "admin") {
if (!empty($_POST['submit'])) {
$pp_api_user = $_POST['apiusername_live'];
$pp_api_pass = $_POST['apipassword_live'];
$pp_api_sign = $_POST['apisig_live'];

$pp_api_user_test = $_POST['apiusername_sb'];
$pp_api_pass_test = $_POST['apipassword_sb'];
$pp_api_sign_test = $_POST['apisig_sb'];
$mode = $_POST['mode'];
$status = $_POST['status'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_paypal SET  API_USER = ?, API_PASS = ?, API_SIG = ?, API_USER_SB = ?, API_PASS_SB = ?, API_SIG_SB = ?, status = ?, switch = ?");
$stmt->execute([$pp_api_user, $pp_api_pass, $pp_api_sign, $pp_api_user_test, $pp_api_pass_test, $pp_api_sign_test, $mode, $status]);
$_SESSION['reply'] = "012";
header("location:../payment_gateways");

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
