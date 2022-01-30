<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');

if ($role == "admin") {
if (!empty($_POST['submit'])) {
$pub_key = $_POST['publishedkeylive'];
$sec_key = $_POST['secretkeylive'];
$pub_key_test = $_POST['publishedkeysandbox'];
$sec_key_test = $_POST['secretkeysandbox'];
$mode = $_POST['mode'];
$status = $_POST['status'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_stripe SET pub_key = ?, sec_key = ?, pub_key_test = ?, sec_key_test = ?, status = ?, switch = ?");
$stmt->execute([$pub_key, $sec_key, $pub_key_test, $sec_key_test, $mode, $status]);
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
