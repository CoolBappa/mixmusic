<?php
session_start();
include '../settings.php';
$headsetadmin = $db->query('select * from `admin` where id = 1' , database::GET_ROW);
include '../'.$set->template.'/dmca.tpl';
?> 