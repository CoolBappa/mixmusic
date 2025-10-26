<?php 
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
echo '<div class="marginbot-10"></div>';
echo '<div class="row">';
$gp =$db->query('select * from `homegroup` order by id asc');
foreach($gp as $field => $gplist){
$getC = 'select * from category where groupid = '.$gplist['id'];
$getCatlist = $db->query($getC,  database::GET_ROW);
?>
<div class="col-xs-6">
<h2 class="title-dark"><span class="pull-left"><?=$gplist['name']?></span> <?if(count($getCatlist)>0){?><a href="<?=BASE_PATH?>cat/<?=$getCatlist['id']?>/<?=url_slug($getCatlist['name'])?>/"><span class="pull-right btn-more">View All</span></a><?}?><div class="clear"></div></h2>  
<?
if(count($getCatlist)>0){
$group_list =$db->query('select * from `category` where parentid='.$getCatlist['id'].' and active=0 order by kram desc LIMIT 5'); 
echo '<div class="list-group">';
foreach($group_list as $field => $group_value){ 
if($group_value['displayname']== ''){   
$caname = $group_value['name'];
}else{
$caname= $group_value['displayname'];
}
if($group_value['customlink']== ''){
echo '<a class="list-group-item pading-6" href="'.BASE_PATH.'cat/'.$group_value['id'].'/'.url_slug($group_value['name']).'/">';
}else{
echo '<a class="list-group-item pading-6" href="'.$group_value['customlink'].'">';
} 
echo '<i class="glyphicon glyphicon-volume-down"></i>&nbsp;&nbsp;&nbsp;';
echo str_replace('_',' ',$caname);
echo '</a>';
}
echo '</div>';
}
?>
</div>
<? } ?>
</div>
