<?php

include("../includes/admin-config.php");

$name = $_POST['name'];
$id = $_POST['id'];


$qryUpdate = "update homegroup set name='$name' where id=".$id;

$db->query($qryUpdate);

header("location: homegroup.php?errid=13");
?>
