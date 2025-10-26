<?php
	include("../includes/admin-config.php");
	
	if($_GET['id'] != '' && $_GET['cid'] != '')
	{
		$cid = $_GET['cid'];
		$id = $_GET['id'];
		
		$q = 'select * from zip_files where id = '.$id;
		$qt = $db->query($q,  database::GET_ROW);
		$ext ='zip';
		$qfp = 'select folder from category where id = '.$cid;
		$folderpath = '../../'.$db->query($qfp,  database::GET_FIELD);
		
		unlink($folderpath.$qt['dname'].'.'.$ext);
		//unlink($folderpath.'thumb-'.$qt['dname'].'.'.$qt['thumbext']);
		
		$deletefile = 'delete from zip_files where id = '.$id;
		$db->query($deletefile);
					
		$updatesubcat = 'update category set haszip = haszip - 1 where id = '.$cid;
		$db->query($updatesubcat);
		if($_GET['ref'] == 'search'){
                header("Location: " . $_SERVER['HTTP_REFERER']."&errid=9");
                 }else{
		if($cid != 0)
			header("location: index.php?errid=9&pid=$cid");
		else
			header("location: index.php?errid=9");
                }
	}
	
?>