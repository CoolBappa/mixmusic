<?php

    include("../includes/admin-config.php");

   

    $parentid = $_GET['pid'];
    $id = $_GET['id'];
    
    $qnew = 'select fthumb,name,folder from category where id = ' . $id;
    $old = $db->query($qnew,  database::GET_ROW);
    $oldthumb = $old['fthumb'];
    $savefolder= $old['folder'];

    $thumbfullname = '';
    unlink('../../'.$savefolder . $oldthumb);
    unlink('../../'.$savefolder . 'mid-'.$oldthumb);
    unlink('../../'.$savefolder . 'large-'.$oldthumb);
    unlink('../../'.$savefolder . 'small-'.$oldthumb);

    $qryUpdate = "update category set fthumb = '$thumbfullname' where id=" . $id;

    $db->query($qryUpdate);

    $para = "errid=14&pid=".$id ;

    if ($parentid != 0)
        header("location: index.php?" . $para);
    else
        header("location: index.php?". $para);
     
  
?>