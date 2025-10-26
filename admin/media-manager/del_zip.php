<?php

    unlink('zipfiles/'.$_GET['name']);
    header('location: unzip.php');
?>