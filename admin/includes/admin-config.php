<?php
	session_start();
	ob_start();

        $adminfoldername = 'admin';
	$rootDir = dirname(dirname(__FILE__));
	$rootDir = str_replace('/'.$adminfoldername,'',$rootDir);
	set_include_path($rootDir . PATH_SEPARATOR . get_include_path());

	require_once("inc/function.php");
	require_once($adminfoldername."/includes/language.php");
        require_once('inc/admin.db.php');
        require_once('inc/seo_url.php');
        

        $currentFile = $_SERVER["SCRIPT_NAME"];
	$parts = explode('/', $currentFile);
	$currpagename = $parts[count($parts)-1];

        //$_SESSION['admin_id'] = '1';

       
        define('BASE_PATH','http://mixmusic.in/');
        define('ADMIN_BASE_PATH',BASE_PATH.'admin/');
        $adminfolder = 'admin/';
        function setKEY() {
        $key = md5(microtime().rand());
        $passkey =$key;
        }
	if(!($currpagename == 'admin_login.php' or $currpagename == 'login_check.php'))
        	CheckAdminLogin(ADMIN_BASE_PATH);

	if($_REQUEST['errid']!="" && is_numeric($_REQUEST['errid']))
	{
            if(count($message) < $_REQUEST['errid'])
            {
                    $msg = $message[0];
            }
            else
            {
                    $msg = $message[$_REQUEST['errid']];
            }
            if($_REQUEST['errid'] == 2 || $_REQUEST['errid'] == 5 || $_REQUEST['errid'] == 17)
            {
                $CurrentMessage = '<div class="error_box" id="dddd">'.$msg.'</div>';
            }
            elseif($_REQUEST['errid'] == 6)
            {
                $CurrentMessage = '<div class="warning_box" id="dddd">'.$msg.'</div>';
            }
            else {
                $CurrentMessage = '<div class="valid_box" id="dddd">'.$msg.'</div>';
            }
	}

	//setting for head
	$headsetq = 'select * from site_setting where id = 1';
	$headset = $db->query($headsetq, database::GET_ROW);
        
	define("FILEADDNAME",$headset['filepostfix']);
	define("THUMBW",$headset['thumbw']);

	 //watermark font size
	$font_size = '12';
	$text = $headset['watermark'];
        $replace = array(' ','-','!','&','@');

?>