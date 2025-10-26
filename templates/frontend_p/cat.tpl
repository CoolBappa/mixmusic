<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
$sort=$_GET['sort'];
$rowsPerPage=CATPERPAGE_PC;
if($sort == 'az'){
$pagingqry = "select * from category where parentid = ".$parentid. ' and active=0 order by name asc';
$gets='?';
$pagelink = BASE_PATH.'cat/az/'.$parentid.'/';
}
elseif($sort == ''){
$pagingqry = "select * from category where parentid = ".$parentid. ' and active=0 order by kram desc';
$gets='?';
$pagelink = BASE_PATH.'cat/'.$parentid.'/';
}
else{
$pagingqry = "select * from category where parentid = ".$parentid. ' and active=0 order by kram desc';
$gets='?';
$pagelink = BASE_PATH.'cat/'.$parentid.'/';
}
$htmlpage = '/'.url_slug($folddetail['name']).'/';
include 'paging.tpl';
$CATEGORY = $db->query($pagingqry.$limit);
$totcat = count($CATEGORY);
//####### Directory Listing ########
echo '<h2 class="title-red border-bot-2">';
echo '<span class="pull-left">'.str_replace('_',' ',$folddetail['name']).'</span>';
?>
<div class="sortContainer pull-right">
<? if($sort == 'az'){ ?>
<a href="<?=BASE_PATH?>cat/<?=$parentid?>/<?=$PAGE?>/<?=url_slug($folddetail['name'])?>/"><span class="btn-inactive">New</span></a>&nbsp;&nbsp;|&nbsp;&nbsp;
<a href="#"><span class="btn-active">A to Z</span></a>
<?}else{?>
<a href="#"><span class="btn-active">New</span></a>&nbsp;&nbsp;|&nbsp&nbsp;
<a href="<?=BASE_PATH?>cat/az/<?=$parentid?>/<?=$PAGE?>/<?=url_slug($folddetail['name'])?>/"><span class="btn-inactive">A to Z</span></a>
<?}?>
</div>
<div class="clear"></div>
<?
echo '</h2>';
$l = 1;
echo '<div class="row">'; 
for($i = 0 ; $i < $totcat ; $i++){
if($l==1){
$l++;
$class='cat-1';
}else{
$l=1;
$class='cat-2';
}
if($CATEGORY[$i]['displayname']== ''){   
$catname = $CATEGORY[$i]['name'] ;
}else{
$catname= $CATEGORY[$i]['displayname'];
} 
if($CATEGORY[$i]['customlink']== ''){
echo '<a href="'.BASE_PATH.'cat/'.$CATEGORY[$i]['id'].'/'.url_slug($CATEGORY[$i]['name'].'-'.$CATEGORY[$i]['url_slug']).'/">';
}else{
echo '<a href="'.$CATEGORY[$i]['customlink'].'">';
}
echo '<div class="col-xs-3">'; 
echo '<div class="items">';
echo '<div class="items-thumb">';
if($CATEGORY[$i]['fthumb'] ==! ''){
echo '<img class="thumbnail img-responsive" src="'.BASE_PATH_SCREEN.$CATEGORY[$i]['folder'].'mid-'.$CATEGORY[$i]['fthumb'].'"  alt="'.str_replace('_',' ',$CATEGORY[$i]['name']).'" />';
}else{
echo '<img class="thumbnail img-responsive" src="'.BASE_PATH.'css/images/no-cat.png"  alt="'.str_replace('_',' ',$CATEGORY[$i]['name']).'" />';
} 
echo '</div>';
echo '<div class="items-data">';
echo str_replace('_',' ',$catname).''; 
echo '</div>';
//echo '<div class="clear"></div>';
echo '</div>';
echo '</div>';
echo '</a>';
}
echo '</div>';
echo $PAGE_CODE;
?>        