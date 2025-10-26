<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
$sort=$_GET['sort'];
$def = 'singer';
$rowsPerPage=CATPERPAGE_PC;;
if($sort == 'az'){
$pagingqry = 'select * from `singer_star` where singer = 1 order by name asc';
$gets='?';
$pagelink = BASE_PATH.'singers/az/';
}
elseif($sort == ''){
$pagingqry = 'select * from `singer_star` where singer = 1 order by kram desc';
$gets='?';
$pagelink = BASE_PATH.'singers/';
}
else{
$pagingqry = 'select * from `singer_star` where singer = 1 order by kram desc';
$gets='?';
$pagelink = BASE_PATH.'singers/';
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
$SINGERS = $db->query($pagingqry.$limit);
$PATH = '<a href="'.BASE_PATH.'">Home</a> / Singers List';
include 'header.tpl';
include '../files/advt/pc/all_page_top.php';
echo '<h2 class="title-red border-bot-2">';
echo '<span class="pull-left">Popular Singers</span>';
?>
<div class="sortContainer pull-right">
<? if($sort == 'az'){ ?>
<a href="<?=BASE_PATH?>singers/<?=$PAGE?>"><span class="btn-inactive">Popular</span></a>&nbsp;&nbsp;|&nbsp;&nbsp;
<a href="#"><span class="btn-active">A to Z</span></a>
<?}else{?>
<a href="#"><span class="btn-active">Popular</span></a>&nbsp;&nbsp;|&nbsp&nbsp;
<a href="<?=BASE_PATH?>singers/az/<?=$PAGE?>"><span class="btn-inactive">A to Z</span></a>
<?}?>
</div>
<div class="clear"></div>
<?
echo '</h2>';
$l = 1;
$totcat = count($SINGERS);
echo '<div class="row">'; 
echo '<div class="list-group">';
for($i = 0 ; $i < $totcat ; $i++){
if($l==1){
$l++;
$class='cat-1';
}else{
$l=1;
$class='cat-2';
}
echo '<div class="col-xs-6">'; 
echo '<a class="list-group-item padding-6 marginbot-10" href="'.BASE_PATH.'songs/'.$SINGERS[$i]['id'].'/'.url_slug($SINGERS[$i]['name']).'/">';
if($SINGERS[$i]['thumb']==!''){
echo '<img class="round-thumbnail" src="'.BASE_PATH.'files/starsinger-icon/'.$SINGERS[$i]['thumb'].'" alt="'.$SINGERS[$i]['name'].'" />';
}else{
echo '<img class="round-thumbnail" src="'.BASE_PATH.'css/images/none-s.png" alt="'.$SINGERS[$i]['name'].'" />';
}
echo $SINGERS[$i]['name'];
echo '</a>';
echo '</div>';
}
echo '</div>';
echo '</div>';
echo $PAGE_CODE;
include 'footer.tpl';
?>        