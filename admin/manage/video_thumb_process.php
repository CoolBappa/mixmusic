<?php
include("../includes/admin-config.php");
$id = $_GET['id'];
$cid = $_GET['cid'];
$page = $_GET['page'];
$filename = $_GET['name'];

$qnew = 'select folder from category where id = ' . $cid;
$queryf = $db->query($qnew,  database::GET_ROW);
$savefolder= $queryf['folder'];

$qn = 'select * from file where id = ' . $id;
$query = $db->query($qn,  database::GET_ROW);
$name = '../../'.$savefolder.'thumb-'.$query['dname'].'.'.$query['thumbext'];
unlink($name);
rename('tmp/'.$filename,$name);
$dir = "tmp/"; 
$dirHandle = opendir($dir); 
while ($file = readdir($dirHandle)) { 
    
    if(!is_dir($file)) { 
        unlink ("$dir"."$file"); // unlink() deletes the files
    }
}
closedir($dirHandle);
header('location: index.php?pid='.$_GET['cid'].'&page='.$page.'');
?>
