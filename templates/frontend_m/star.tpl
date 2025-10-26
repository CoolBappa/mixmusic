<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
$sort=$_GET['sort'];
$def='star';
$rowsPerPage=CATPERPAGE_MOB;
if($sort == 'az'){
$pagingqry = 'select * from `singer_star` where star = 1 order by name asc';
$gets='?';
$pagelink = BASE_PATH.'stars/az/';
}
elseif($sort == ''){
$pagingqry = 'select * from `singer_star` where star = 1 order by kram desc';
$gets='?';
$pagelink = BASE_PATH.'stars/';
}
else{
$pagingqry = 'select * from `singer_star` where star = 1 order by kram desc';
$gets='?';
$pagelink = BASE_PATH.'stars/';
}
$htmlpage = '/';
include 'paging.tpl';
if(isset($_GET['page'])){
if($_GET['page'] > $maxPage or $_GET['page'] == '0'){
header('HTTP/1.1 404 Not Found');
header("Refresh:0; url=".BASE_PATH."404.php");
exit();
}
}
$STARS = $db->query($pagingqry.$limit);
$PATH = '<a href="'.BASE_PATH.'">Home</a> / Stars List';
include 'header.tpl';
echo '<h2 class="title-red border-bot-2">';
echo '<span class="pull-left">Popular Stars</span>';
?>
<div class="sortContainer pull-right">
<? if($sort == 'az'){ ?>
<a href="<?=BASE_PATH?>stars/<?=$PAGE?>"><span class="btn-inactive">Popular</span></a>&nbsp;&nbsp;|&nbsp;&nbsp;
<a href="#"><span class="btn-active">A to Z</span></a>
<?}else{?>
<a href="#"><span class="btn-active">Poplular</span></a>&nbsp;&nbsp;|&nbsp&nbsp;
<a href="<?=BASE_PATH?>stars/az/<?=$PAGE?>"><span class="btn-inactive">A to Z</span></a>
<?}?>
</div>
<?include '../files/advt/mob/all_cat_start.php';?>
<?
echo '</h2>';
echo '<div class="list-group">';
$l = 1;
$totcat = count($STARS);
for($i = 0 ; $i < $totcat ; $i++){
if($l==1){
$l++;
$class='cat-1';
}else{
$l=1;
$class='cat-2';
}
echo '<a class="list-group-item" href="'.BASE_PATH.'songs/'.$STARS[$i]['id'].'/'.url_slug($STARS[$i]['name']).'/">';
echo '<div class="post-1">';
echo '<div class="post-thumb">';
if($STARS[$i]['thumb']==!''){
echo '<img class="round-thumb" src="'.BASE_PATH.'files/starsinger-icon/'.$STARS[$i]['thumb'].'" alt="'.$STARS[$i]['name'].'" />';
}else{
echo '<img class="round-thumb" src="'.BASE_PATH.'css/images/none-s.png" alt="'.$STARS[$i]['name'].'" />';
}
echo '</div>';
echo '<div class="post-data">';
echo $STARS[$i]['name'];
echo '</div>';
echo '<div class="clear"></div>';
echo '</div>';
echo '</a>';
}
echo '</div>';
include '../files/advt/mob/all_cat_end.php';
echo $PAGE_CODE;
include 'footer.tpl';
?>        