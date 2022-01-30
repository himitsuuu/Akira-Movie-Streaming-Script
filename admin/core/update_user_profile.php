<?php
session_start();
require_once('../../db/config.php');
require_once('../../const/check_session.php');
require_once('../../const/uniques.php');

if ($role == "admin") {
if (!empty($_POST['submit'])) {

  $current_user = $_POST['user_id'];

  $first_name = ucwords($_POST['first_name']);
  $last_name = ucwords($_POST['last_name']);
  $email = $_POST['email'];
  $username = $_POST['username'];
  $verification = $_POST['verification'];

  if (!empty($_FILES["avator"]["name"])) {

  try {
  $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE email = ? AND id != ? OR username = ? AND id != ?");
  $stmt->execute([$email, $current_user, $username, $current_user]);
  $result = $stmt->fetchAll();

  if (count($result) > 0) {

  foreach($result as $row) {
    if ($row[3] == $email) {
      $_SESSION['reply'] = "001";
      header("location:../edit-user?node=$current_user");
    }else{
      if ($row[4] == $rusername) {
        $_SESSION['reply'] = "002";
        header("location:../edit-user?node=$current_user");
      }
    }
  }


  }else{



  $target_dir = "../../img/users/";
  $target_file = $target_dir . basename($_FILES["avator"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $destn_file = 'avator'.$current_user.''.get_rand_numbers(3).'.'.$imageFileType.'';
  $destn_upload = $target_dir . $destn_file;

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  $_SESSION['reply'] = "013";
  header("location:../edit-user?node=$current_user");
  }else{

  if (move_uploaded_file($_FILES["avator"]["tmp_name"], $destn_upload)) {
  if ($image == "user.svg") {
  }else{
  unlink("../../img/users/$image");
  }

  $stmt = $conn->prepare("UPDATE tbl_users SET first_name = ?, last_name = ?, email = ?, username = ?, image = ?, badge = ? WHERE id = ?");
  $stmt->execute([$first_name, $last_name, $email, $username, $destn_file, $verification, $current_user]);

  $_SESSION['reply'] = "012";
  header("location:../edit-user?node=$current_user");


  }else{
  $_SESSION['reply'] = "014";
  header("location:../edit-user?node=$current_user");
  }

  }


  }


  }catch(PDOException $e)
  {
  echo "Connection failed: " . $e->getMessage();
  }



  }else{


  try {
  $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE email = ? AND id != ? OR username = ? AND id != ?");
  $stmt->execute([$email, $current_user, $username, $current_user]);
  $result = $stmt->fetchAll();

  if (count($result) > 0) {

  foreach($result as $row) {
    if ($row[3] == $email) {
      $_SESSION['reply'] = "001";
      header("location:../edit-user?node=$current_user");
    }else{
      if ($row[4] == $rusername) {
        $_SESSION['reply'] = "002";
        header("location:../edit-user?node=$current_user");
      }
    }
  }


  }else{

  $stmt = $conn->prepare("UPDATE tbl_users SET first_name = ?, last_name = ?, email = ?, username = ?, badge = ? WHERE id = ?");
  $stmt->execute([$first_name, $last_name, $email, $username, $verification, $current_user]);

  $_SESSION['reply'] = "012";
  header("location:../edit-user?node=$current_user");

  }


  }catch(PDOException $e)
  {
  echo "Connection failed: " . $e->getMessage();
  }

  }



}else{
header("location:../");
}
}else{
header("location:../");
}
?>
