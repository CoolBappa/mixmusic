<?php
include("../includes/admin-config.php");

$page = $_GET['page'];

$deletefile = 'delete from `thumb_update` where id = ' . $_REQUEST['id'];
$db->query($deletefile);

if ($page != 0)
    header("location: index.php?errid=14&page=$page");
else
    header("location: index.php?errid=14");
?>