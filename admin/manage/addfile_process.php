<?php

include("../includes/admin-config.php");

if ($_POST['cid'] != '') {
    $cid = $_REQUEST['cid'];
    $fieldname = 'file';
    $invalidurl = ADMIN_BASE_PATH . 'manage/addfile.php?id=' . $cid;
    if ($_FILES[$fieldname]['name'] == '') {
        if ($_REQUEST['url'] == '')
            error('Please select file or enter url properly ', $invalidurl, 7);
    }

    

    if ($_FILES[$fieldname]['name'] != '') {
        $ext1 = explode('.', $_FILES[$fieldname]['name']);
        $ext = $ext1[count($ext1) - 1];
        if($_REQUEST['name']==''){
        $newname = cleanfilename($ext1[0]) . FILEADDNAME;
        }else{
        $newname= $_REQUEST['name']. FILEADDNAME;
        }

        if ($_REQUEST['name'] == '') {
            $name = $ext1[0];
        } else {
            $name = $_REQUEST['name'];
        }

        $fileSize = $_FILES[$fieldname]['size'];

        $q = 'select folder from category where id = ' . $cid;
        $savefolder = $db->query($q,  database::GET_FIELD);

        UploadFile($fieldname, $invalidurl, $newname, '../../' . $savefolder);
    } elseif ($_REQUEST['url'] != '') {
        $url = $_REQUEST['url'];

        $ext2 = explode('/', $url);
        $ext1 = explode('.', $ext2[count($ext2) - 1]);
        $ext = $ext1[count($ext1) - 1];

        if ($ext == '')
            error('Please select Url properly (with extention) ', $invalidurl, 7);

        //$newname = $rand.'-'.cleanfilename($ext1[0]).FILEADDNAME;

         if($_REQUEST['name']==''){
        $newname = cleanfilename($ext1[0]) . FILEADDNAME;
        }else{
        $newname= $_REQUEST['name']. FILEADDNAME;
        }

        if ($_REQUEST['name'] == '') {
            $name = cleanfilename($ext1[0]);
        } else {
            $name = $_REQUEST['name'];
        }

        $q = 'select folder from category where id = ' . $cid;
        $savefolder = $db->query($q,  database::GET_FIELD);

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

    if ($_FILES['thumb']['name'] != '') {
        @getimagesize($_FILES['thumb']['tmp_name']) or error('only image allowed...', $invalidurl);
        $thumbup = UploadImage('thumb', $invalidurl, $newname, '../../' . $savefolder, 0, '', 0);
        createthumb('../../' . $savefolder . $newname . '.' . $thumbup[3], '../../' . $savefolder . 'thumb-' . $newname . '.' . $thumbup[3], THUMBW, $thumbup[3]);
        unlink('../../' . $savefolder . $newname . '.' . $thumbup[3]);
        $thumbext = $thumbup[3];
    }

    if($_REQUEST['existingthumb'] == 1){
    $thumbext = 'jpg';
    }

    if($ext == '3gp' || $ext == 'mp4' || $ext == 'avi' || $ext == '3GP' || $ext == 'MP4' || $ext == 'AVI' )
    {

    $thumbext = 'jpg';
    $fname= '../../'.$savefolder.'thumb-'.$newname.'.jpg';
    $Filename= '../../'.$savefolder.$newname.'.'.$ext;
    $pic = htmlspecialchars($Filename);



    $mov = new ffmpeg_movie($pic, false);
    $wn = $mov->GetFrameWidth();
    $hn = $mov->GetFrameHeight();


    $frame = $mov->getFrame(350);
    $gd = $frame->toGDImage(350);


    $new = imageCreateTrueColor(120, 85);
    imageCopyResized( $new,$gd, 0, 0, 0, 0, 120, 85, $wn, $hn);
    imageJpeg($new,$fname,90);
    }

    $des = $_REQUEST['desc'];
    $newtag = $_REQUEST['newtag'];
    $artist = $_REQUEST['artistname'];

    $qryUpdate = "insert into file (name,dname,cid,ext,thumbext,size,`des`,newtag,imagetype,artist,created_at) VALUES ('$name','$newname',$cid,'$ext','$thumbext','$fileSize','$des','$newtag',0,'$artist',now())";
    $db->query($qryUpdate);
    //set kram on 14-4-11
    $getnewid = $db->insert_id;
    $qrygetkram = $db->query("select count(id) from file where cid = $cid",  database::GET_FIELD);
    $qryupdatekram = $db->query("update file set kram = $qrygetkram where id = $getnewid");
    /// over kram
    $qryUpdate = "update category set totalitem = totalitem + 1 where id in($cid)";
    $db->query($qryUpdate);

    
                      
    if(strtolower($ext)=='mp3')
    {
        //$Filename= '../../'.$savefolder.$newname.'.'.$ext;
        $sourcefile= '../../'.$savefolder.$newname.'.'.$ext;
        $qn = 'select name from category where id = '.$cid;
	$folderqn = $db->query($qn,  database::GET_ROW);
        $foldername = $folderqn['name'];
        include 'tag.php';
    }
    header("location: index.php?errid=1&pid=$cid&last=$name.$ext");

}
