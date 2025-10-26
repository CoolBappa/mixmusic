<?php

    unlink('../../files/bulk_upload/'.$_GET['name']);
    header('location: bulkupload.php?id='.$_GET['id']);
?>

