<?php

include("../includes/admin-config.php");

    $fieldname = 'file';
    $cid = $_REQUEST['cid'];
    $id = $_REQUEST['id'];
    $page = $_REQUEST['page'];
    $invalidurl = ADMIN_BASE_PATH . 'manage/add_multibitmp3?id=' . $cid;

     if($_REQUEST['320kbps'] == 1 || $_REQUEST['64kbps'] == 1){   
        
        $fileSize = $_FILES[$fieldname]['size'];

        $q = 'select folder from category where id = ' . $cid;
        $destfolder = $db->query($q,  database::GET_FIELD);

        $f = 'select * from file where id = ' . $id;
        $getname = $db->query($f,  database::GET_ROW);

        $singerlist = $getname['artist'];
        $sing = array($singerlist);
        array_walk($sing , 'intval');
        $ids = implode(',', $sing);
        $sql = "SELECT * FROM singer_star WHERE id IN ($ids) order by id desc";
        $gets = $db->query($sql);
        $sing = array();
        foreach ($gets as $key => $val) {
        $sing[$key] = $val['name'];
        }
        $singer = implode(', ', $sing);

        if($_REQUEST['320kbps'] == 1){
          $newname= $getname['name'].'-320Kbps'. FILEADDNAME;
          $tagname= $getname['name'].' - 320Kbps';
          $savefolder = $destfolder.'320KBPS/';
          $mkfolder = '../../'.$savefolder;
          if(!is_dir($mkfolder))
		{
			mkdir($mkfolder, 0777);
			chmod($mkfolder, 0777);
		}
        }
        elseif($_REQUEST['64kbps'] == 1){
          $newname= $getname['name'].'-64Kbps'. FILEADDNAME;
          $tagname= $getname['name'].' - 64Kbps';
          $savefolder = $destfolder.'64KBPS/';
          $mkfolder = '../../'.$savefolder;
          if(!is_dir($mkfolder))
		{
			mkdir($mkfolder, 0777);
			chmod($mkfolder, 0777);
		}
        }
        

        if ($_FILES[$fieldname]['name'] != '') {

       

        UploadFile($fieldname, $invalidurl, $newname, '../../' . $savefolder);


        } elseif ($_REQUEST['url'] != '') {
        $url = $_REQUEST['url'];

        $ext2 = explode('/', $url);
        $ext1 = explode('.', $ext2[count($ext2) - 1]);
        $ext = $ext1[count($ext1) - 1];

        if ($ext == '')
            error('Please select Url properly (with extention) ', $invalidurl, 7);
        
       

        //if($_REQUEST['name']==''){
        //$newname = cleanfilename($ext1[0]) . FILEADDNAME;
        //}else{
        //$newname= $_REQUEST['name']. FILEADDNAME;
        //}

        //if ($_REQUEST['name'] == '') {
            //$name = cleanfilename($ext1[0]);
        //} else {
            //$name = $_REQUEST['name'];
        //}

        //$q = 'select folder from category where id = ' . $cid;
        //$savefolder = $db->query($q,  database::GET_FIELD);

        // create a new CURL resource
        $ch = curl_init();

        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);

        set_time_limit(3000); # 5 minutes for PHP
        curl_setopt($ch, CURLOPT_TIMEOUT, 3000) or error('time limit exceed...', $invalidurl); # and also for CURL

        $outfile = fopen('../../' . $savefolder . $newname . '.' . $ext, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $outfile) or error('can not write destination file', $invalidurl);

        // grab file from URL
        curl_exec($ch) or error(' Error in copy source file.. ', $invalidurl, 7);

        $info = curl_getinfo($ch);
        fclose($outfile);
        $fileSize = $info['size_download'];
        }

    
    //$des = $_REQUEST['desc'];
    //$newtag = $_REQUEST['newtag'];
    //$artist = $_REQUEST['artistname'];

    
    if($_REQUEST['320kbps'] == 1){
          $db->query("update file set has_320 = $fileSize where id = $id");
        }
        elseif($_REQUEST['64kbps'] == 1){
          $db->query("update file set has_64 = $fileSize where id = $id");
        }

    

    
                      
    if(strtolower($ext)=='mp3')
    {
        //$Filename= '../../'.$savefolder.$newname.'.'.$ext;
        $sourcefile= '../../'.$savefolder.$newname.'.'.$ext;
        $qn = 'select name from category where id = '.$cid;
	$folderqn = $db->query($qn,  database::GET_ROW);
        $foldername = $folderqn['name'];
        include 'tag2.php';
    }

    header("location: index.php?errid=1&pid=$cid&page=$page");
}else{
header("location: index.php?errid=0&pid=$cid&page=$page");
}


