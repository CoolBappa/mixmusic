<?php if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };?>
<!DOCTYPE html>
<html lang="en">
<head>
<?include '../inc/title.php';?>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="MobileOptimized" content="320" />
<meta name="format-detection" content="telephone=no" />
<?include '../inc/meta.php';?>
<link rel="stylesheet" href="<?=BASE_PATH?>css/base.css?1.1" type="text/css"/>
<link href='//fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>        
<link rel="shortcut icon" href="/css/images/favicon.ico" />
<link rel="apple-touch-icon-precomposed" href="/css/images/mix-app-touch.png">
</head>
<body>
<div class="head">
<a href="<?=BASE_PATH?>"><img src="<?=LOGO_MOB?>" alt="<?=SITENAME?>" /></a>
</div>
<div id="form-container" class="marginbot-10">
<form method="get" action="<?=BASE_PATH?>search.php" id="searchfrm">
<button type="submit" class="search-submit-button" id="search-btn">Search Now!</button>
<div id="searchtext">
<input id="search" class="searchinput" type="text" name="search" value="<?=$search?>" placeholder="Search for songs..">
</div>
</form>
</div>
<div class="container">
<?
if($parentid > 0 or $def=='songs' or $def=='singer' or $def=='star' or $def=='search'){
include '../files/advt/mob/all_Top.php';
}else{
include '../files/advt/mob/home_Top.php';
}
?>
