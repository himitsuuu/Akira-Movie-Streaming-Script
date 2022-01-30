<?php
$red = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (!empty($_GET['srt'])) {
switch($_GET['srt']) {
  case '2';
  $srt_txt = "Rating";
  $srt_query = " ORDER BY tbl_reviews.rates DESC ";
  break;


  case '1';
  $srt_txt = "First Created";
  $srt_query = " ORDER BY tbl_reviews.id ASC ";
  break;

  default;
  $srt_txt = "Last Created";
  $srt_query = " ORDER BY tbl_reviews.id DESC ";
  break;

}
}else{
  $srt_txt = "Last Created";
  $srt_query = " ORDER BY tbl_reviews.id DESC ";
}


if (!empty($_GET['keywords'])) {
$keyword = '%'.$_GET['keywords'].'%';
$keytext = $_GET['keywords'];
$search_query = " WHERE tbl_reviews.comment LIKE ? ";
}else{
$keyword = "";
$keytext = "";
$search_query = "";
}

$final_query = "SELECT * FROM tbl_reviews LEFT JOIN tbl_items ON tbl_reviews.item = tbl_items.item_id LEFT JOIN tbl_users ON tbl_reviews.user = tbl_users.id $search_query $srt_query";
?>
