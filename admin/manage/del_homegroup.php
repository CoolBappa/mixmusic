<?php
include("../includes/admin-config.php");

$deletefile = 'delete from `homegroup` where id = ' . $_GET['id'];
$db->query($deletefile);


header("location: homegroup.php?errid=14");
?>