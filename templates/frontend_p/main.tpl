<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
include 'header.tpl';
if($parentid == 0){
include 'movies.tpl';
include '../files/advt/pc/homepage_top.php';
include 'new-releases.tpl';
include '../files/advt/pc/homepage_middle.php';
include 'homegroup.tpl';
include '../files/advt/pc/homepage_bottom.php';
}else{
if($folddetail['subcate'] == 0){
include '../files/advt/pc/all_page_top.php';
include 'file.tpl';
if($folddetail['artist'] ==! ''){
include '../files/advt/pc/all_page_middle.php';
include 'artist.tpl';
}
}else{
include '../files/advt/pc/all_page_top.php';
include 'cat.tpl';
}
}
include 'footer.tpl';
?>