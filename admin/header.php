<?php include("includes/admin-config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="nofollow" />
<title><?=$headset['sitename']?> - ADMIN PANEL</title>
<link rel="stylesheet" type="text/css" href="<?=ADMIN_BASE_PATH?>/css/style.css?1.2016" />
<link rel="shortcut icon" href="<?=ADMIN_BASE_PATH?>images/favicon-adn.ico" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="<?=ADMIN_BASE_PATH?>js/ddaccordion.js"></script>
<script type="text/javascript" src="<?=ADMIN_BASE_PATH?>js/toggle.js"></script>
<link rel="stylesheet" type="text/css" href="<?=ADMIN_BASE_PATH?>/css/theme.min.css?ver.2016" />
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=ADMIN_BASE_PATH?>js/jconfirmaction.jquery.js"></script>
<link type="text/css" rel="stylesheet" href="<?=ADMIN_BASE_PATH?>css/jquery-te-1.4.0.css">
<script type="text/javascript" src="<?=ADMIN_BASE_PATH?>js/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=ADMIN_BASE_PATH?>js/wysiwyg.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?=ADMIN_BASE_PATH?>js/custom.tag-it.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
<link href="<?=ADMIN_BASE_PATH?>css/jquery.tagit.css" rel="stylesheet" type="text/css">
<script>
setTimeout(function() {
$('#dddd').fadeOut('slow');
}, 4000); // <-- time in milliseconds
$(document).ready(function() {
$('.ask').jConfirmAction();
});
</script>
<script type="text/javascript">
$(document).ready(function(){ 
$("#myTab a").click(function(e){
e.preventDefault();
$(this).tab('show');
});
});

$(document)
.on('change', '.btn-file :file', function() {
var input = $(this),
numFiles = input.get(0).files ? input.get(0).files.length : 1,
label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
input.trigger('fileselect', [numFiles, label]);
});
$(document).ready( function() {
$('.btn-file :file').on('fileselect', function(event, numFiles, label) {
var input = $(this).parents('.input-group').find(':text'),
log = numFiles > 1 ? numFiles + ' files selected' : label;
if( input.length ) {
input.val(log);
} else {
if( log ) alert(log);
}
});
});		
$("[name='existingthumb']").bootstrapSwitch();


$(document).ready(function(){
$('#tog').fadeIn(1000);
});

function myAjax() {
$.ajax({
type: "POST",
url: '<?=ADMIN_BASE_PATH?>clear.php',
data:{action:'call_this'},
success:function(html) {
alert(html);
}
});
}

function myAjax2() {
$.ajax({
type: "POST",
url: '<?=ADMIN_BASE_PATH?>update_file.php',
data:{action:'call_this'},
success:function(html) {
alert(html);
}
});
}
</script>
</head>
<body>
<div id="wrapper">
<div id="sidebar-wrapper">
<div class="logo"><i class="fa fa-cog"></i> Admin Panel</div>
<?
if($_SESSION['admin_name'] != '')
{
?>
<div class="list-group">
<a class="list-group-item link-white" href="<?=ADMIN_BASE_PATH?>"><i class="fa fa-home"></i>&nbsp; Dashboard</a>
<a class="list-group-item link-white" href="<?=ADMIN_BASE_PATH?>manage/" title="Categories"><i class="fa fa-gear"></i>&nbsp; Manage</a>
<a class="list-group-item link-white" href="<?= ADMIN_BASE_PATH ?>manage/add_singercast.php"><i class="fa fa-star"></i>&nbsp; Singers & Stars</a>
<a class="list-group-item link-white" href="<?=ADMIN_BASE_PATH?>thumb-update/" title="thumb-update"><i class="fa fa-rss"></i>&nbsp; Updates</a>
<a class="list-group-item link-white" href="<?=ADMIN_BASE_PATH?>scan.php" title="sync"><i class="fa fa-cloud-upload"></i>&nbsp; Bulk Dir Upload</a> 
<a class="list-group-item link-white" href="<?= ADMIN_BASE_PATH ?>tag_manager.php"><i class="fa fa-music"></i>&nbsp; Mp3 Tag Manager</a>
<a class="list-group-item link-white" href="<?= ADMIN_BASE_PATH ?>media-manager"><i class="fa fa-music"></i>&nbsp; Media Manager</a>
<a class="list-group-item link-white" href="<?= ADMIN_BASE_PATH ?>manage/homegroup.php"><i class="fa fa-reorder"></i>&nbsp; Home Groups</a>
<a class="list-group-item link-white" href="<?= ADMIN_BASE_PATH ?>advertise.php"><i class="fa fa-usd"></i>&nbsp; Advertisement</a>
<a class="list-group-item link-white" href="<?= ADMIN_BASE_PATH ?>edit_tpl.php"><i class="fa fa-cube"></i>&nbsp; Edit Templates</a>
<a class="list-group-item link-white" href="<?= ADMIN_BASE_PATH ?>site_settings.php"><i class="fa fa-cogs"></i>&nbsp; Site Setting</a>
<a class="list-group-item link-white" href="<?= ADMIN_BASE_PATH ?>settings.php"><i class="fa fa-lock"></i>&nbsp; Security Setting</a>
<a class="list-group-item link-white" href="#" onclick="myAjax2()"><i class="fa fa-wrench"></i>&nbsp; Recount Files</a>
<a class="list-group-item link-white" href="<?=ADMIN_BASE_PATH?>reset-dl.php"><i class="fa fa-refresh"></i>&nbsp; Reset Weekly DL</a>
<a class="list-group-item link-white" href="#" onclick="myAjax()"><i class="fa fa-unlink"></i>&nbsp; Clean Cache</a>
</div>
<? } ?>
</div>
<div id="page-content-wrapper fixed">
<?php
if($_SESSION['admin_name'] != ''){
?>   
<div class="header">
<form method='get' action='<?= ADMIN_BASE_PATH ?>search.php' class='pull-right form-inline'  style='margin-top:-2px'>
<input id='search' size='18' class="form-control input-sm" type='text' name='search' value="<?=$search?>">
<select name="type" class="form-control input-sm">
<option value='mp3' <?php if($type == 'mp3') echo 'selected'; ?>>mp3</option>
<option value='mp4' <?php if($type == 'mp4') echo 'selected'; ?>>mp4</option>
<option value='3gp' <?php if($type == '3gp') echo 'selected'; ?>>3gp</option>
<option value='zip' <?php if($type == 'zip') echo 'selected'; ?>>zip</option>
<option value='jpg' <?php if($type == 'jpg') echo 'selected'; ?>>jpg</option>
<option value='png' <?php if($type == 'png') echo 'selected'; ?>>png</option>
<option value='gif' <?php if($type == 'gif') echo 'selected'; ?>>gif</option>
<option value='jar' <?php if($type == 'jar') echo 'selected'; ?>>jar</option>
<option value='sis' <?php if($type == 'sis') echo 'selected'; ?>>sis</option>
<option value='sisx' <?php if($type == 'sisx') echo 'selected'; ?>>sisx</option>
<option value='apk' <?php if($type == 'apk') echo 'selected'; ?>>apk</option>
</select>
<input value='Search Files' class="btn btn-info btn-sm" type='submit' name='searchnow'>
</form>
<div class="pull-right" style="margin-right:10px;">
<i class="fa fa-user"></i> Welcome <?=$_SESSION['admin_name']?>, <a href="<?=BASE_PATH?>">
<i class="fa fa-home"></i> Frontend</a> <a href="<?=ADMIN_BASE_PATH?>logout.php"><i class="fa fa-circle-o-notch"></i>  Logout</a>
</div>
</div>
<? } ?>
<div class="page-content">
<div id="main_container">
<div class="row">
<div class="col-md-12">
<?= $CurrentMessage ?>
