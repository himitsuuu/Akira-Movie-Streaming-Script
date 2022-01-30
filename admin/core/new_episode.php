<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');

if ($role == "admin") {
if (!empty($_POST['submit'])) {
$link = $_POST['link'];
$size = $_POST['size'];
$movie = $_POST['movie'];
$streaming = $_POST['streaming'];
$number = $_POST['number'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_episodes WHERE item = ? AND size = ? AND episode_no = ?");
$stmt->execute([$movie, $size, $number]);
$result = $stmt->fetchAll();

if (count($result) > 0) {
$_SESSION['reply'] = "009";
header("location:../media?node=$movie");
}else{
$stmt = $conn->prepare("INSERT INTO tbl_episodes (item, link, size, streaming, episode_no) VALUES (?,?,?,?,?)");
$stmt->execute([$movie, $link, $size, $streaming, $number]);
$_SESSION['reply'] = "015";
header("location:../media?node=$movie");
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
