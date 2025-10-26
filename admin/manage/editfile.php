<?php include '../header.php'; ?>
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

?>


 <div class="panel panel-info width-800">
   <div class="panel-heading">
     <h2 class="panel-title"><i class="fa fa-edit fa-2x"></i> Edit Files</h2>
   </div>
  <div class="panel-body">

        <form action="editfile_process.php" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
            <div class="input-group marginbot-20">
              <span class="input-group-addon"><i class="fa fa-file"></i> &nbsp;Filename</span>
              <input type="text" class="form-control" name="name" id="" value="<?=$n['name']?>" />
            </div>

            <?php
            if($n['thumbext'] ==! ''){
            ?>
            <div class="input-group marginbot-20">
              <label><i class="fa fa-user"></i> Thumbnail:</label>
              <img src="<?=$FOLDER?>thumb-<?=$n['dname']?>.<?=$n['thumbext']?>" />
            </div>

            <div class="input-group marginbot-20">
                <span class="input-group-btn">
                <span class="btn btn-info btn-file">
                 Browse new thumb..<input type="file" name="thumb"/>
                </span>
              </span>
                <input type="text" class="form-control" placeholder="Only jpg file.."readonly />
            </div>

            <? }else{ ?>

            <div class="input-group marginbot-20">
                <span class="input-group-btn">
                <span class="btn btn-info btn-file">
                 Browse thumb..<input type="file" name="thumb"/>
                </span>
              </span>
                <input type="text" class="form-control" placeholder="Only jpg file.."readonly />
            </div>

            <? } ?>

            <div class="input-group marginbot-20">
                <span class="input-group-btn">
                <span class="btn btn-info btn-file">
                 Upload New File..<input type="file" name="file"/>
                </span>
              </span>
                <input type="text" class="form-control" readonly />
            </div>

            <div class="input-group marginbot-20">
                <span class="input-group-addon"><i class="fa fa-file-text"></i> &nbsp;Description</span>
                <textarea name="desc"><?=$n['desc']?></textarea>
           </div>

          
            <div class="pull-right">
              <div class="checkbox checkbox-warning checkbox-inline">
                <?php
                if($n['newtag'] == 1)
                echo '<input type="checkbox" checked="checked" id="inlineCheckbox3" name="newtag" value="1" />';
                  else
                echo '<input type="checkbox" id="inlineCheckbox3" name="newtag" value="1" />';
                ?>
                <label for="inlineCheckbox3">Enable New Tag ?</label>
              </div>
            </div>
            
            <div class="clear marginbot-20"></div>
            <div class="pull-right">
               <input type="hidden" name="id" value="<?=$id?>" />
               <input type="hidden" name="cid" value="<?=$cid?>" />
               <input type="submit" class="btn btn-success" name="submit" id="submit" value="Update Now" />
               <a class="btn btn-danger" href="index.php?pid=<?=$cid?>"><i class="fa fa-chevron-left"></i> Back To File</a>
            </div> 
        </form>
     </div>
<?php include $adminfoldername.'/footer.php'; ?>