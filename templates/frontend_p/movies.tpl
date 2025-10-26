<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
if($headset['showfeatured']=='1'){
echo '<h2 class="title-red">Latest Movie Songs</h2>';
echo '<div class="imgSlider">';
echo '<ul id="content-slider" class="content-slider alignCenter">'; 
$m = 1;
$catlist = $db->query('select * from `category` where topmenu = 1 and active=0 order by id desc LIMIT 15'); 	
foreach($catlist as $field => $catvalue){
if($catvalue['displayname']== ""){
$a = array('Videos' => '','Full' => '','(' => '',')' => '','_' => ' ',);
$cname = strtr($catvalue['name'],$a);
}else{
$cname = $catvalue['displayname'];
}
if($catvalue['fthumb'] ==! ''){
$thumb = BASE_PATH_SCREEN.$catvalue['folder'].'mid-'.$catvalue['fthumb'].'" alt="'.str_replace('_',' ',$catvalue['name']).'"';
}else{
$thumb = BASE_PATH.'css/images/no-thumb.png" alt="'.str_replace('_',' ',$CATEGORY[$i]['name']).'"';
} 
if ($CATEGORY[$i]['customlink']== ''){
echo '<li>';
echo '<a href="'.BASE_PATH.'cat/'.$catvalue['id'].'/'.url_slug($catvalue['name'].'-'.$catvalue['url_slug']).'/"><img class="sliderThumb img-responsive" src="'.$thumb.'></a>';
echo '</li>';
}else{
echo '<li>';
echo '<a href="'.$catvalue['customlink'].'"><img class="sliderThumb img-responsive" src="'.$thumb.'"></a>';
echo '<li>';
}	
}
?>	
</ul>
</div>
<div class="clear"></div>
<div class="marginbot-10"></div>
<?}?>