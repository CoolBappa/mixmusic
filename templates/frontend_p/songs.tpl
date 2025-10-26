<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
$def = 'songs';
$id = $_GET['id']; 
$getA = 'select * from singer_star where id = '.$id;
$getAlist = $db->query($getA,  database::GET_ROW);
if(count($getAlist) > 0){
$name = $getAlist['name'];
$rowsPerPage = FILEPERPAGE_PC;
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
include '../files/advt/pc/all_page_top.php';
?>
<h2 class="title-red"><?=$name?> - Songs</h2>
<div class="fileinfo alignCenter">
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
<?include '../files/advt/pc/all_page_middle.php';?>
<div class="panel panel-default">
<div class="panel-body">
<?
if ($LISTTOTAL != 0){
echo '<div class="row">';
for ($i = 0; $i < $LISTTOTAL; $i++) 
{ 
$folddetail = $db->query('select * from category where id =' .$FILE[$i]['cid'] , database::GET_ROW);  
?>
<a href="<?= BASE_PATH ?>download/<?= $FILE[$i]['id'] ?>/<?=url_slug($FILE[$i]['name']) ?>/">
<div class="post-1 <?if($file_tot == 1 or $i==$LISTTOTAL-1){echo'border-0';}?>">
<?echo '<div class="post-thumb"><button type="button" class="btn btn-sm btn-default btn-circle"><i class="glyphicon glyphicon-play"></i></button></div>';?>
<div class="post-data vertcent">
<div class="pull-left">
<?= str_replace('_',' ',$FILE[$i]['name']) ?>
<p><span class="artistbox"> <?=str_replace('_',' ',$folddetail['name'])?></span></p>	
</div>
<div class="pull-right">
<span class="view"><?=$FILE[$i]['view']?> downloads</span>
</div>	
<div class="clear"></div>                
</div>
<div class="clear"></div>	
</div>
</a>
<?
}
echo '</div>';
}
?>
<?=$PAGE_CODE;?>
</div>
</div>
<?
}else{
header('HTTP/1.1 404 Not Found');
header("Refresh:0; url=".BASE_PATH."404.php");
exit();
}
include 'footer.tpl'; 
?>