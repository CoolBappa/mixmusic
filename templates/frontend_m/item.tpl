<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
include '../files/advt/mob/file_start.php';
echo '<div class="list-group">';
$file_tot = count($FILE);
$insertad = $file_tot / 2 - 1;
if($insertad == "1.5"){
$inad = '1';
}
elseif($insertad == "2.5"){
$inad = '2';
}
elseif($insertad == "3.5"){
$inad = 3;
}
elseif($insertad == "4.5"){
$inad = 4;
}else{
$inad = $insertad;
}
for ($i = 0; $i < $file_tot; $i++) 
{ 
if($l==1)
{
$l++;
$class='post-2';
}else{
$l=1;
$class='post-2';
}  
$folddetail = $db->query('select * from category where id =' .$FILE[$i]['cid'] , database::GET_ROW);  
?>
<a class="list-group-item" href="<?= BASE_PATH ?>download/<?= $FILE[$i]['id'] ?>/<?=url_slug($FILE[$i]['name']) ?>/">
<div class="post-1">
<div class="post-thumb">
<img src="<?= BASE_PATH ?>css/images/dir-music-l.png" alt="<?=$FILE[$i]['name']?>" />
</div>
<div class="post-data">
<?=str_replace('_',' ',$FILE[$i]['name']) ?>
<? if($FILE[$i]['artist'] ==! ""){
$singerlist = $FILE[$i]['artist'];
$sing = array($singerlist);
array_walk($sing , 'intval');
$ids = implode(',', $sing);
$sql = "SELECT * FROM singer_star WHERE id IN ($ids) order by id desc";
$gets = $db->query($sql);
$sing = array();
foreach ($gets as $key => $val) {
$sing[$key] = $val['name'];
}
$singer = implode(', ', $sing);
?>
<p><span class="artistbox"><?=$singer?></span></p>
<? } ?>
</div>
<div class="clear"></div>	
</div>
</a>
<?
if ( $i == $inad){
echo '<div class="list-group-item">';
include '../files/advt/mob/file_middle.php';
echo '</div>';
}
}
echo '</div>';
include '../files/advt/mob/file_end.php';
echo $PAGE_CODE;
?>