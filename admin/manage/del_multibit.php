<?php
	include("../includes/admin-config.php");
	
	
		$cid = $_GET['cid'];
		$id = $_GET['id'];
		$q = 'select * from file where id = '.$id;
		$qt = $db->query($q,  database::GET_ROW);
		$ext ='mp3';
		$qfp = 'select folder from category where id = '.$cid;
		$fol = $db->query($qfp,  database::GET_FIELD);



                
                if ($_GET['action'] == '64'){

		$newname= $qt['name'].'-64Kbps'. FILEADDNAME;
                $folderpath = '../../'.$fol.'64KBPS/';
		unlink($folderpath.$newname.'.'.$ext);
		
		$updatefile = 'update file set has_64 = "" where id = '.$id;
                $db->query($updatefile);
               
                }
                elseif ($_GET['action'] == '320'){
                
                $newname= $qt['name'].'-320Kbps'. FILEADDNAME;
                $folderpath = '../../'.$fol.'320KBPS/';
		unlink($folderpath.$newname.'.'.$ext);
		
		$updatefile = 'update file set has_320 = "" where id = '.$id;

                $db->query($updatefile);
               
                }


		



		if($_GET['ref'] == 'search'){
                header("Location: " . $_SERVER['HTTP_REFERER']."&errid=9");
                 }else{
		if($cid != 0)
			header("location: index.php?errid=9&pid=$cid");
		else
			header("location: index.php?errid=9");
                }
	
	

?>