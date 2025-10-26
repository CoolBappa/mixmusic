<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
$sort=$_GET['sort'];
if($parentid==! 0){
$rowsPerPage=CATPERPAGE;
}else{
$rowsPerPage=30;
}
if($sort == 'az'){
$pagingqry = "select * from category where parentid = ".$parentid. ' and active=0 order by name asc';
$pagelink = BASE_PATH.'cat/az/'.$parentid.'/';
}
elseif($sort == ''){
$pagingqry = "select * from category where parentid = ".$parentid. ' and active=0 order by kram desc';
$pagelink = BASE_PATH.'cat/'.$parentid.'/';
}
else{
$pagingqry = "select * from category where parentid = ".$parentid. ' and active=0 order by kram desc';
$pagelink = BASE_PATH.'cat/'.$parentid.'/';
}
include 'paging.tpl';
$CATEGORY = $db->query($pagingqry.$limit);
$htmlpage = '/'.url_slug($folddetail['name']).'.html';
//####### Directory Listing ########
echo '<h2 class="title-dark">Music Categories</h2>';
echo '<div class="list-group">';
$l = 1;
$totcat = count($CATEGORY);
for($i = 0 ; $i < $totcat ; $i++){
if($CATEGORY[$i]['displayname']== ''){   
$catname = $CATEGORY[$i]['name'] ;
}else{
$catname= $CATEGORY[$i]['displayname'];
} 
if($CATEGORY[$i]['customlink']== ''){
echo '<a class="list-group-item" href="'.BASE_PATH.'cat/'.$CATEGORY[$i]['id'].'/'.url_slug($CATEGORY[$i]['name'].'-'.$CATEGORY[$i]['url_slug']).'/">';
}else{
echo '<a class="list-group-item" href="'.$CATEGORY[$i]['customlink'].'">';
}
echo '<div class="post-1">';
echo '<div class="post-thumb">';
echo '<img src="'.BASE_PATH.'css/images/dir-music.png" alt="'.str_replace('_',' ',$catname).'" /> ';
echo '</div>';
echo '<div class="post-data">';
echo str_replace('_',' ',$catname);
echo '</div>';
echo '<div class="clear"></div>';
echo '</div>';
echo '</a>';
}
echo '</div>';
?>        	