<?php
include 'header.php';
$reset = 'update file set weekly_dl=0' ;
$db->query($reset);

echo '<div class="alert alert-success"><i class="fa fa-check-square fa-2x" style="color:#38b44a"></i> Successfully Reset Weekly Downloads</div>';

include 'footer.php';
?>