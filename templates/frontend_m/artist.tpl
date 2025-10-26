<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
if ($folddetail['artist'] ==! '') { 
$cast = $folddetail['artist'];
$list = explode(', ', $cast);
$casting = $db->query("select * from category as c where c.artist like '%" . $list[0] . "%' and id <> ".$parentid." and active=0 order by rand() LIMIT 8");
if(count($casting)==! 0){
echo '<h2 class="title-dark">You might also like</h2>';
echo '<div class="row">';
foreach($casting as $field => $castingvalue){
if($castingvalue['displayname']== ""){
$name = $castingvalue['name'];
}else{
$name = $castingvalue['displayname'];
}
?>
<div class="col-xs-3 bgGray"> 
<div class="items">
<div class="items-thumb">
<a href="<?= BASE_PATH ?>cat/<?=$castingvalue['id'] ?>/<?=url_slug($castingvalue['name']) ?>/">
<? if($castingvalue['fthumb']==!""){?>
<img class="thumbnail img-responsive" src="<?=BASE_PATH_SCREEN?><?=$castingvalue['folder']?><?=$castingvalue['fthumb']?>" alt="<?=str_replace('_',' ',$castingvalue['name'])?>" />
<?}else{?>
<img class="thumbnail img-responsive" src="<?=BASE_PATH?>css/images/no-thumb.png" alt="<?=str_replace('_',' ',$castingvalue['name'])?>" />
<?}?>
</a>
</div>
<div class="items-data">
<a href="<?= BASE_PATH ?>cat/<?=$castingvalue['id'] ?>/<?=url_slug($castingvalue['name']) ?>/">
<?=str_replace('_',' ',$name)?>
</a>
</div>
</div>
</div>
<? }
echo '</div>';
}
}
?>