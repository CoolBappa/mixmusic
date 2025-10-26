<?php

include("../includes/admin-config.php");
$id = $_GET['id']; 
$pid = $_GET['pid']; 
$page = $_GET['page'];
if ($_GET['action'] == 'on')
    $update = 'update `category` set topmenu = 1 where id = ' . $id;
elseif ($_GET['action'] == 'off')
    $update = 'update `category` set topmenu = 0 where id = ' . $id;
$db->query($update);

if ($page != 0)
    header("location: index.php?errid=15&pid=$pid&page=$page");
else
    header("location: index.php?errid=15&pid=$pid");
?>