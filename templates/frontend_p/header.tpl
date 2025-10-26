<?php if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };?>
<!DOCTYPE html>
<html lang="en">
<head>
<?include '../inc/title.php';?>
<meta name="viewport" content="width=1000" />
<?include '../inc/meta.php';?>
<link rel="canonical" href="<?echo'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>" />
<link href="<?=BASE_PATH?>css/bootstrap.min.3.3.6.css?1.2" rel="stylesheet" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.css" />
<link rel="stylesheet" href="<?=BASE_PATH?>css/basePc.css?1.3" type="text/css"/>
<link href="//fonts.googleapis.com/css?family=Play" rel="stylesheet" type="text/css" />
<link href="//fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css" />        
<link rel="shortcut icon" href="/css/images/favicon.ico" />
<link href="/css/images/mix-app-touch.png" rel="apple-touch-icon-precomposed">
</head>
<body>
<div class="head">
<nav class="navbar navbar-default">
<div class="container">
<div class="row">
<div class="navbar-header">
<a class="navbar-brand" href="<?=BASE_PATH?>"><img src="<?=LOGO_PC?>" alt="<?=SITENAME?>" />
</a>
</div>
<div class="nav navbar-right">
<?include '../files/advt/pc/logo_beside.php';?>
</div> 
</div>
</div>
<div id="form-container">
<div class="container padding-0">
<div class="row">
<div class="col-xs-9">
<form method="get" action="<?=BASE_PATH?>search.php" id="searchfrm">
<button type="submit" class="search-submit-button" id="search-btn">Search Now!</button>
<div id="searchtext">
<input id="search" class="searchinput" type="text" name="search" value="<?=$search?>" placeholder="Search For Songs etc..">
</div>
</form>
</div>
<div class="col-xs-3">
<div class="social-wrapper">
<a href="http://facebook.com/mixmusicin"><div class="social fb"><i class="fa fa-facebook"></i></div></a>
<div class="social twitter"><i class="fa fa-twitter"></i></div>
<div class="social google"><i class="fa fa-google-plus"></i></div>
</div>
</div>
</div>
</div>
</div>
</nav>
</div>
<?
if($parentid > 0 or $def=='songs' or $def=='singer' or $def=='star' or $def=='search'){
echo '<div class="breadcrumb"><div class="container padding-0">'.$PATH.'</div></div>';
}
?>
<div class="container padding-0">
<div class="row">
<div class="col-xs-4"> 
<?include '../files/advt/pc/sidebar.php';?>
<h2 class="title-dark">Categories</h2>
<div class="list-group">
<?
$cat_list =$db->query('select * from `category` where parentid=0 and active=0 order by kram desc'); 
foreach($cat_list as $field => $cat_value){ 
if($cat_value['displayname']== ''){   
$caname = $cat_value['name'];
}else{
$caname= $cat_value['displayname'];
}
if($cat_value['customlink']== ''){
echo '<a class="list-group-item padding-6" href="'.BASE_PATH.'cat/'.$cat_value['id'].'/'.url_slug($cat_value['name']).'/">';
}else{
echo '<a class="list-group-item padding-6" href="'.$cat_value['customlink'].'">';
}
echo '<span class="btn btn-default btn-circle"><i class="fa fa-music"></i></span>&nbsp;&nbsp;&nbsp;';
echo str_replace('_',' ',$caname);
echo '</a>';
}
?>
</div>
<h2 class="title-dark">Browse More</h2>
<div class="list-group">
<a class="list-group-item padding-6" href="<?=BASE_PATH?>singers/"><span class="btn btn-default btn-circle"><i class="gl-icon fa fa-star"></i></span>&nbsp;&nbsp;&nbsp;Singers</a>
<a class="list-group-item padding-6" href="<?=BASE_PATH?>stars/"><span class="btn btn-default btn-circle"><i class="gl-icon fa fa-star"></i></span>&nbsp;&nbsp;&nbsp;Stars</a>
</div>
<?
if($parentid==0){
include 'top.tpl';
}
?>
</div>
<div class="col-xs-8">