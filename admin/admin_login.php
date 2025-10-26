<?php include("includes/admin-config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="nofollow" />
        <title>ADMIN PANEL</title>
        <link rel="stylesheet" type="text/css" href="<?=ADMIN_BASE_PATH?>/css/login.css" />

    </head>
    <body>
     
             <div id="login">
             
               <h1>ADMIN PANEL</h1>
		<form action="login_check.php" method="post">
			<input type="text" name="uname" placeholder="Email" />
                        <input type="password" name="pwd" placeholder="Password" />
                        <input type="submit" name="submit" value="Log in" />
		</form>
              <div class="copy">Powered by WAPcms - WebNext<font color="#3399cc">Media</font></div>
             </div>
      <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>

  <script src="<?=ADMIN_BASE_PATH?>js/index.js"></script>
 </body>
</html>
	