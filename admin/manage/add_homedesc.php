<?
include("../includes/admin-config.php");
$cid = $_REQUEST['cid'];
$id = $_REQUEST['id'];
$homedesc = $_REQUEST['homedesc'];


 $qryUpdate = "update category set
                            homedesc = '$homedesc' where id = ".$id;
            $db->query($qryUpdate);


    header("location: index.php?errid=1&pid=$cid");

?>