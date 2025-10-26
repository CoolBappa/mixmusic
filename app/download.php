<?php
	ob_start();
	require_once '../settings.php';
	$headset = $db->query('select filepostfix from  site_setting where id = 1', database::GET_FIELD);
	define('POSTFIX', $headset);
	
	$id = $_GET['id'];
	
	if ($id != '') {
		$db->query('update file set download = download + 1 where id = ' . $id);
	}
	
	$kk = $db->query('select * from file where id = ' . $id, database::GET_ROW);
	
	if ($kk['imagetype'] == 1 && $kk['ext'] != 'gif') {
		include '../inc/image.resize.php';
		
		$size = explode('x', $_GET['size']);
		
		if ($id == '')
                header('location: ' . BASE_PATH);
		
		$folder = $db->query('select folder from category where id = ' . $kk['cid'], database::GET_FIELD);
		
		$file = $folder . $kk['dname'] . '.' . $kk['ext'];
		$filename = $kk['id'].'-'.$kk['name'] .$size[1].'x'.$size[0] . POSTFIX . '.' . $kk['ext'];
		
		if ($size[0] != '') {
			$settings = array('w' => $size[0], 'h' => $size[1], 'newname' => $filename);
			$file = BASE_PATH_DOWNLOAD . resize($file, $settings);
		}
		else
                $file = BASE_PATH . $file;

		$file = str_replace(BASE_PATH_DOWNLOAD, '', $file);
		
		$filename = str_replace(' ', '-', $filename);
		header("Pragma: public");
		header('Content-disposition: attachment; filename='.$filename);
		header("Content-type: image/".$kk['ext']);
		header('Content-Transfer-Encoding: binary');
		readfile($file);
		
		} else {
		if ($id == '')
		header('location: ' . BASE_PATH);
		$destfolder = $db->query('select folder from category where id = ' . $kk['cid'], database::GET_FIELD);
                
                if($_GET['bitrate']=="320kbps"){
                $folder = $destfolder.'320KBPS/';
                $file = $kk['name'] .'-320Kbps'. POSTFIX . '.' . $kk['ext'];
                }
                elseif($_GET['bitrate']=="64kbps"){
                $folder = $destfolder.'64KBPS/';
                $file = $kk['name'] .'-64Kbps'. POSTFIX . '.' . $kk['ext'];
                }else{
                $folder = $destfolder;
                $file = $kk['dname'] .'.' . $kk['ext'];
                }
		
		//$filename = $kk['name'] . POSTFIX . '.' . $kk['ext'];
		header("location: " . BASE_PATH_DOWNLOAD . "$folder$file");
	}
	
	$db->disconnect();
	exit; 
?>