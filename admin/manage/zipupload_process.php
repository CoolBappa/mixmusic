<?php
	include("../includes/admin-config.php");
	
	$pid = $_POST['pid'];

	if($pid != '')
	{
		//print_r($_REQUEST);

		//dir_list.php
		$default_dir = "../../files/bulk_upload/"; 
		
		// lists files only for the directory which this script is run from
		$listfile = array();
		$i = 0;
		if(!($dp = opendir($default_dir))) die("Cannot open $default_dir.");
		while(false !== ($file = readdir($dp))) 
		{
			if(!is_dir($file)) 
			{
				if($file != '.' && $file != '..') 
				{
					$listfile[$i]['filename'] =  $file;
					$i++;
				}
			}
		}
		closedir($dp);
		
		$invalidurl = ADMIN_BASE_PATH.'category/zipupload.php?id='.$pid;

		$q = 'select folder from category where id = '.$pid;
		$savefolder = $db->query($q,  database::GET_FIELD);

               
		
		include("../../inc/watermark_text.class.php");
		
		foreach($listfile as $k => $v)
		{
			$oldcurrentfilename = $listfile[$k]['filename'];
			$currentfilename = str_replace(' ','_',$listfile[$k]['filename']);
			
			rename('../../files/bulk_upload/'.$listfile[$k]['filename'],'../../files/bulk_upload/'.$currentfilename);
			
			if($_POST['existthumb'] == 1)
                        {$thumbext = 'jpg';}

			$ext1 = explode('.',$currentfilename);
			$ext = $ext1[count($ext1)-1];
			
			if(strlen($ext) == 3)
				$newname = substr($currentfilename,0,strlen($currentfilename)-4);	
			elseif(strlen($ext) == 4)
				$newname = substr($currentfilename,0,strlen($currentfilename)-5);	
			//$actu = $newname;
			//$newname = $rand.'-'.cleanfilename($ext1[0]).FILEADDNAME;
			$oldcurrentfilename = $newname.FILEADDNAME.'.'.$ext;
                        $oldcurrentfilenamev = $newname.FILEADDNAME.'.jpg';
			
			$name = $newname;
			$newname = cleanfilename($newname);
			//$newname = $currentfilename;
			//$name = cleanfilename($ext1[0]);
			
			$url = BASE_PATH.'files/bulk_upload/'.$currentfilename;
			$rurl = '../../files/bulk_upload/'.$currentfilename;
			// create a new CURL resource
			$ch = curl_init();

			// set URL and other appropriate options
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);

			set_time_limit(9000); # 15 minutes for PHP
			curl_setopt($ch, CURLOPT_TIMEOUT, 9000) or error('time limit exceed... Contact to Developer... ',$invalidurl); # and also for CURL
			
			$outfile = fopen('../../'.$savefolder.$newname.'.'.$ext, 'wb');
			curl_setopt($ch, CURLOPT_FILE, $outfile) or error('can not write destination file',$invalidurl);
			
			// grab file from URL
			curl_exec($ch) or error(' Error in copy source file.. ', $invalidurl,7);
			
			$info = curl_getinfo($ch);
			fclose($outfile);
			$fileSize = $info['size_download'];	

			//copy($url,'../../'.$savefolder.$newname.'.'.$ext);

			//if($_POST['thumb'] == 1)
			//{
				//@getimagesize($url) or error('only image uploads are allowed', $invalidurl);
				//createthumb('../../'.$savefolder.$newname.'.'.$ext,'../../'.$savefolder.'thumb-'.$newname.'.'.$ext,THUMBW,$ext);
				//$thumbext = $ext;
				//$imgtype = 1;
			//}
			//else
			//{
				//$imgtype = 0;
			//}

                        
                        

   

			$qryUpdate = "insert into zip_files (name,cid,size) 
				VALUES ('$name','$pid','$fileSize')";
			$db->query($qryUpdate);
	               
                        $getnewid = $db->insert_id;
                        $qrygetkram = $db->query("select count(id) from zip_files where cid = $pid",  database::GET_FIELD);
                        $qryupdatekram = $db->query("update zip_files set kram = $qrygetkram where id = $getnewid");
                        /// over kram
			$qryUpdate = "update category set haszip = haszip + 1 where id in($pid)";
			$db->query($qryUpdate);
			
			//unlink($default_dir.$currentfilename);
		
		}
	}

                 
	
	header("location: index.php?pid=$pid&errid=1");
?>



