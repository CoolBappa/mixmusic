<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
if($headset['showlatest']=='1'){
$u==1;
echo '<h2 class="title-red"><span class="pull-left">New Releases</span> <a href="/new-releases/1/"><span class="pull-right btn-more">More +</span></a><div class="clear"></div></h2>';
echo '<div class="itemContainer">';
echo '<div class="row">';
$latest = $db->query('select * from `thumb_update` order by kram desc LIMIT '.UPDATEHOME_PC);
foreach($latest as $field => $latestupdate){
$u++;
?>
<div class="col-xs-6">
<div class="post-1<?=$nobr?>">
<div class="post-thumb">
<a href="<?=$latestupdate['link']?>">
<img class="update-thumb" src="<?=$latestupdate['thumb']?>" alt="<?=$latestupdate['title']?>" />
</a>
<?
if($group1value['newitemtag'] == 1)
echo '<img class="newtag" src="'.BASE_PATH.'images/new-cs.png" alt="new" />';
if($group1value['hotitemtag'] == 1)
echo '<img class="hottag" src="'.BASE_PATH.'images/hot-cn.png" alt="hot" />';
?>
</div>	
<div class="post-data">
<a href="<?=$latestupdate['link']?>"> 
<?=$latestupdate['title']?>
</a>
<? if($latestupdate['artist'] ==! ""){?>
<p><span class="artistbox"><?=$latestupdate['artist']?></span></p>
<? } ?>
</div>
<div class="clear"></div>
</div>
</div>
<? } ?>
</div>  
</div>
<? } ?>
