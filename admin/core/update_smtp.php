<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');

if ($role == "admin") {
if (!empty($_POST['submit'])) {

$smtp_username = $_POST['smtp_username'];
$smtp_password = $_POST['smtp_password'];
$smtp_server = $_POST['smtp_server'];
$smtp_port = $_POST['smtp_port_t'];
$smtp_port_n = $_POST['smtp_port_n'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_smtp SET server = ?, username = ?, password = ?, conn_type = ?, conn_port = ?");
$stmt->execute([$smtp_server, $smtp_username, $smtp_password, $smtp_port, $smtp_port_n]);

$_SESSION['reply'] = "012";
header("location:../smtp");

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
