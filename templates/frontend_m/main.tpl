<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
include 'header.tpl';
if($parentid == 0){
include 'movies.tpl';
include '../files/advt/mob/update_start.php';
include 'new-releases.tpl';
include '../files/advt/mob/homecat_start.php';
include 'home.cat.tpl';
include '../files/advt/mob/homecat_end.php';
include 'browse.more.tpl';
}else{
if($folddetail['subcate'] == 0){
include 'file.tpl';
}else{
include 'cat.tpl';
}
}
include 'footer.tpl';
?>