<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
$def = 'download';
$id = intval($_GET['id']);
$getfile = $db->query('select * from file where id = '.$id, database::GET_ROW);
$parentid = $getfile['cid'];
$iffile=count($getfile);
if($iffile==0){
header('HTTP/1.1 404 Not Found');
header("Refresh:0; url=".BASE_PATH."404.php");
exit();
}
$folq = $db->query("select id as pid,folder,name as catname,name,thumb,fthumb,pathc,starring,url_slug from category where id = ".$getfile['cid'], database::GET_ROW); 
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
include '../files/advt/pc/all_page_top.php';
?>
<h2 class="title-red">Download <?=substr(str_replace('_',' ',$getfile['name']),0,70);?><? if(strlen(str_replace('_',' ',$getfile['name'])) > 70) {echo'...';}?> - <?=$singtext?> Mp3 Song</h2>
<div class="marginbot-10"></div>
<div class="dlinfo"> 
<div class="row row-eq-height">
<div class="col-xs-4 padding-0">
<?
if ($folq['fthumb'] ==! '') {
echo '<img class="img-responsive" src="'.BASE_PATH_SCREEN.$FOLDER.'large-'.$folq['fthumb'].'"  alt="'.$folq['name'].'" /></center>';
}else{
if($getfile['thumbext'] ==! ''){
echo '<img class="img-responsive" src="'.BASE_PATH_SCREEN.$FOLDER.'thumb-'.$getfile['dname'].'.'.$getfile['thumbext'].'"  alt="'.$getfile['dname'].'" /></center>';
}
}   
?>     
</div>
<div class="col-xs-8 padding-0">
<table class="table table-bordered">
<tbody>
<tr>
<td class="text-center" style="width: 30%">Movie</td>
<td style="width: 70%"><?=str_replace('_',' ',$folq['name'])?></td>
</tr>
<tr>
<td class="text-center" style="width: 30%">Song Name</td>
<td style="width: 70%"><?=substr(str_replace('_',' ',$getfile['name']),0,30);?><? if(strlen(str_replace('_',' ',$getfile['name'])) > 30) {echo'...';}?></td>
</tr>
<tr>
<td class="text-center" style="width: 30%">Singers</td>
<td style="width: 70%">
<?
echo $singer;
?>
</td>
</tr>
<tr>
<td class="text-center" style="width: 30%">Downloads</td>
<td style="width: 70%"><?=$getfile['view']?></td>
</tr> 
</tbody>
</table>
<audio controls>
<source src="<?=BASE_PATH?><?=$folq['folder']?><?=$getfile['dname']?>.<?=$getfile['ext']?>" type="audio/mpeg" />
</audio>
</div>
</div>
</div>
<?include '../files/advt/pc/all_page_middle.php';?>
<div class="dlinfo text-center">
<div class="row">
<?if($getfile['has_320']==!""){?>
<div class="btn-dl">
<i class="fa fa-download"></i> <a href="<?=BASE_PATH?>files/download/320kbps/id/<?=$getfile['id']?>/" rel="nofollow">&nbsp;&nbsp;&nbsp;Download in ~ 320Kbps (<?=getsize($getfile['has_320'])?>)</a>
</div>
<?}?>
<div class="btn-dl">
<i class="fa fa-download"></i> <a href="<?=BASE_PATH?>files/download/id/<?=$getfile['id']?>"/ rel="nofollow">&nbsp;&nbsp;&nbsp;Download in ~ 128Kbps (<?=getsize($getfile['size'])?>)</a>
</div>
<?if($getfile['has_64']==!""){?>
<div class="btn-dl">
<i class="fa fa-download"></i> <a href="<?=BASE_PATH?>files/download/64kbps/id/<?=$getfile['id']?>/" rel="nofollow">&nbsp;&nbsp;&nbsp;Download in ~ 64Kbps (<?=getsize($getfile['has_64'])?>)</a>
</div>
<?}?>
</div>
</div>
<?include '../files/advt/pc/download_after.php';?>
<?
if ($getfile['artist'] ==! '') { 
$singers = $getfile['artist'];
$list = explode(', ', $singers);
$songs = $db->query("select * from file as f where f.artist like '%" . $list[2] . "%' and id <> ".$getfile['id']." order by rand() LIMIT 8");
if(count($singers)==! 0){
echo '<h2 class="title-red">Related Mp3 Songs</h2>';
echo '<div class="list-group">';
foreach($songs as $field => $sing){	
?>
<a class="list-group-item padding-6" href="<?= BASE_PATH ?>download/<?=$sing['id']?>/<?=url_slug($sing['name']) ?>/">
<button type="button" class="btn btn-default btn-circle"><i class="glyphicon glyphicon-play"></i></button>&nbsp;&nbsp;&nbsp;
<?=str_replace('_',' ',$sing['name'])?>
</a>
<?}?>
</div>
<?}?>
<?}?>
<? include 'footer.tpl'; ?>        	