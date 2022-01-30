<?php
$red = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (!empty($_GET['srt'])) {
switch($_GET['srt']) {
  case '1';
  $srt_txt = "First Created";
  $srt_query = " ORDER BY tbl_comments.id ASC ";
  break;

  default;
  $srt_txt = "Last Created";
  $srt_query = " ORDER BY tbl_comments.id DESC ";
  break;

}
}else{
  $srt_txt = "Last Created";
  $srt_query = " ORDER BY tbl_comments.id DESC ";
}


if (!empty($_GET['keywords'])) {
$keyword = '%'.$_GET['keywords'].'%';
$keytext = $_GET['keywords'];
$search_query = " WHERE tbl_comments.comment LIKE ? ";
}else{
$keyword = "";
$keytext = "";
$search_query = "";
}

$final_query = "SELECT * FROM tbl_comments LEFT JOIN tbl_items ON tbl_comments.item = tbl_items.item_id LEFT JOIN tbl_users ON tbl_comments.user = tbl_users.id $search_query $srt_query";
?>
