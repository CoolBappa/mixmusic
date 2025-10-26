<?php
include("../includes/admin-config.php");
$id = $_GET['id']; 
$cid = $_GET['cid']; 
$page = $_GET['page']; 
$c ='select * from category where id = '.$cid;
$ct = $db->query($c,  database::GET_ROW);
$up = 'select * from file where id = '.$id;
$thupdate = $db->query($up,  database::GET_ROW);
$thumb = BASE_PATH.$ct['folder'].$ct['fthumb'];
$title = str_replace('_',' ',$thupdate['name']).' - '.str_replace('_',' ',$ct['name']);
$link = ''.BASE_PATH.'download/'.$thupdate['id'].'/'.url_slug($thupdate['name']).'/';
$singerlist = $thupdate['artist'];
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
$castlist = $ct['starring'];
$cast = array($castlist);
array_walk($cast , 'intval');
$idc = implode(',', $cast);
$sql = "SELECT * FROM singer_star WHERE id IN ($idc) order by id desc";
$getcast = $db->query($sql);
$casting = array();
foreach ($getcast as $key => $valc) {
$casting[$key] = $valc['name'];
}
$casting = implode(', ', $casting);

if ($_GET['action'] == 'on'){

$db->query("insert into `thumb_update` (thumb,title,link,artist,cast,date) values('$thumb','$title','$link','$singer','$casting',now())");

$getnewid = $db->insert_id;

$result = mysql_query("SELECT COUNT(*) AS total FROM `thumb_update`") or die(mysql_error());
$row = mysql_fetch_array($result);
$total = $row['total'];

$db->query("update `thumb_update` set kram = $total where id = $getnewid");

}

if ($page != 0)
    header("location: index.php?errid=15&pid=$cid&page=$page");
else
    header("location: index.php?errid=15&pid=$cid");

?>