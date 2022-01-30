<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/uniques.php');
require_once('../../const/web-info.php');
require_once('../../const/check_session.php');

if ($role == "admin") {
if (!empty($_POST['submit'])) {
$item = $_POST['item_id'];
$title = ucwords($_POST['title']);
$description = $_POST['description'];
$year = $_POST['year'];
$running_time = $_POST['running_time'];
$plan_type = $_POST['plan_type'];
$age = $_POST['age'];
$genre = implode(",",$_POST['gen']);
if (!empty($_POST['trailer'])) {
$trailer = $_POST['trailer'];
}else{
$trailer = "";
}

$old_cover = $_POST['old_cover'];
$old_thumbnail = $_POST['old_thumbnail'];

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_items SET title = ?, description = ?, year = ?, run_time = ?, plan = ?, age = ?, genres = ?, trailer_link = ? WHERE item_id = ?");
$stmt->execute([$title, $description, $year, $running_time, $plan_type, $age, $genre, $trailer, $item]);

if (!empty($_FILES["form__img-upload"]["name"])) {

$target_dir = "../../uploads/cover/";
$target_file = $target_dir . basename($_FILES["form__img-upload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$destn_file = 'cover'.$item.''.get_rand_numbers(3).'.'.$imageFileType.'';
$destn_upload = $target_dir . $destn_file;
$old_cover = $_POST['old_cover'];

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {

}else{
if (move_uploaded_file($_FILES["form__img-upload"]["tmp_name"], $destn_upload)) {
unlink("../../uploads/cover/$old_cover");

$stmt = $conn->prepare("UPDATE tbl_items SET cover = ? WHERE item_id = ?");
$stmt->execute([$destn_file, $item]);

}
}

}


if (!empty($_FILES["gallery"]["name"])) {

$target_dir = "../../uploads/thumbnail/";
$target_file = $target_dir . basename($_FILES["gallery"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$destn_file = 'thumb'.$item.''.get_rand_numbers(3).'.'.$imageFileType.'';
$destn_upload = $target_dir . $destn_file;
$old_thumb = $_POST['old_thumbnail'];

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {

}else{
if (move_uploaded_file($_FILES["gallery"]["tmp_name"], $destn_upload)) {
unlink("../../uploads/thumbnail/$old_thumb");

$stmt = $conn->prepare("UPDATE tbl_items SET thumbnail = ? WHERE item_id = ?");
$stmt->execute([$destn_file, $item]);

}
}

}

$_SESSION['reply'] = "012";
header("location:../edit_item?node=$item");
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
