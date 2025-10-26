<?php

// for read directory
include("includes/admin-config.php");

$total_file_insert = 0;
$total_exist_thumb_move = 0;
$total_make_thumb = 0;
$total_skiped_file = 0;
$total_maked_dir = 0;
$total_exist_dir = 0;

$folder_scan = '../bulk_dir_upload';
$folder_scan_file = get_files($folder_scan, true);

$folder_lev = '../';
include($folder_lev . "inc/watermark_text.class.php");
foreach ($folder_scan_file as $key => $val) {
    $parentid = 0;

    $flink = str_replace($folder_scan . '/', '', $val);
    $fpart = explode('/', $flink);

    $folder_level = count($fpart) - 1;
    // now check all sub folder
    for ($i = 0; $i < $folder_level; $i++) {
        $thumbext = '';
        if ($parentid <= 0 || $parentid == '')
            $where = ' and parentid = 0';
        else
            $where = ' and parentid = ' . $parentid;

        $chk_f = $db->query('select id from category where name ="' . $fpart[$i] . '" ' . $where, database::GET_FIELD);

        if (is_array($chk_f)) {
            if ($parentid != 0) {
                $qfol = 'select folder,clink from category where id = ' . $parentid;
                $fo = $db->query($qfol, database::GET_ROW);
                $folderpath = $fo['folder'];
                $clinkp = $fo['clink'] . '/';
            } else {
                $folderpath = 'upload_file/';
            }
            $newid = $db->query("insert into category (name,parentid)
                    values('" . $fpart[$i] . "','$parentid')");
            $newid = $db->insert_id;

            if ($newid < 1)
                echo 'error';
            // new folder create
            $mkfolder = $folder_lev . $folderpath . $newid;
            $folder = $folderpath . $newid . '/';
            if (!is_dir($folder_lev . $mkfolder)) {
                mkdir($mkfolder, 0777);
                chmod($mkfolder, 0777);
            }
            if (!is_dir($mkfolder)) {
                echo '<h2>Error to Createing Directory On ' . $mkfolder . ' <br /> Automatic Back in 5 seconds........</h2>';

                if ($parentid != 0)
                    header("refresh: 5; url=index.php?errid=3&pid=$parentid");
                else
                    header("refresh: 5; url=index.php?errid=3");
                exit;
            }

            $clink = str_replace('upload_file/', '', $clinkp . $fpart[$i]);

            // update subcate and folder structure
            $db->query("update category set folder = '$folder' , clink = '$clink' where id = " . $newid);

            if ($parentid > 0)
                $db->query("update category set subcate = 1 where id = " . $parentid);

            //update path
            // this path for use in admin
            $q = 'select path from category where id = ' . $parentid;
            if ($parentid > 0)
                $path = $db->query($q, database::GET_FIELD) . '&nbsp;&raquo;&nbsp;<a href="?pid=' . $newid . '">' . $fpart[$i] . '</a>';
            else
                $path = '&nbsp;&raquo;&nbsp;<a href="?pid=' . $newid . '">' . $fpart[$i] . '</a>';

            $qc = 'select pathc from category where id = ' . $parentid;
            if ($parentid > 0)
                $pathc = $db->query($qc, database::GET_FIELD) . '&nbsp;&raquo;&nbsp;<a href="' . BASE_PATH . 'cat/' . $newid . '/'.str_replace($replace,'_',$fpart[$i]).'.html">' .str_replace('_',' ', $fpart[$i]) . '</a>';
            else
                $pathc = '&nbsp;&raquo;&nbsp;<a href="' . BASE_PATH . 'cat/' . $newid . '/'.str_replace($replace,'_',$fpart[$i]).'.html">' . str_replace('_',' ',$fpart[$i] ). '</a>';

            $db->query("update category set path = '$path',pathc = '$pathc' where id = " . $newid);

            $parentid = $newid;

            $total_maked_dir++;
        }
        else {
            $parentid = $db->query('select id from category where name ="' . $fpart[$i] . '" ' . $where, database::GET_FIELD);
        }
    }


    // now insert file to folder
    // get extantion

    $l_filename = $fpart[$folder_level];
    $chknamethumb = substr($l_filename, 0, 6);

   
    if ($chknamethumb != 'thumb-') {
        $total_file_insert++;
        $Filename = $l_filename;
        
        $folder = $db->query('select folder from category where id ="' . $parentid . '"', database::GET_FIELD);

        $val_path = substr($val, 0, (strlen($val) - strlen($Filename)));

        
        $ext1 = explode('.', $Filename);
        $ext = $ext1[count($ext1) - 1];

        if (strlen($ext) == 3)
            $newname = substr($Filename, 0, strlen($Filename) - 4);
        elseif (strlen($ext) == 4)
            $newname = substr($Filename, 0, strlen($Filename) - 5);

        //file name without extantion
        $l_filename_without_ext = substr($l_filename, 0, strlen($l_filename) - (strlen($ext) + 1));
        if (file_exists($val_path . 'thumb-' . $l_filename_without_ext . '.jpg'))
            $thumbext = 'jpg';
        elseif (file_exists($val_path . 'thumb-' . $l_filename_without_ext . '.gif'))
            $thumbext = 'gif';
        elseif (file_exists($val_path . 'thumb-' . $l_filename_without_ext . '.png'))
            $thumbext = 'png';
        elseif (file_exists($val_path . 'thumb-' . $l_filename_without_ext . '.jpeg'))
            $thumbext = 'jpeg';
        elseif (file_exists($val_path . 'thumb-' . $l_filename_without_ext . '.JPG'))
            $thumbext = 'JPG';
        elseif (file_exists($val_path . 'thumb-' . $l_filename_without_ext . '.GIF'))
            $thumbext = 'GIF';
        elseif (file_exists($val_path . 'thumb-' . $l_filename_without_ext . '.PNG'))
            $thumbext = 'PNG';
        elseif (file_exists($val_path . 'thumb-' . $l_filename_without_ext . '.JPEG'))
            $thumbext = 'JPEG';
        else
            $thumbext = '';

        //$oldcurrentfilename = $newname.FILEADDNAME.'.'.$ext;
        //$oldcurrentfilename = $newname.'.'.$ext;

        $name = $newname;
        $newname = $newname;
        //$url = BASE_PATH. substr($val_path,3).$Filename;
        $url = $folder_lev . substr($val_path, 3) . $Filename;
        $rurl = $folder_lev . $folder . $newname . '.' . $ext;


        $re = MoveFile($Filename, BASE_PATH . substr($val_path, 3), $newname . '.' . $ext, $folder_lev . $folder);

        $myFile = "testFile.txt";
        $fh = fopen($myFile, 'a') or die("can't open file");
        $stringData = $rurl . "\n";
        fwrite($fh, $stringData);
        fclose($fh);

        $fileSize = @filesize($rurl);

        if (strlen($ext) == 3)
            $oldthumbwe = substr($Filename, 0, strlen($Filename) - 4);
        elseif (strlen($ext) == 4)
            $oldthumbwe = substr($Filename, 0, strlen($Filename) - 5);

        if ($thumbext != '') {

            $thumb_source = $folder_lev . substr($val_path, 3) . 'thumb-' . $oldthumbwe . '.' . $thumbext;
           
            $thumb_target = $folder_lev . $folder . 'thumb-' . $newname . '.' . $thumbext;
            
            copy($thumb_source, $thumb_target);
            $total_exist_thumb_move++;
           
        } else {
            $thumbext = '';
            
        }

        if (strtolower($ext) == 'jpg' || strtolower($ext) == 'jpeg' || strtolower($ext) == 'png' || strtolower($ext) == 'gif')
            $imgtype = 1;
        else
            $imgtype = 0;

        if ($imgtype == 1 && $thumbext == '') {
            
            createthumb('../' . $folder . $newname . '.' . $ext , $folder_lev . $folder . 'thumb-' . $newname . '.' . $ext, THUMBW, $ext);
            $thumbext = $ext;
            $total_make_thumb++;
           
        }

             if (strtolower($ext) == 'mp4' || strtolower($ext) == '3gp')
			{
				//get name without ext
				  $thumbext = 'jpg';
                                  
                                  $fname= $folder_lev . $folder .'thumb-'.$newname.'.jpg';
                                  $Filename= $folder_lev . $folder . $newname . '.' . $ext;
                                  $pic = htmlspecialchars($Filename);




                                  $mov = new ffmpeg_movie($pic, false);
                                  $wn = $mov->GetFrameWidth();
                                  $hn = $mov->GetFrameHeight();


                                  if($total_frames >= 350){
                                  $frame = $mov->getFrame(350);
                                  $gd = $frame->toGDImage(350);
                                  }else{
                                  $frame = $mov->getFrame(50);
                                  $gd = $frame->toGDImage(50);
                                  }


                                  $new = imageCreateTrueColor(120, 85);
                                  imageCopyResized( $new,$gd, 0, 0, 0, 0, 120, 85, $wn, $hn);
                                  imageJpeg($new,$fname,90);
                                  
                                         
			}


        $Filename = $folder_lev . $folder . $newname . '.' . $ext;
        //$newname = $oldthumbwe;
        if (strtolower($ext) == 'mp3'){
            $qn = 'select name from category where id = '.$parentid;
            $folderqn = $db->query($qn,  database::GET_ROW);
            $foldername = $folderqn['name'];
            include 'tag.php';
        }
        $name = stripslashes($name);
        $newname = stripslashes($newname);

        $qryUpdate = "insert into file (name,dname,cid,ext,thumbext,size,imagetype)
                    VALUES ('$name','$newname',$parentid,'$ext','$thumbext','$fileSize',$imgtype)";
        $db->query($qryUpdate);

        $qryUpdate = "update category set totalitem = totalitem + 1 where id  = $parentid ";
        $db->query($qryUpdate);
        $Filename = '';

    }
  
}

header("location: scan.php?tfi=$total_file_insert&tetm=$total_exist_thumb_move&tmt=$total_make_thumb&tmd=$total_maked_dir&bulk=1");
?>
