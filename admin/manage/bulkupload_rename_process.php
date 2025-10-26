<?php
    $name = $_GET['name'];
    $oldname= $_GET['oldname'];
    $id= $_GET['id'];
    rename('../../files/bulk_upload/'.$oldname, '../../files/bulk_upload/'.$name);
    header('location: bulkupload.php?id='.$_GET['id']);
?>