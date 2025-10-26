<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
$sort = $_GET['sort'];
if($sort == 'download')
$getfilelist = 'select * from file where cid = '.$parentid.' order by download desc';
elseif($sort == 'az')
$getfilelist = 'select * from file where cid = '.$parentid.' order by name';
elseif($sort == 'recent')
$getfilelist = 'select * from file where cid = '.$parentid.' order by id desc';
else
$getfilelist = 'select * from file where cid = '.$parentid.' order by kram desc';
$rowsPerPage=FILEPERPAGE_PC;
$pagingqry = $getfilelist;
if($sort == 'az')
$sorts = '/az';
if($sort == 'download')
$sorts = '/download';
if($sort == 'recent')
$sorts = '';
$pagelink = BASE_PATH.'cat'.$sorts.'/'.$parentid.'/';
$htmlpage = '/'.url_slug($folddetail['name']).'/';
include 'paging.tpl';
$getresult = "select * from category where id = ".$_GET['pid'];
$getcc = $db->query($getresult,  database::GET_ROW);
if(count($getcc)>0){
if(isset($_GET['page'])){
if($_GET['page'] > $maxPage or $_GET['page'] == '0'){
header('HTTP/1.1 404 Not Found');
header("Refresh:0; url=".BASE_PATH."404.php");
exit();
}
}
}else{
header('HTTP/1.1 404 Not Found');
header("Refresh:0; url=".BASE_PATH."404.php");
exit();
}
$FILE = $db->query($pagingqry.$limit);
$TOTAL_FILE=count($FILE);
$image_path = '../'.$folddetail['folder'].'mid-'.$folddetail['fthumb'];
echo '<h2 class="title-red">';
echo str_replace('_',' ',$folddetail['name']);
echo '</h2>';
if($folddetail['artist'] ==!''){
echo '<div class="fileinfo">';
echo '<div class="post-1 border-0">';
echo'<div class="post-thumb">';
if (file_exists($image_path)) {
echo '<img src="'.BASE_PATH_SCREEN.$image_path.'"  alt="'.str_replace('_',' ',$folddetail['name']).'" />';
}else{
echo '<img src="'.BASE_PATH_SCREEN.'css/images/no-thumb.png"  alt="'.str_replace('_',' ',$folddetail['name']).'" />';
}echo '</div>';
echo'<div class="post-data">';
echo '<h2>';
echo str_replace('_',' ',$folddetail['name']);
echo '</h2>';
if ($folddetail['starring'] ==! '') { 
echo '<p>';
echo '<div class="info">';
echo 'Cast : ';
$castlist = $folddetail['starring'];
$cast = array($castlist);
array_walk($cast , 'intval');
$idc = implode(',', $cast);
$sql = "SELECT * FROM singer_star WHERE id IN ($idc) order by id desc";
$getcast = $db->query($sql);
$casting = array();
foreach ($getcast as $key => $valc) {
$casting[$key] = '<a href="'.BASE_PATH.'songs/'.$valc['id'].'/'.url_slug($valc['name']).'/">'.$valc['name'].'</a>';
}$casting = implode(', ', $casting);
echo $casting;
echo '</div>';
echo '</p>';
} 
if ($folddetail['artist'] ==! '') {
echo '<p>'; 
echo '<div class="info">';
echo 'Singer : ';
$singerlist = $folddetail['artist'];
$sing = array($singerlist);
array_walk($sing , 'intval');
$ids = implode(',', $sing);
$sql = "SELECT * FROM singer_star WHERE id IN ($ids) order by id desc";
$gets = $db->query($sql);
$sing = array();
foreach ($gets as $key => $val) {
$sing[$key] = '<a href="'.BASE_PATH.'songs/'.$val['id'].'/'.url_slug($val['name']).'/">'.$val['name'].'</a>';
}$singer = implode(', ', $sing);
echo $singer;
echo '</div>';
echo '</p>';
}if($DES==!""){
echo '<p>';
echo $DES;
echo '</p>';
}echo '</div>';
echo '<div class="clear"></div>';
echo '</div>';
echo '</div>';
}?>
<?if($TOTAL_FILE > 0){?>
<h2 class="title-red">Download <?=str_replace('_',' ',$folddetail['name'])?> Mp3 Songs</h2>
<?}?>
<div class="panel panel-default">
<div class="panel-body">
<? include 'item.tpl'; ?>
</div>
</div>
<? include 'zip.item.tpl'; ?>