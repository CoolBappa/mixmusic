<?php 
include '../header.php'; 
?>
<?php
$id = $_GET['id'];
$cid = $_GET['cid'];
if($_GET['id'] == '' || $_GET['cid'] == '')
	exit;
else
{
$n = $db->query('select * from file where id = '.$id,database::GET_ROW);
$folq = "select folder from category where id = ".$cid;
$FOLDER = '../../'.$db->query($folq,database::GET_FIELD);
}

require_once('getid3/getid3.php'); 
$TaggingFormat = 'UTF-8';
$mp3 = $FOLDER.$n[dname].'.'.$n[ext];
$Path=$mp3;
$getID3 = new getID3;
$ThisFileInfo = $getID3->analyze($Path);
getid3_lib::CopyTagsToComments($ThisFileInfo); 
//if(isset($ThisFileInfo['comments']['picture'][0])){
$albumart='data:'.$ThisFileInfo['comments']['picture'][0]['image_mime'].';charset=utf-8;base64,'.base64_encode($ThisFileInfo['comments']['picture'][0]['data']);
//}
$title = implode(', ', $ThisFileInfo['comments']['title']);
$artist = implode(', ', $ThisFileInfo['comments']['artist']);
$album = implode(', ', $ThisFileInfo['comments']['album']);
$year = implode(', ', $ThisFileInfo['comments']['year']);
$genre = implode(', ', $ThisFileInfo['comments']['genre']);
$com = implode(', ', $ThisFileInfo['comments']['comment']);
?>



<?
// output desired information in whatever format you want 
//echo $ThisFileInfo['filenamepath'].'<BR>'; 
//if (!empty($ThisFileInfo['comments']['artist'])) { 
//echo implode(', ', $ThisFileInfo['comments']['artist']).'<BR>'; 
//} 
//if (!empty($ThisFileInfo['audio']['bitrate'])) { 
//echo round($ThisFileInfo['audio']['bitrate'] / 1000).' kbps<BR>'; 
//} 
//if (!empty($ThisFileInfo['playtime_string'])) { 
//echo $ThisFileInfo['playtime_string'].'<BR>'; 
//} 
//echo '<HR>'; 
?>


 <div class="panel panel-primary width-800">
   <div class="panel-heading">
     <h2 class="panel-title"><i class="fa fa-edit"></i> Edit Mp3 Tags</h2>
   </div>
  <div class="panel-body">

        <form action="edit_mp3tag_process.php" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
            <div class="input-group marginbot-20">
              <span class="input-group-addon"><i class="fa fa-music"></i> &nbsp;Title</span>
              <input type="text" class="form-control" name="title" id="" value="<?=$title?>" />
            </div>
           
           <div class="input-group marginbot-20">
              <span class="input-group-addon"><i class="fa fa-music"></i> &nbsp;Artist</span>
              <input type="text" class="form-control" name="artist" id="" value="<?=$artist?>" />
            </div>

           <div class="input-group marginbot-20">
              <span class="input-group-addon"><i class="fa fa-music"></i> &nbsp;Album</span>
              <input type="text" class="form-control" name="album" id="" value="<?=$album?>" />
            </div>

           <div class="input-group marginbot-20">
              <span class="input-group-addon"><i class="fa fa-music"></i> &nbsp;Year</span>
              <input type="text" class="form-control" name="year" id="" value="<?=$year?>" />
            </div>

           <div class="input-group marginbot-20">
              <span class="input-group-addon"><i class="fa fa-music"></i> &nbsp;Genre</span>
              <input type="text" class="form-control" name="genre" id="" value="<?=$genre?>" />
            </div>

           <div class="input-group marginbot-20">
              <span class="input-group-addon"><i class="fa fa-music"></i> &nbsp;Comment</span>
              <input type="text" class="form-control" name="comment" id="" value="<?=$com?>" />
            </div>
         
           <div class="input-group marginbot-20">
           <label><i class="fa fa-music"></i> Albumart:</label>
           <img id="FileImage" width="150" src="<?php echo @$albumart;?>" height="150">
           </div>

           <div class="input-group marginbot-20">
            <span class="input-group-btn">
            <span class="btn btn-info btn-file">
            Browse new AlbumArt..<input type="file" name="fthumb"/>
            </span>
            </span>
            <input type="text" class="form-control" placeholder="Only jpg file.."readonly />
           </div>
           
     

            <div class="clear marginbot-20"></div>
            <div class="pull-right">
               <input type="hidden" name="id" value="<?=$id?>" />
               <input type="hidden" name="cid" value="<?=$cid?>" />
               <input type="submit" class="btn btn-success" name="submit" id="submit" value="Update Tag" />
               <a class="btn btn-danger" href="index.php?pid=<?=$cid?>"><i class="fa fa-chevron-left"></i> Back To File</a>
            </div> 
        </form>
     </div>
<?php include $adminfoldername.'/footer.php'; ?>