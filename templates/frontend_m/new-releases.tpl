<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
if($headset['showlatest']=='1'){
$u==1;
echo '<h2 class="title-red">New Releases <a href="/new-releases/1/"><span class="btn-more">More +</span></a></h2>';
echo '<div class="list-group">';
$latest = $db->query('select * from `thumb_update` order by kram desc LIMIT '.UPDATEHOME_MOB);
foreach($latest as $field => $latestupdate){
$u++;
?>
<a class ="list-group-item" href="<?=$latestupdate['link']?>">
<div class="post-1">
<div class="post-thumb">
<img class="round-thumb" src="<?=str_replace(basename($latestupdate['thumb']),'small-'.basename($latestupdate['thumb']).'',$latestupdate['thumb'])?>" alt="<?=$latestupdate['title']?>" />
</div>	
<div class="post-data">
<?=$latestupdate['title']?>

<? if($latestupdate['artist'] ==! ""){?>
<p><span class="artistbox"><?=$latestupdate['artist']?></span></p>
<? } ?>
</div>
<div class="clear"></div>
</div>
</a>
<? } ?>
</div>  
<? } ?>
