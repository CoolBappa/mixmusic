<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
$def = 'download';
$id = intval($_GET['id']);
$getfile = $db->query('select * from file where id = '.$id, database::GET_ROW);
$folq = $db->query("select id as pid,folder,name as catname,name,thumb,fthumb,pathc,starring,url_slug from category where id = ".$getfile['cid'], database::GET_ROW); 
$parentid = $getfile['cid'];
$iffile=count($getfile);
if($iffile==0){
header('HTTP/1.1 404 Not Found');
header("Refresh:0; url=".BASE_PATH."404.php");
exit();
}
if($id != '')
{
$db->query('update file set view = view + 1 where id = '.$id);
$db->query('update file set weekly_dl = weekly_dl + 1 where id = '.$id);
}
$FOLDER = $folq['folder'];
$DES =  $folq['des'];
$NAME = $folq['name'];
$THUMB = $folq['thumb'];
$kk = $db->query('select * from file where id = ' . $id, database::GET_ROW);
$folder = $db->query('select folder from category where id = ' . $kk['cid'], database::GET_FIELD);
$file = $kk['dname'] . '.' . $kk['ext'];
if ($getfile['artist'] ==! '') {
$singerlist = $getfile['artist'];
$sing = array($singerlist);
array_walk($sing , 'intval');
$ids = implode(',', $sing);
$sql = "SELECT * FROM singer_star WHERE id IN ($ids) order by id desc";
$gets = $db->query($sql);
$sing = array();
$singnolink = array();
foreach ($gets as $key => $val) {
$sing[$key] = '<a href="'.BASE_PATH.'songs/'.$val['id'].'/'.url_slug($val['name']).'/">'.$val['name'].'</a>';
$singnolink[$key] = $val['name'];
}
$singer = implode(', ', $sing);
$singtext = implode(', ', $singnolink);
}
$PATH = '<a href="'.BASE_PATH.'">Home</a>'.str_replace('&raquo;','/',$folq['pathc']);
include 'header.tpl';
?>
<h2 class="title-red">Download <?=substr(str_replace('_',' ',$getfile['name']),0,70);?><? if(strlen(str_replace('_',' ',$getfile['name'])) > 70) {echo'...';}?> - <?=$singtext?> Mp3 Song</h2>
<div class="marginbot-10"></div>

<div class="list-group">
<div class="list-group-item aligncenter">
<?
if ($folq['fthumb'] ==! '') {
echo '<img class="round-thumb" src="'.BASE_PATH_SCREEN.$FOLDER.$folq['fthumb'].'"  alt="'.$folq['name'].'" /></center>';
}else{
if($getfile['thumbext'] ==! ''){
echo '<img class="round-thumb" src="'.BASE_PATH_SCREEN.$FOLDER.'thumb-'.$getfile['dname'].'.'.$getfile['thumbext'].'"  alt="'.$getfile['dname'].'" /></center>';
}
}   
?>     
</div>
<div class="list-group-item">
<b>Movie : </b> <?=str_replace('_',' ',$folq['name'])?>
</div>
<div class="list-group-item">
<b>Song Name : </b><?=substr(str_replace('_',' ',$getfile['name']),0,30);?><? if(strlen(str_replace('_',' ',$getfile['name'])) > 30) {echo'...';}?>
</div>
<div class="list-group-item">
<b>Singers : </b><?=$singer?>
</div>
<div class="list-group-item">
<b>Downloads : </b><?=$getfile['view']?>
</div> 
</div>
<?include '../files/advt/mob/download_start.php';?>
<?if($getfile['has_320']==!""){?>
<a class="btn-dl" href="<?=BASE_PATH?>files/download/320kbps/id/<?=$getfile['id']?>/" rel="nofollow">Download in ~ 320Kbps (<?=getsize($getfile['has_320'])?>)</a>
<?}?>
<a class="btn-dl" href="<?=BASE_PATH?>files/download/id/<?=$getfile['id']?>"/ rel="nofollow">Download in ~ 128Kbps (<?=getsize($getfile['size'])?>)</a>
<?if($getfile['has_64']==!""){?>
<a class="btn-dl" href="<?=BASE_PATH?>files/download/64kbps/id/<?=$getfile['id']?>/" rel="nofollow">Download in ~ 64Kbps (<?=getsize($getfile['has_64'])?>)</a>
<?}?>
<?include '../files/advt/mob/download_end.php';?>
<div class="marginbot-10"></div>
<?
if ($getfile['artist'] ==! '') { 
$singers = $getfile['artist'];
$list = explode(',', $singers);
$songs = $db->query("select *  from file where FIND_IN_SET($list[0], artist) > 0 and id <> ".$getfile['id']." order by rand() LIMIT 8");
if(count($singers)==! 0){
echo '<h2 class="title-red">Related Mp3 Songs</h2>';
echo '<div class="list-group">';
foreach($songs as $field => $sing){	
?>
<a class="list-group-item padding-6" href="<?= BASE_PATH ?>download/<?=$sing['id']?>/<?=url_slug($sing['name']) ?>/">
<div class="post-1">
<div class="post-thumb">
<img src="<?= BASE_PATH ?>css/images/dir-music-l.png" alt="<?=$sing['name']?>" />
</div>
<div class="post-data">
<?=str_replace('_',' ',$sing['name'])?>
</div>
<div class="clear"></div>	
</div>
</a>
<?}?>
</div>
<?}?>
<?}?>
<? include 'footer.tpl'; ?>        	