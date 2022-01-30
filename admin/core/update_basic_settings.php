<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');

if ($role == "admin") {
if (!empty($_POST['submit'])) {

$web_name = ucwords($_POST['web_name']);
$web_email = $_POST['web_email'];
$web_phone = $_POST['web_phone'];
$timezone = $_POST['timezone'];
$header = $_POST['header'];
$guests = $_POST['guests'];
$description = $_POST['description'];
$keywords = $_POST['keywords'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_web_info SET name = ?, email = ?, phone = ?, timezone = ?, top_text = ?, keywords = ?, description = ?, guest_view = ?");
$stmt->execute([$web_name, $web_email, $web_phone, $timezone, $header, $keywords, $description, $guests]);
$_SESSION['reply'] = "012";
header("location:../settings");
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
