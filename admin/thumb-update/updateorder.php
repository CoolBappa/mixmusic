<?php
	include("../includes/admin-config.php");

	$kram = $_POST['kram'];
	

        if($_REQUEST['uid'] != '')
		$qryUpdate = "update `thumb_update` set kram = $kram where id =".$_REQUEST['uid'];
	
	$db->query($qryUpdate);
	
	if($_REQUEST['page'] == '')
            header('location: index.php');
        else
            header('location: index.php?page='.$_REQUEST['page']);

?>