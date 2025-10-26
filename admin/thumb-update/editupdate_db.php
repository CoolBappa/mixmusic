<?php

include("../includes/admin-config.php");

$page = $_REQUEST['page'];
if ($page == ""){
$page =1;
}
$id = $_REQUEST['id'];
$thumb = $_REQUEST['thumb'];
$title = $_REQUEST['title'];
$link = $_REQUEST['link'];
$artist = $_REQUEST['artist'];
$cast = $_REQUEST['cast'];

$qryUpdate = "update `thumb_update` set
                            thumb = '$thumb',
                            title = '$title',
                            link = '$link',
                            artist = '$artist',
                            cast = '$cast'
                            where id = ".$id;

$db->query($qryUpdate);

header("location: index.php?errid=13&page=".$page."");
?>