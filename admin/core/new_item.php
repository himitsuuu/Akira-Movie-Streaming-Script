<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/uniques.php');
require_once('../../const/web-info.php');
require_once('../../const/check_session.php');



if ($role == "admin") {
if (!empty($_POST['submit'])) {
$upload_date = date('M d, Y h:i:s');
$item_id = get_rand_numbers(12);
$target_dir = "../../uploads/cover/";
$target_file = $target_dir . basename($_FILES["form__img-upload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$destn_file = 'cover'.$item_id.''.get_rand_numbers(3).'.'.$imageFileType.'';
$destn_upload = $target_dir . $destn_file;
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
$_SESSION['reply'] = "013";
header("location:../add-item");
}else{

if (move_uploaded_file($_FILES["form__img-upload"]["tmp_name"], $destn_upload)) {


$target_dir_b = "../../uploads/thumbnail/";
$target_file_b = $target_dir_b . basename($_FILES["gallery"]["name"]);
$imageFileType_b = strtolower(pathinfo($target_file_b,PATHINFO_EXTENSION));
$destn_file_b = 'thumb'.$item_id.''.get_rand_numbers(3).'.'.$imageFileType_b.'';
$destn_upload_b = $target_dir_b . $destn_file_b;

if($imageFileType_b != "jpg" && $imageFileType_b != "png" && $imageFileType_b != "jpeg") {
unlink($destn_upload);
$_SESSION['reply'] = "013";
header("location:../add-item");
}else{

if (move_uploaded_file($_FILES["gallery"]["tmp_name"], $destn_upload_b)) {
$title = ucwords($_POST['title']);
$description = $_POST['description'];
$year = $_POST['year'];
$running_time = $_POST['running_time'];
$plan_type = $_POST['plan_type'];
$age = $_POST['age'];
$up_type = $_POST['up_type'];
$genre = implode(",",$_POST['gen']);
if (!empty($_POST['trailer'])) {
$trailer = $_POST['trailer'];
}else{
$trailer = "";
}

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("INSERT INTO tbl_items (title, item_id, description, year, run_time, plan, age, upload_type, genres, thumbnail, trailer_link, upload_date, cover) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->execute([$title, $item_id, $description, $year, $running_time, $plan_type, $age, $up_type, $genre, $destn_file_b, $trailer, $upload_date, $destn_file]);
header("location:../media?node=$item_id");
}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}


}else{
unlink($destn_upload);
$_SESSION['reply'] = "014";
header("location:../add-item");
}

}

} else {
$_SESSION['reply'] = "014";
header("location:../add-item");
}

}


}else{
header("location:../");
}
}else{
header("location:../");
}
?>
