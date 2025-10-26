<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
$parentid = 1;
$def = latest;
$PATH = '<a href="'.BASE_PATH.'">Home</a> / All New Releases';
include 'header.tpl';
echo '<h2 class="title-red">All New Releases</h2>';
$rowsPerPage=UPDATEPERPAGE_PC;
$pagingqry = "select * from thumb_update order by kram desc";
$gets='?';
if($sort == 'az')
$sort = '/az';
if($sort == 'download')
$sort = '/download';
if($sort == 'recent')
$sort = '';
$pagelink = BASE_PATH.'new-releases/';
$htmlpage = '/';
include 'paging.tpl';
$CATEGORY = $db->query($pagingqry.$limit);
echo '<div class="itemContainer marginbot-10">';
echo '<div class="row">';
$l = 1;
$totcat = count($CATEGORY);
$insertadc = $totcat / 2 - 1;
if($insertadc == "1.5"){
$inadc = '1';
}
elseif($insertadc == "2.5"){
$inadc = '2';
}
elseif($insertadcc == "3.5"){
$inadc = 3;
}
elseif($insertadc == "4.5"){
$inadc = 4;
}else{
$inadc = $insertadc;
}
for($i = 0 ; $i < $totcat ; $i++){	
if($l==1){
$l++;
$class = 'catrow-2';
}else{
$l=1;
$class='catrow-1';
}
if($CATEGORY[$i]['displayname']== ''){   
$catname = $CATEGORY[$i]['name'] ;
}else{
$catname= $CATEGORY[$i]['displayname'];
}
?>
<div class="col-xs-6">
<div class="post-1">
<div class="post-thumb">
<a href="<?=$CATEGORY[$i]['link']?>">
<img class="update-thumb" src="<?=$CATEGORY[$i]['thumb']?>" alt="<?=str_replace('_',' ',$CATEGORY[$i]['name'])?>" />
</a>
</div>
<div class="post-data">
<a href="<?=$CATEGORY[$i]['link']?>">
<?=$CATEGORY[$i]['title']?>
<? if($CATEGORY[$i]['artist'] ==! ""){?>
<p><span class="artistbox"><?=$CATEGORY[$i]['artist']?></span></p>
<? } ?>
</a>
</div>
<div class="clear"></div>
</div>
</div>
<?}?>
</div>
</div>
<?=$PAGE_CODE;?>
<? include 'footer.tpl'; ?>
