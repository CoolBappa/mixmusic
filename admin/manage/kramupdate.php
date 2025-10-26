<?php
	include("../includes/admin-config.php");

	$kram = $_POST['kram'];
	
	if($_REQUEST['id'] != '')
		$qryUpdate = "update category set kram = $kram where id =".$_REQUEST['id'];
	elseif($_REQUEST['fid'] != '')
		$qryUpdate = "update file set kram = $kram where id =".$_REQUEST['fid'];
        elseif($_REQUEST['uid'] != '')
		$qryUpdate = "update `update` set kram = $kram where id =".$_REQUEST['uid'];
        elseif($_REQUEST['zid'] != '')
		$qryUpdate = "update `zip_files` set kram = $kram where id =".$_REQUEST['zid'];
        elseif($_REQUEST['sid'] != '')
		$qryUpdate = "update `singer_star` set kram = $kram where id =".$_REQUEST['sid'];
	
	$db->query($qryUpdate);
	if($_REQUEST['sid'] ==! ''){
         if($_REQUEST['page'] == ''){
         header('location: add_singercast.php?errid=15');
         }else{
         header('location: add_singercast.php?errid=15&page='.$_REQUEST['page']);
         }
        }else{
	if($_REQUEST['page'] == '')
            header('location: index.php?pid='.$_REQUEST['pid']); 
        else
            header('location: index.php?pid='.$_REQUEST['pid'].'&page='.$_REQUEST['page']);
        }

?>