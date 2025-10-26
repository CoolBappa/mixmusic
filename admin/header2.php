<?php include("includes/admin-config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="nofollow" />
        <title>ADMIN PANEL</title>
        <link rel="stylesheet" type="text/css" href="<?=ADMIN_BASE_PATH?>style.css" />
        <link rel="shortcut icon" href="<?=BASE_PATH?>images/favicon-m.ico" />
        <link rel="stylesheet" type="text/css" media="all" href="<?=ADMIN_BASE_PATH?>niceforms-default.css" />

    </head>
    <body>
        <div id="main_container">
            
            <div class="header">
                
                <?php
                    if($_SESSION['admin_name'] != '')
                    {
                        ?>   <div class="right_header">Welcome <?=$_SESSION['admin_name']?> | <a href="<?=ADMIN_BASE_PATH?>logout.php" class="logout">Logout</a></div>
                       
                        <?php
                        
                    }
                    ?>
            </div>
             
                
 <div class="center_content"> 
