<?php
$red = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (!empty($_GET['srt'])) {
switch($_GET['srt']) {
  case '2';
  $srt_txt = "Rating";
  $srt_query = " ORDER BY rates DESC ";
  break;

  case '3';
  $srt_txt = "Views";
  $srt_query = " ORDER BY views DESC ";
  break;

  case '1';
  $srt_txt = "First Created";
  $srt_query = " ORDER BY c_id ASC ";
  break;

  default;
  $srt_txt = "Last Created";
  $srt_query = " ORDER BY c_id DESC ";
  break;

}
}else{
  $srt_txt = "Last Created";
  $srt_query = " ORDER BY c_id DESC ";
}


if (!empty($_GET['keywords'])) {
$keyword = '%'.$_GET['keywords'].'%';
$keytext = $_GET['keywords'];
$search_query = " WHERE title LIKE ? ";
}else{
$keyword = "";
$keytext = "";
$search_query = "";
}

$final_query = "SELECT * FROM tbl_items $search_query $srt_query";
?>
