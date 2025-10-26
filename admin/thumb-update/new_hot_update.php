<?
include("../includes/admin-config.php");

$page = $_REQUEST['page'];
if ($page == ""){
$page =1;
}
$id = $_GET['id'];
$type = $_GET['type'];
$action = $_GET['action'];

if($action=="on" && $type =="new"){

$qryUpdate = "update `thumb_update` set
                            newitemtag = '1'
                            where id = ".$id;

$db->query($qryUpdate);
}
elseif($action=="off" && $type =="new"){

$qryUpdate = "update `thumb_update` set
                            newitemtag = '0'
                            where id = ".$id;

$db->query($qryUpdate);
}

if($action=="on" && $type =="hot"){

$qryUpdate = "update `thumb_update` set
                            hotitemtag = '1'
                            where id = ".$id;

$db->query($qryUpdate);
}
elseif($action=="off" && $type =="hot"){

$qryUpdate = "update `thumb_update` set
                            hotitemtag = '0'
                            where id = ".$id;

$db->query($qryUpdate);
}

header("location: index.php?errid=13&page=".$page."");