<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
$def = 'songs';
$id = $_GET['id']; 
$getA = 'select * from singer_star where id = '.$id;
$getAlist = $db->query($getA,  database::GET_ROW);
if(count($getAlist) > 0){
$name = $getAlist['name'];
$rowsPerPage = FILEPERPAGE_MOB;
if($getAlist['singer']=='1'){
$pagingqry = "select *  from category as c,file as f where FIND_IN_SET($id, f.artist) > 0  and f.cid = c.id";
$who = "singers";
}
elseif($getAlist['star']=='1'){
$pagingqry = "select *  from category as c,file as f where FIND_IN_SET($id, c.starring) > 0  and f.cid = c.id";
$who = "stars";
}
$gets = '?';
$pagelink = BASE_PATH . 'songs/'.$getAlist['id'].'/';
$htmlpage = '/'.url_slug($getAlist['name']).'/';
$pagingpassid = 'f.id';
include 'paging.tpl';
if(isset($_GET['page'])){
if($_GET['page'] > $maxPage or $_GET['page'] == '0'){
header('HTTP/1.1 404 Not Found');
header("Refresh:0; url=".BASE_PATH."404.php");
exit();
}
}
$FILE = $db->query($pagingqry.$limit,0,'no');
$LISTTOTAL = count($FILE);
$PATH = '<a href="'.BASE_PATH.'">Home</a> / <a href="'.BASE_PATH.$who.'">'.$who.'</a> / <a href="'.BASE_PATH.'songs/'.$getAlist['id'].'/'.$getAlist['name'].'/">'.$getAlist['name'].'</a> / Songs';
include 'header.tpl';
?>
<h2 class="title-red"><?=$name?> - Songs</h2>
<div class="fileinfo aligncenter">
<?if($getAlist['thumb']==!''){?>
<img class="roundthumb marginbot-10" src="<?=BASE_PATH?>files/starsinger-icon/large-<?=$getAlist['thumb']?>" alt="<?=$name?>" />
<?}else{?>
<img class="roundthumb marginbot-10" src="<?=BASE_PATH?>css/images/none-b.png" alt="<?=$name?>" />
<?}?>
<p><?=$name?></p>
<? if($getAlist['des']==!''){?>
<span class="artistbox"><?=$getAlist['des']?></span>
<?}?>
</div>
<?include '../files/advt/mob/file_start.php';?>
<div class="list-group">
<?
if ($LISTTOTAL != 0){
for ($i = 0; $i < $LISTTOTAL; $i++) 
{ 
$folddetail = $db->query('select * from category where id =' .$FILE[$i]['cid'] , database::GET_ROW);  
?>
<a class="list-group-item" href="<?= BASE_PATH ?>download/<?= $FILE[$i]['id'] ?>/<?=url_slug($FILE[$i]['name']) ?>/">
<div class="post-1">
<?echo '<div class="post-thumb"><img src="'.BASE_PATH.'css/images/dir-music-l.png" alt="'.$FILE[$i]['name'].'" /></div>';?>
<div class="post-data">
<?= str_replace('_',' ',$FILE[$i]['name']) ?>
<p><span class="artistbox"> <?=str_replace('_',' ',$folddetail['name'])?></span></p>	
</div>
<div class="clear"></div>	
</div>
</a>
<?
}
echo '</div>';
}
?>
<?include '../files/advt/mob/file_end.php';?>
<?=$PAGE_CODE;?>
<?
}else{
header("Refresh:0; url=".BASE_PATH."404.php");
exit();
}
include 'footer.tpl'; 
?>