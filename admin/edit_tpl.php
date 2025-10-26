<?
include 'header.php';
echo '<div class="well"><span class="text text-danger">Be Very Carefull..! Incorrect entry may corrupt your website. <b>Edit at Your Own Risk</b></span></div>';
//################## for Mobile #########################
$listfile = array();
$i = 0;
$default_dir = "../templates/frontend_m/";
$path = "/templates/frontend_m/";
if (!($dp = opendir($default_dir)))
die("Cannot open $default_dir.");
while (false !== ($file = readdir($dp))) {
if (!is_dir($file)) {
if ($file != '.' && $file != '..') {
$listfile[$i]['filename'] = $file;
$i++;
}}
}closedir($dp);
echo '<div class="rows">';
echo '<div class="col-xs-6">';
echo '<b>Mobile Template</b>';
echo '<hr/>';
foreach($listfile as $key => $val){
echo '<div class="col-xs-21 col-md-4">';
echo '<a class="btn btn-default btn-xs btn-sm btn-block" style="margin-bottom:5px;" href="?do=input&name='.$path.$val['filename'].'">'.$val['filename'].'</a>';
echo '</div>';
}?>
</div>
<div class="col-xs-6" style="border-left:1px solid#ccc;">
<?php
$file = '../'.$_GET['name'];
if($_GET['do']=='input' && file_exists($file)){
if (isset($_POST['tpl']))
{// save the text contents
file_put_contents($file, $_POST['tpl']);
}
// read the textfile
$text = file_get_contents($file);
?>
<b>Editing "<span class="text text-primary"><?=$_GET['name']?></span>"</b>
<hr/>
<form action="" method="post" class="form-horizontal" role="form">
<textarea class="form-control" rows="10" name="tpl"><?=$text?></textarea>
<div class="clear marginbot-20"></div>
<input class="btn btn-success" type="submit" value="Submit" />
</form>
<?}else{?>
<b>Please Select Tpl</b>
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
$listfile_pc = array();
$i_pc = 0;
$default_dir_pc = "../templates/frontend_p/";
$path = "/templates/frontend_p/";
if (!($dp_pc = opendir($default_dir_pc)))
die("Cannot open $default_dir_pc.");
while (false !== ($file_pc = readdir($dp_pc))) {
if (!is_dir($file_pc)) {
if ($file_pc != '.' && $file_pc != '..') {
$listfile_pc[$i]['filename'] = $file_pc;
$i++;
}}
}closedir($dp_pc);
echo '<div class="rows">';
echo '<div class="col-xs-6">';
echo '<b>PC Template</b>';
echo '<hr/>';
foreach($listfile_pc as $key => $val_pc){
echo '<div class="col-xs-21 col-md-4">';
echo '<a class="btn btn-default btn-xs btn-sm btn-block" style="margin-bottom:5px;" href="?do=input&name='.$val_pc['filename'].'">'.$val_pc['filename'].'</a>';
echo '</div>';
}?>
</div>
<div class="col-xs-6" style="border-left:1px solid#ccc;">
<?php
$file_pc = $default_dir_pc.$_GET['name'];
if($_GET['do']=='input' && file_exists($file_pc)){
if (isset($_POST['tpl_pc']))
{// save the text contents
file_put_contents($file_pc, $_POST['tpl_pc']);
}
$text_pc = file_get_contents($file_pc);
?>
<b>Editing "<span class="text text-primary"><?=$path.$_GET['name']?></span>"</b>
<hr/>
<form action="" method="post" class="form-horizontal" role="form">
<textarea class="form-control" rows="10" name="tpl_pc"><?=$text_pc?></textarea>
<div class="clear marginbot-20"></div>
<input class="btn btn-success" type="submit" value="Submit" />
</form>
<?}else{?>
<b>Please Select Tpl</b>
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