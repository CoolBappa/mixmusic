<?php

include("../includes/admin-config.php");

$name = $_POST['name'];


$db->query("insert into `homegroup` (name) values('$name')");

$getnewid = $db->insert_id;

header("location: homegroup.php?errid=13");
?>

