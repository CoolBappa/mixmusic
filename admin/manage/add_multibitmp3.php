<?php 
include '../header.php';
$id = $_GET['id'];
$cid = $_GET['cid'];
$page = $_GET['page'];
$chkdup = 'select * from file where id = '.$id;
$a = $db->query($chkdup,  database::GET_ROW);
$c = 'select * from category where id = '.$cid;
$ct = $db->query($c,  database::GET_ROW);
$dest_dir = '../../'.$ct['folder'];
$title = $a['name'].'-320KBPS'.FILEADDNAME.'.mp3';
$name = $dest_dir.$title;
?>

<div class="panel panel-primary width-800">
  <div class="panel-heading">
    
        <h2 class="panel-title">Add Multi Bitrate - "<b><?=str_replace('_',' ',$a['name'])?></b>"</h2>
</div>
  <div class="panel-body">
<form action="add_multibitmp3_process.php" method="post" enctype="multipart/form-data" id="loginform" class="form-horizontal" role="form">
<div class="input-group marginbot-20">
<label class="myCheckbox">320 KBPS <input id="s_fac" type="checkbox" class="sev_check" name="320kbps" value="1"><span></span></label>
<label class="myCheckbox">64 KBPS <input id="s_fac" type="checkbox" class="sev_check" name="64kbps" value="1"><span></span></label>
</div>
            
            <div class="input-group marginbot-20">
                <span class="input-group-addon"><i class="fa fa-globe"></i> &nbsp;Upload from url</span>
                <input type="text" class="form-control" name="url" id="" placeholder="paste url with http://" />
            </div>

            <div class="input-group marginbot-20">
                <b>Or,</b>
            </div>
            <div class="input-group marginbot-20">
              <span class="input-group-btn">
                <span class="btn btn-info btn-file">
                Browse file..<input type="file" name="file"/>
                </span>
               </span>
                <input type="text" class="form-control" placeholder="File to upload.." readonly>
            </div>


            
           <div class="clear marginbot-20"></div>
           <div class="pull-right">
           <input type="hidden" name="id" value="<?= $id ?>" />      
           <input type="hidden" name="cid" value="<?= $cid ?>" />
           <input type="hidden" name="page" value="<?= $page ?>" />
           <button class="btn btn-success" type="submit" name="submit" id="submit" value="Upload File"/><i class="fa fa-arrow-circle-up"></i> Upload File</button> 
           <a href="index.php?pid=<?= $cid ?>" class="btn btn-danger"><i class="fa fa-remove"></i> Cancel</a>
           </div>
    </form>
</div>
</div>
<script>
$(document).ready(function() {
  $('.sev_check').each(function() {
    $(this).addClass('unselected');
  });
  $('.sev_check').on('click', function() {
    $(this).toggleClass('unselected');
    $(this).toggleClass('selected');
    $('.sev_check').not(this).prop('checked', false);
    $('.sev_check').not(this).removeClass('selected');
    $('.sev_check').not(this).addClass('unselected');
  });
});
</script>
<?php include $adminfoldername.'/footer.php'; ?>







