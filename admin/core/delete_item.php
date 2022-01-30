<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');

if ($role == "admin") {
if (!empty($_GET['node'])) {
$item = base64_decode($_GET['node']);
$type = base64_decode($_GET['type']);
$cover = base64_decode($_GET['cover']);
$thumbnail = base64_decode($_GET['thumbnail']);

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("DELETE FROM tbl_comments WHERE item = ?");
$stmt->execute([$item]);

$stmt = $conn->prepare("DELETE FROM tbl_reviews WHERE item = ?");
$stmt->execute([$item]);

$stmt = $conn->prepare("DELETE FROM tbl_favourites WHERE item = ?");
$stmt->execute([$item]);

if ($type == "Movie") {
$stmt = $conn->prepare("DELETE FROM tbl_single_links WHERE item = ?");
$stmt->execute([$item]);

$stmt = $conn->prepare("DELETE FROM tbl_single_subs WHERE item = ?");
$stmt->execute([$item]);
}else{
$stmt = $conn->prepare("DELETE FROM tbl_episodes WHERE item = ?");
$stmt->execute([$item]);

$stmt = $conn->prepare("DELETE FROM tbl_episode_subs WHERE item = ?");
$stmt->execute([$item]);
}

$stmt = $conn->prepare("DELETE FROM tbl_items WHERE item_id = ?");
$stmt->execute([$item]);

unlink('../../uploads/cover/'.$cover.'');
unlink('../../uploads/thumbnail/'.$thumbnail.'');

$_SESSION['reply'] = "024";
header("location:../catalog");

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
