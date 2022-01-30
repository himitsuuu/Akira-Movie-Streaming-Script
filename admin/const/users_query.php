<?php
$red = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$srt_query = " ORDER BY tbl_users.first_name ";

if (!empty($_GET['keywords'])) {
$keyword1 = '%'.$_GET['keywords'].'%';
$keytext = $_GET['keywords'];
$keyword = [$keyword1, $keyword1, $keyword1, $keyword1, $keyword1];
$search_query = " WHERE tbl_users.first_name LIKE ? OR tbl_users.last_name LIKE ? OR tbl_users.id LIKE ? OR tbl_users.username LIKE ? OR tbl_users.email LIKE ?";
}else{
$keyword = "";
$keytext = "";
$search_query = "";
}

$final_query = "SELECT * FROM tbl_users LEFT JOIN tbl_user_plans ON tbl_users.id = tbl_user_plans.user $search_query $srt_query";
?>
