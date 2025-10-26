<?php
	include("../includes/admin-config.php");

	$groupid = $_POST['group'];
	
	if($_REQUEST['id'] != '')
	$qryUpdate = "update category set groupid = $groupid where id =".$_REQUEST['id'];
	
	
	$db->query($qryUpdate);
	
	if($_REQUEST['page'] == '')
            header('location: index.php?pid='.$_REQUEST['pid'].'&errid=19');
        else
            header('location: index.php?pid='.$_REQUEST['pid'].'&page='.$_REQUEST['page']);

?>