<?php

include("../includes/admin-config.php");

$thumb = mysql_real_escape_string($_POST['thumb']);
$title = mysql_real_escape_string($_POST['title']);
$link =mysql_real_escape_string($_POST['link']);
$artist = mysql_real_escape_string($_POST['artist']);
$cast = mysql_real_escape_string($_POST['cast']);


$db->query("INSERT INTO thumb_update (thumb,title,link,artist,cast,kram,date,newitemtag,hotitemtag) values('$thumb','$title','$link','$artist','$cast',1,now(),0,0)");

$getnewid = $db->insert_id;

$result = mysql_query("SELECT COUNT(*) AS total FROM `thumb_update`") or die(mysql_error());
$row = mysql_fetch_array($result);
$total = $row['total'];

$db->query("update `thumb_update` set kram = $total where id = $getnewid");


header("location: index.php?errid=13");

?>
