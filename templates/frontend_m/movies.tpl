<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
if($headset['showfeatured']=='1'){
echo '<h2 class="title-red">Latest Movie Songs</h2>';
echo '<div class="list-group">';
$m = 1;
$catlist = $db->query('select * from `category` where topmenu = 1 and active=0 order by kram desc LIMIT 3'); 	
foreach($catlist as $field => $catvalue){
if($catvalue['displayname']== ""){
$a = array('Videos' => '','Full' => '','(' => '',')' => '','_' => ' ',);
$cname = strtr($catvalue['name'],$a);
}else{
$cname = $catvalue['displayname'];
}
if($catvalue['fthumb'] ==! ''){
$thumb = BASE_PATH_SCREEN.$catvalue['folder'].'small-'.$catvalue['fthumb'].'" alt="'.str_replace('_',' ',$catvalue['name']).'"';
}else{
$thumb = BASE_PATH.'css/images/no-thumb-small.jpg" class="round-thumb" alt="'.str_replace('_',' ',$CATEGORY[$i]['name']).'"';
} 
if ($CATEGORY[$i]['customlink']== ''){
echo '<a class="list-group-item" href=" '.BASE_PATH.'cat/'.$catvalue['id'].'/'.url_slug($catvalue['name'].'-'.$catvalue['url_slug']).'/">';
echo '<div class="post-1">';
echo '<div class="post-thumb">';
echo '<img class="round-thumb" src="'.$thumb.'>';
echo '</div>';
echo '<div class="post-data">';
echo str_replace('_', ' ',$catvalue['name']);
echo '</div>';
echo '<div class="clear"></div>';
echo '</div>';
echo '</a>';
}else{
echo '<a class="list-group-item" href="'.$catvalue['customlink'].'">';
echo '<div class="post-1">';
echo '<div class="post-thumb">';
echo '<img class="round-thumb" src="'.$thumb.'">';
echo '</div>';
echo '<div class="post-data">';
echo str_replace('_', ' ',$catvalue['name']);
echo '</div>';
echo '<div class="clear"></div>';
echo '</div>';
echo '</a>';
}	
}
?>	
</div>
<?}?>