<?php

include("../includes/admin-config.php");
include 'resize-class.php';


if ($_POST['pid'] != '') {

    $parentid = $_REQUEST['pid'];
    $id = $_REQUEST['id'];
    
    $qnew = 'select fthumb,name,folder from category where id = ' . $id;
    $old = $db->query($qnew,  database::GET_ROW);
    $oldthumb = $old['fthumb'];
    $savefolder= $old['folder'];

    if ($_FILES['fthumb']['name'] != '') {
        
        $thumbname = time();
        @getimagesize($_FILES['fthumb']['tmp_name']) or error('only image uploads are allowed', $invalidurl);
        $thumbup = UploadImage('fthumb', $invalidurl, $thumbname, '../../'.$savefolder, 0, '', 0);
        $resize = new ResizeImage('../../'.$savefolder . $thumbname . '.' . $thumbup[3]);
        $resize1 = new ResizeImage('../../'.$savefolder . $thumbname . '.' . $thumbup[3]);
        $resize2 = new ResizeImage('../../'.$savefolder . $thumbname . '.' . $thumbup[3]);
        $resize3 = new ResizeImage('../../'.$savefolder . $thumbname . '.' . $thumbup[3]);
        
        $resize->resizeTo(150, 150, 'exact');
        $resize1->resizeTo(50, 50, 'exact');
        $resize2->resizeTo(200, 200, 'exact');
        $resize3->resizeTo(400, 400, 'exact');
        $resize->saveImage('../../'.$savefolder . $thumbname . '.' . $thumbup[3], 211, $thumbup[3]);
        $resize1->saveImage('../../'.$savefolder . 'small-'.$thumbname . '.' . $thumbup[3], 211, $thumbup[3]);
        $resize2->saveImage('../../'.$savefolder . 'mid-'.$thumbname . '.' . $thumbup[3], 211, $thumbup[3]);
        $resize3->saveImage('../../'.$savefolder . 'large-'.$thumbname . '.' . $thumbup[3], 211, $thumbup[3]);


        $thumbext = $thumbup[3];
        $thumbfullname = $thumbname . '.' . $thumbext;
        
        
 
    } else {
        $thumbfullname = $oldthumb;
    }
    

    $qryUpdate = "update category set fthumb = '$thumbfullname' where id=" . $id;

    $db->query($qryUpdate);

   

    $para = "errid=1&pid=".$id ;
    
    if ($parentid != 0)
        header("location: index.php?" . $para);
    else
        header("location: index.php?". $para);
}
?>
