<?
include("../includes/admin-config.php");
$cid = $_REQUEST['cid'];
$id = $_REQUEST['id'];
$page = $_REQUEST['page'];
$artist = $_REQUEST['artistname'];
$q = 'select folder from category where id = ' . $cid;
$savefolder = $db->query($q,  database::GET_FIELD);
$qe = 'select * from file where id = '.$id;
$qq = $db->query($qe,  database::GET_ROW);
$ext = $qq[ext];
$name = $qq[name];

 $qryUpdate = "update file set
                            artist = '$artist' where id = ".$id;
            $db->query($qryUpdate);
      
        $nqe = 'select * from file where id = '.$id;
        $nqq = $db->query($nqe,  database::GET_ROW);
        $singerlist = $nqq['artist'];

        $sing = array($singerlist);
        array_walk($sing , 'intval');
        $ids = implode(',', $sing);
        $sql = "SELECT * FROM singer_star WHERE id IN ($ids) order by id desc";
        $gets = $db->query($sql);

        $sing = array();

        foreach ($gets as $key => $val) {
        $sing[$key] = $val['name'];
        }

        $singer = implode(', ', $sing);

        

if(strtolower($ext)=='mp3')
    {
        $sourcefile= '../../'.$savefolder.$qq[dname].'.'.$ext;
        $qn = 'select name from category where id = '.$cid;
	$folderqn = $db->query($qn,  database::GET_ROW);
        $foldername = $folderqn['name'];
        include 'tag_update.php';
    }
   header("location: index.php?errid=1&pid=$cid&page=$page");


?>