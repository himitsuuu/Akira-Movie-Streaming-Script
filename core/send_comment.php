<?php
session_start();
require_once('../db/config.php');
require_once('../const/check_session.php');
require_once('../const/web-info.php');

if ($res == "1") {
if (!empty($_POST['submit'])) {
$comment = $_POST['comment'];
$comment_date = date('Y-m-d h:i:s');
$item = $_POST['item'];
$red = $_POST['red'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("INSERT INTO tbl_comments (item, user, date_time, comment) VALUES (?,?,?,?)");
$stmt->execute([$item, $user_id, $comment_date, $comment]);
header("location:$red");

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
