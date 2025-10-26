<?
include("../includes/admin-config.php");
$id = $_GET['id'];
$folq = "select folder from category where id = ".$id;
$FOLDER = '../../'.$db->query($folq,database::GET_FIELD);
$Path = $FOLDER.'folder.jpg';
unlink($Path);
$para = "errid=14&pid=".$id ;

    if ($id != 0)
        header("location: index.php?" . $para);
    else
        header("location: index.php?". $para);

?>