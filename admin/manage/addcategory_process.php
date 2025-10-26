<?php
	include("../includes/admin-config.php");
	
	if($_POST['pid'] != '')
	{
		$parentid = $_REQUEST['pid'];
				
		$chkdup = 'select id from category where name = "'.$_REQUEST['name'].'" and parentid = '.$_POST['pid'];
                $a = $db->query($chkdup,  database::GET_FIELD);
		if(count($a) > 0 )
		{
			if($parentid != 0)
				header("location: index.php?errid=5&pid=$parentid");
			else
				header("location: index.php?errid=5");
			exit;
		}
		
		if($_POST['pid'] != 0)
		{
			$qfol = 'select folder,clink from category where id = '.$parentid;
			$fo = $db->query($qfol,  database::GET_ROW);
                        $folderpath = $fo['folder'];
                        $clinkp = '/'.$fo['clink'];
		}
		else
		{
			$folderpath = 'files/uploads/';
		}

                //make folder here
                
	
		$thumbfullname = '';
		if($_FILES['thumb']['name'] != '')
		{
			$rand = rand(111111111111,999999999999);
			$thumbname =  $rand.'-'.$_REQUEST['name'];
			@getimagesize($_FILES['thumb']['tmp_name']) or error('only image uploads are allowed', $invalidurl);
			$thumbup = UploadImage('thumb',$invalidurl,$thumbname,'../../folder-icon/',0,'',0);
			createthumb('../../folder-icon/'.$thumbname.'.'.$thumbup[3],'../../folder-icon/'.$thumbname.'.'.$thumbup[3],$thumbup[3]);
			//unlink('../../'.$savefolder.$_REQUEST['name'].'.'.$thumbup[3]);
			$thumbext = $thumbup[3];
			$thumbfullname = $thumbname.'.'.$thumbext;
		}
		
		
		$newid =$db->query("INSERT INTO category (name,parentid,groupid,thumb,totalitem,newitemtag,updateitemtag,subcate,kram,active,topmenu,haszip)
			values('".mysql_real_escape_string($_REQUEST['name'])."','$parentid',0,'$thumbfullname',0,0,0,0,0,0,0,0)");
                $newid = $db->insert_id;
                
                if($newid < 1)
                    echo 'error';
                // new folder create
                
		$mkfolder = '../'.$folderpath.$newid;
		$folder = $folderpath.$newid.'/';

		if(!is_dir('../'.$mkfolder))
		{
			mkdir('../'.$mkfolder, 0777);
			chmod('../'.$mkfolder, 0777);
		}
		if(!is_dir('../'.$mkfolder))
		{
                    echo '<h2>Error to Createing Directory On '.$mkfolder.' <br /> Automatic Back in 5 seconds........</h2>';

                    if($parentid != 0)
                            header("refresh: 5; url=index.php?errid=3&pid=$parentid");
                    else
                            header("refresh: 5; url=index.php?errid=3");
                    exit;
		}

		$clink = str_replace('upload_file/','',$_REQUEST['name'].$clinkp);
		//$clink = substr($clink1,0,strlen(trim($clink1))-1);

                //$gets = "select sub from category where id = ".$parentid;
		//$getss = $conn->singleval($gets).','.$newid;

                // update subcate and folder structure
                $db->query("update category set folder = '$folder' , clink = '$clink' where id = ".$newid);
                if($parentid > 0)
                    $db->query("update category set subcate = 1 where id = ".$parentid);
		
		//update path
                // this path for use in admin
		$q = 'select path from category where id = '.$parentid;
                if($parentid > 0)
                    $path = $db->query($q,  database::GET_FIELD) . '&nbsp;&raquo;&nbsp;<a href="?pid='.$newid.'".html>'.$_REQUEST['name'].'</a>';
                else
                    $path = '&nbsp;&raquo;&nbsp;<a href="?pid='.$newid.'">'.$_REQUEST['name'].'</a>';
                
		$qc = 'select pathc from category where id = '.$parentid;
                if($parentid > 0)
                    $pathc = $db->query($qc,  database::GET_FIELD) . '&nbsp;&raquo;&nbsp;<a href="'.BASE_PATH.'cat/'.$newid.'/'.url_slug($_REQUEST['name']).'/">'.str_replace('_',' ',$_REQUEST['name']).'</a>';
                else
                    $pathc = '&nbsp;&raquo;&nbsp;<a href="'.BASE_PATH.'cat/'.$newid.'/'.url_slug($_REQUEST['name']).'/">'.str_replace('_',' ',$_REQUEST['name']).'</a>';

               //set kram on 14-4-11
                $customlink = $_REQUEST['customlink'];
                $title = mysql_real_escape_string($_REQUEST['title']);
                $artist = mysql_real_escape_string($_REQUEST['artname']);
                $star = mysql_real_escape_string($_REQUEST['strname']);
                $tag = mysql_real_escape_string($_REQUEST['tag']);
                $slug = mysql_real_escape_string($_REQUEST['slug']);
                $getnewid = $newid;
                $qrygetkram = $db->query("select count(id) from category where parentid = $parentid",  database::GET_FIELD);
                $qryupdatekram = $db->query("update category set kram = $qrygetkram where id = $getnewid");
                
        	$db->query("update category set path = '$path',pathc = '$pathc',title='$title',tag='$tag',url_slug = '$slug',customlink = '$customlink', artist = '$artist', starring = '$star' where id = ".$newid);
		
		if($parentid != 0)
			header("location: index.php?errid=3&pid=$parentid");
		else
			header("location: index.php?errid=3");

                
	}

               
	
?>