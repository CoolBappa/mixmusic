<?php

include("../includes/admin-config.php");
include 'resize-class.php';
if ($_POST['pid'] != '') {

    $parentid = $_REQUEST['pid'];
    $id = $_REQUEST['id'];
    $fieldname = 'file';	
    $qnew = 'select folder from category where id = ' . $id;
    $query = $db->query($qnew,  database::GET_ROW);
    $savefolder= $query['folder'];

    if ($_FILES['fthumb']['name'] != '') {
        
        $thumbname = folder;
        @getimagesize($_FILES['fthumb']['tmp_name']) or error('only image uploads are allowed', $invalidurl);
        $thumbup = UploadImage('fthumb', $invalidurl, $thumbname, '../../'.$savefolder, 0, '', 0);
        $resize = new ResizeImage('../../'.$savefolder . $thumbname . '.' . $thumbup[3]);
        $resize->resizeTo(400, 400, 'maxWidth');
        $resize->saveImage('../../'.$savefolder . $thumbname . '.' . $thumbup[3], 211, $thumbup[3]);

        //createthumb('../../'.$savefolder . $thumbname . '.' . $thumbup[3], '../../'.$savefolder . $thumbname . '.' . $thumbup[3],  $thumbup[3]);
        $thumbext = $thumbup[3];
        $thumbfullname = $thumbname . '.' . $thumbext;
       
        $images_folder = '../../'.$savefolder;
	$destination_folder = '../../'.$savefolder;
	$imgpath = $images_folder.$thumbfullname ;

        $photo = imagecreatefromjpeg($imgpath);
        $watermark = imagecreatefrompng("../../css/images/watermark.png");
        imagealphablending($photo, true);
        $offset = 0;
        imagecopy($photo, $watermark, imagesx($photo) - imagesx($watermark) - $offset, imagesy($photo) - imagesy($watermark) - $offset, 0, 0, imagesx($watermark), imagesy($watermark));
        imagejpeg($photo,$imgpath); 
        imagedestroy($photo);

    }
    
  
    $para = "errid=1&pid=".$id ;
    
    if ($parentid != 0)
        header("location: index.php?" . $para);
    else
        header("location: index.php?". $para);
}
?>