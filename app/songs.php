<?php
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')){
header('Content-Encoding: gzip');
ob_start('ob_gzhandler');
}
header('Content-Type: text/html; charset=utf-8');
if (isset($_GET['id'])){
}else{
header('Location:/404.php');
}
include '../settings.php';
include '../'.$set->template.'/songs.tpl';
?> 