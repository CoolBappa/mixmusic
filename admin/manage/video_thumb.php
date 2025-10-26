<?php
include '../header.php';
include("../includes/admin-config.php");


$id = $_GET['id'];
$cid = $_GET['cid'];
$page = $_GET['page'];
if($page=='')
$page=1;

$qnew = 'select folder from category where id = ' . $cid;
$queryf = $db->query($qnew,  database::GET_ROW);
$savefolder= $queryf['folder'];

$qn = 'select * from file where id = ' . $id;
$query = $db->query($qn,  database::GET_ROW);
$name = '../../'.$savefolder.$query['dname'].'.'.$query['ext'];

$fname1= 'tmp/1.jpg';
$fname2= 'tmp/2.jpg';
$fname3= 'tmp/3.jpg';
$fname4= 'tmp/4.jpg';
$fname5= 'tmp/5.jpg';

$pic = htmlspecialchars($name);

$mov = new ffmpeg_movie($pic, false);
$wn = $mov->GetFrameWidth();
$hn = $mov->GetFrameHeight();

                                 
$fm1=rand(250,300);
$fm2=rand(301,500);
$fm3=rand(501,700);
$fm4=rand(701,800);
$fm5=rand(801,900);

$frame1 = $mov->getFrame($fm1);
$frame2 = $mov->getFrame($fm2);
$frame3 = $mov->getFrame($fm3);
$frame4 = $mov->getFrame($fm4);
$frame5 = $mov->getFrame($fm5);

$gd1 = $frame1->toGDImage($fm1);
$gd2 = $frame2->toGDImage($fm2);
$gd3 = $frame3->toGDImage($fm3);
$gd4 = $frame4->toGDImage($fm4);
$gd5 = $frame5->toGDImage($fm5);

$new1 = imageCreateTrueColor(120, 85);
imageCopyResized( $new1,$gd1, 0, 0, 0, 0, 120, 85, $wn, $hn);

$new2 = imageCreateTrueColor(120, 85);
imageCopyResized( $new2,$gd2, 0, 0, 0, 0, 120, 85, $wn, $hn);

$new3 = imageCreateTrueColor(120, 85);
imageCopyResized( $new3,$gd3, 0, 0, 0, 0, 120, 85, $wn, $hn);

$new4 = imageCreateTrueColor(120, 85);
imageCopyResized( $new4,$gd4, 0, 0, 0, 0, 120, 85, $wn, $hn);

$new5 = imageCreateTrueColor(120, 85);
imageCopyResized( $new5,$gd5, 0, 0, 0, 0, 120, 85, $wn, $hn);

imageJpeg($new1,$fname1);
imageJpeg($new2,$fname2);
imageJpeg($new3,$fname3);
imageJpeg($new4,$fname4);
imageJpeg($new5,$fname5);

?>


 <div class="panel panel-default width-800">
              <div class="panel-heading">
                <h2 class="panel-title pull-left margintop-5">Select Video Thumb</h2>
                <div class="pull-right">
                  <a class="btn btn-sm btn-danger" href="?id=<?=$id?>&cid=<?=$cid?>&page=<?=$page?>"><i class="fa fa-refresh"></i> Refresh</a> 
                  <a class="btn btn-sm btn-primary" href="index.php?pid=<?= $cid ?>&page=<?=$page?>" class="btn"><i class="fa fa-chevron-left"></i> Back To List</a> 
                </div>
              <div class="clear"></div>
              </div>
            <div class="panel-body text-center">
         
            
<?
echo '<a href="video_thumb_process.php?id='.$id.'&cid='.$cid.'&name=1.jpg&page='.$page.'"><img src="'.$fname1.'?'.time().'"></a>&nbsp;&nbsp;&nbsp;';
echo '<a href="video_thumb_process.php?id='.$id.'&cid='.$cid.'&name=2.jpg&page='.$page.'"><img src="'.$fname2.'?'.time().'"></a>&nbsp;&nbsp;&nbsp;';
echo '<a href="video_thumb_process.php?id='.$id.'&cid='.$cid.'&name=3.jpg&page='.$page.'"><img src="'.$fname3.'?'.time().'"></a>&nbsp;&nbsp;&nbsp;';
echo '<a href="video_thumb_process.php?id='.$id.'&cid='.$cid.'&name=4.jpg&page='.$page.'"><img src="'.$fname4.'?'.time().'"></a>&nbsp;&nbsp;&nbsp;';
echo '<a href="video_thumb_process.php?id='.$id.'&cid='.$cid.'&name=5.jpg&page='.$page.'"><img src="'.$fname5.'?'.time().'"></a>&nbsp;&nbsp;&nbsp;';

?>
 </div>
</div>
<?
include $adminfoldername.'/footer.php';
ob_end_flush();

?>

