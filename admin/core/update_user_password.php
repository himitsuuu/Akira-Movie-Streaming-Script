<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');

if ($role == "admin") {
if (!empty($_POST['submit'])) {

$user = $_POST['user_id'];
$newpass = $_POST['newpass'];
$secret = password_hash($_POST['newpass'], PASSWORD_DEFAULT);

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_users SET security = ? WHERE id = ?");
$stmt->execute([$secret, $user]);
$_SESSION['reply'] = "012";
header("location:../edit-user?node=$user");

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
