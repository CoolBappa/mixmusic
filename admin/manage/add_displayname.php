<?
include("../includes/admin-config.php");
$cid = $_REQUEST['cid'];
$id = $_REQUEST['id'];
$displayname = $_REQUEST['displayname'];


 $qryUpdate = "update category set
                            displayname = '$displayname' where id = ".$id;
            $db->query($qryUpdate);


    header("location: index.php?errid=1&pid=$cid");

?>