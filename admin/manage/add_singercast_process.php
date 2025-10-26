<?php
	include("../includes/admin-config.php");
        include 'resize-class.php';
	if($_REQUEST['singer']=='1' || $_REQUEST['star']=='1'){
	
                
	        $name = $_POST['name'];
                $desc = $_POST['desc'];

		$thumbfullname = '';
		if($_FILES['thumb']['name'] != '')
		{
			$rand = rand(111111111111,999999999999);
			$thumbname =  $rand.'-'.cleanfilename($_REQUEST['name']);
			@getimagesize($_FILES['thumb']['tmp_name']) or error('only image uploads are allowed', $invalidurl);
			$thumbup = UploadImage('thumb',$invalidurl,$thumbname,'../../files/starsinger-icon/',0,'',0);

                        $resize = new ResizeImage('../../files/starsinger-icon/' . $thumbname . '.' . $thumbup[3]);
                        $resize1 = new ResizeImage('../../files/starsinger-icon/' . $thumbname . '.' . $thumbup[3]);
                        $resize->resizeTo(60, 60, 'exact');
                        $resize1->resizeTo(150, 150, 'exact');
                        $resize->saveImage('../../files/starsinger-icon/' . $thumbname . '.' . $thumbup[3], 211, $thumbup[3]);
                        $resize1->saveImage('../../files/starsinger-icon/large-' . $thumbname . '.' . $thumbup[3], 211, $thumbup[3]);

			//createthumb('../../files/starsinger-icon/'.$thumbname.'.'.$thumbup[3],'../../files/starsinger-icon/'.$thumbname.'.'.$thumbup[3],$thumbup[3]);
			
			$thumbext = $thumbup[3];
			$thumbfullname = $thumbname.'.'.$thumbext;
		}
		
		
		$db->query("insert into `singer_star` (name,des,thumb) values('$name','$desc','$thumbfullname')");

                $getnewid = $db->insert_id;
                
                $result = mysql_query("SELECT COUNT(*) AS total FROM `singer_star`") or die(mysql_error());
                $row = mysql_fetch_array($result);
                $total = $row['total'];

                $db->query("update `singer_star` set kram = $total where id = $getnewid");




                if($_POST['singer']=='1'){
        	$db->query("update singer_star set singer = 1 where id = ".$getnewid);
		}
                elseif($_POST['star']=='1'){
                $db->query("update singer_star set star = 1 where id = ".$getnewid);
		}
                
		if($_GET['from']=='modal')
                header("location: index.php?pid=".$_POST['pid']."");
                else
		header("location: add_singercast.php?errid=3");
                
	}
	
?>

