<?php
error_reporting(0);
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');
require_once('../../const/uniques.php');
require_once('../../const/web-info.php');

if ($role == "admin") {
if (!empty($_POST['submit'])) {

//Logo update:
if (!empty($_FILES["logo"]["name"])) {

$target_dir = "../../img/";
$target_file = $target_dir . basename($_FILES["logo"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$destn_file = 'logo'.get_rand_numbers(3).'.'.$imageFileType.'';
$destn_upload = $target_dir . $destn_file;
$prev_logo = AppLogo;

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
$_SESSION['reply'] = "017";
header("location:../settings");
}else{
if (move_uploaded_file($_FILES["logo"]["tmp_name"], $destn_upload)) {
unlink("../../img/$prev_logo");
try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_web_info SET logo = ?");
$stmt->execute([$destn_file]);

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}
}else{

}
}

}


//Favicon update:
if (!empty($_FILES["favicon"]["name"])) {

$target_dir = "../../icon/";
$target_file = $target_dir . basename($_FILES["favicon"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$destn_file = 'favicon'.get_rand_numbers(3).'.'.$imageFileType.'';
$destn_upload = $target_dir . $destn_file;
$prev_favicon = AppIcon;

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "ico") {
$_SESSION['reply'] = "018";
header("location:../settings");
}else{
if (move_uploaded_file($_FILES["favicon"]["tmp_name"], $destn_upload)) {
unlink("../../icon/$prev_favicon");
try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_web_info SET icon = ?");
$stmt->execute([$destn_file]);

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}
}else{

}
}

}

//Item Details Background update:
if (!empty($_FILES["item_details"]["name"])) {

$target_dir = "../../img/";
$target_file = $target_dir . basename($_FILES["item_details"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$destn_file = 'itemdetails'.get_rand_numbers(3).'.'.$imageFileType.'';
$destn_upload = $target_dir . $destn_file;
$prev_item_bg = AppItemDetail;

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
$_SESSION['reply'] = "013";
header("location:../settings");
}else{
if (move_uploaded_file($_FILES["item_details"]["tmp_name"], $destn_upload)) {
unlink("../../img/$prev_item_bg");
try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_web_info SET item_details_bg = ?");
$stmt->execute([$destn_file]);

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}
}else{

}
}

}


//Account Pages Background update:
if (!empty($_FILES["account_pages"]["name"])) {

$target_dir = "../../img/";
$target_file = $target_dir . basename($_FILES["account_pages"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$destn_file = 'authpages'.get_rand_numbers(3).'.'.$imageFileType.'';
$destn_upload = $target_dir . $destn_file;
$prev_item_auth = AppAuthBG;

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
$_SESSION['reply'] = "013";
header("location:../settings");
}else{
if (move_uploaded_file($_FILES["account_pages"]["tmp_name"], $destn_upload)) {
unlink("../../img/$prev_item_auth");
try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("UPDATE tbl_web_info SET auth_bg = ?");
$stmt->execute([$destn_file]);

}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}
}else{

}
}

}


$_SESSION['reply'] = "012";
header("location:../settings");


}else{
header("location:../");
}
}else{
header("location:../");
}
?>
