<?php
        $host = str_replace('www.','',$_SERVER['HTTP_HOST']);
        if(strtolower($_SERVER['HTTP_HOST'])=='www.'.$host.''){
        header('Location: http://'.$host.$_SERVER['REQUEST_URI'],TRUE,302);
        }
        require_once('inc/db.php');
	require_once('inc/function.php');
	require_once('inc/seo_url.php');
        require_once('inc/Mobile_Detect.php');
	$detect = new Mobile_Detect;
	$set = new stdClass(); 
	$rootDir = dirname(dirname(__FILE__));
	set_include_path($rootDir . PATH_SEPARATOR . get_include_path());
	$agent_c = $_SERVER['HTTP_USER_AGENT'];
	if ( $detect->isMobile() ) {
		$set->template ='./templates/frontend_m';
		}else{
		$set->template ='./templates/frontend_p';
	}
	if ($_REQUEST['errid'] != "" && is_numeric($_REQUEST['errid'])) {
		if (count($message) < $_REQUEST['errid']) {
			$msg = $message[0];
			} else {
			$msg = $message[$_REQUEST['errid']];
		}
		
		$CurrentMessage = "<span class='error'>" . $msg . "</span><br>";
	}
        function setKEY() {
        $key = md5(microtime().rand());
        $passkey =$key;
        }
	$nname = $_GET['ht'];
	if ($_GET['pid'] != '')
           $parentid = $_GET['pid'];
	else
           $parentid = 0;
	
	if (!is_numeric($parentid)) {
		echo "Please not try to be claver. Please do not edit url manually";
		exit;
	}
	
	$headset = $db->query('select * from site_setting where id = 1', database::GET_ROW);
        define("LOGO_MOB", '/css/images/mixlogo-mo.png');
        define("LOGO_PC", '/css/images/mixlogo-pc.png');
	define("SITETITLE", $headset['title']);
	define("SITENAME", $headset['sitename']);
	define("METADES", $headset['metades']);
	define("METAKEY", $headset['metakey']);
	define("ANALYTICS", $headset['analytics']);
	define("CATPERPAGE_MOB", $headset['catperpage_mob']);
        define("CATPERPAGE_PC", $headset['catperpage_pc']);
	define("FILEPERPAGE_MOB", $headset['fileperpage_mob']);
        define("FILEPERPAGE_PC", $headset['fileperpage_pc']);
	define("UPDATEPERPAGE_MOB", $headset['updateperpage_mob']);
        define("UPDATEPERPAGE_PC", $headset['updateperpage_pc']);
	define("UPDATEHOME_MOB", $headset['updatehome_mob']);
        define("UPDATEHOME_PC", $headset['updatehome_pc']);
	define("POSTFIX", $headset['filepostfix']);
	define("THUMB_W", $headset['dthumbw']);
	define("THUMB_H", $headset['dthumbh']);
	define("BASE_PATH","http://mixmusic.in/");
	define("MAIN_BASE_PATH","http://mixmusic.in/");
	define("BASE_PATH_SCREEN","http://mixmusic.in/");
	$advert = array(); 
	$advert[] = 'http://mixmusic.in/';
	shuffle($advert); 
	define("BASE_PATH_DOWNLOAD","$advert[0]");

        if($parentid==! 0){
		$folddetail = $db->query('select * from category where id =' .$_GET['pid'] , database::GET_ROW); 
		$seq =  $folddetail['pathc'];//$db->query("select pathc from category where id = ". $parentid, database::GET_FIELD);
		if($def == 'update' || $def == 'search' || $def == 'top'){}else{
			$PATH = '<a href="'.BASE_PATH.'">Home</a>';
			$PATH .=str_replace('&raquo;',' / ',$seq);
		}
	}
	if ($parentid != '' && $parentid > 0) {
		$folqtt = $db->query("select clink from category where id = " . $_REQUEST['pid'], database::GET_FIELD);
		$folqttt = str_replace('_', ' ', $folqtt);
		$NTITLE = str_replace('/', ' :: ', $folqttt);
		$NTITLEM = str_replace('/', ', ', $folqttt);
	}
	
?>
