<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
if($headset['showtop']=='1'){
$wh = ' where category.id = file.cid order by file.weekly_dl desc LIMIT 10';
$top = 'select file.id,file.name,file.dname,file.ext,file.cid,file.thumbext,file.size,file.weekly_dl,file.view,file.newtag,file.artist,category.folder,category.thumb from `file` , category '.$wh;
$FILE = $db->query($top);
?>
<h2 class="title-dark">Weekly Top Songs</h2>
<div class="list-group">
<?
foreach($FILE as $field => $topfile){
echo '<a class="list-group-item padding-6" href="'.BASE_PATH.'download/'.$topfile['id'].'/'.url_slug($topfile["name"]).'/">';
echo '<button type="button" class="btn btn-default btn-circle"><i class="glyphicon glyphicon-play"></i></button>&nbsp;&nbsp;&nbsp;';
echo str_replace('_',' ',$topfile['name']);
echo '</a>';
}
?>
</div>
<?}?>
