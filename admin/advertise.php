<?
include 'header.php';
//################## for Mobile #########################
$default_dir = "../files/advt/mob/";
$blacklist = array('somedir','somefile.php');
$files = preg_grep('/^([^.])/', scandir($default_dir)); 
echo '<div class="rows">';
echo '<div class="col-xs-6">';
echo '<b>Mobile Ad Slots</b>';
echo '<hr/>';
foreach ($files as $file) {
if (!in_array($file, $blacklist)) {
echo '<div class="col-xs-21 col-md-4">';
echo '<a class="btn btn-default btn-xs btn-sm btn-block" style="margin-bottom:5px;" href="?do=input&name='.$file.'">'.$file.'</a>';
echo '</div>';
}
}
?>
</div>
<div class="col-xs-6" style="border-left:1px solid#ccc;">
<?php
$file = $default_dir.$_GET['name'];
if($_GET['do']=='input' && file_exists($file)){
if (isset($_POST['ad']))
{
// save the text contents
file_put_contents($file, $_POST['ad']);
}
// read the textfile
$text = file_get_contents($file);
?>
<b>Editing "<span class="text text-primary"><?=$_GET['name']?></span>"</b>
<hr/>
<form action="" method="post" class="form-horizontal" role="form">
<textarea class="form-control" rows="10" name="ad"><?=$text?></textarea>
<div class="clear marginbot-20"></div>
<input class="btn btn-success" type="submit" value="Submit" />
</form>
<?}else{?>
<b>Please Select Ad Php</b>
<hr/>
<form class="form-horizontal" role="form">
<textarea class="form-control" rows="10" name="ad"></textarea>
</form>
<div class="clear marginbot-20"></div>
<div class="btn btn-success">Submit</div>
<?}?>
</div>
</div>
<div class="clear marginbot-20"></div>
<?
//################# For Pc ###################
$default_dir_pc = "../files/advt/pc/";
$blacklist_pc = array('somedir','somefile.php');
$files_pc = preg_grep('/^([^.])/', scandir($default_dir_pc)); 
echo '<div class="rows">';
echo '<div class="col-xs-6">';
echo '<b>PC Ad Slots</b>';
echo '<hr/>';
foreach ($files_pc as $file_pc) {
if (!in_array($file_pc, $blacklist_pc)) {
echo '<div class="col-xs-21 col-md-4">';
echo '<a class="btn btn-default btn-xs btn-sm btn-block" style="margin-bottom:5px;" href="?do=input&name='.$file_pc.'">'.$file_pc.'</a>';
echo '</div>';
}
}
?>
</div>
<div class="col-xs-6" style="border-left:1px solid#ccc;">
<?php
$file_pc = $default_dir_pc.$_GET['name'];
if($_GET['do']=='input' && file_exists($file_pc)){
if (isset($_POST['ad_pc']))
{
// save the text contents
file_put_contents($file_pc, $_POST['ad_pc']);
}
$text_pc = file_get_contents($file_pc);
?>
<b>Editing "<span class="text text-primary"><?=$_GET['name']?></span>"</b>
<hr/>
<form action="" method="post" class="form-horizontal" role="form">
<textarea class="form-control" rows="10" name="ad_pc"><?=$text_pc?></textarea>
<div class="clear marginbot-20"></div>
<input class="btn btn-success" type="submit" value="Submit" />
</form>
<?}else{?>
<b>Please Select Ad Php</b>
<hr/>
<form class="form-horizontal" role="form">
<textarea class="form-control" rows="10" name="ad"></textarea>
</form>
<div class="clear marginbot-20"></div>
<div class="btn btn-success">Submit</div>
<?}?>
</div>
</div>
<? include 'footer.php';?>