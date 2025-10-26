<?php include '../header.php'; ?>
<script src="<#BASE_PATH#>js/validation.js"></script>
<script language="javascript" >
    var compulsory = new Array('name');
    var dispError = new Array('Name !');
</script>
<?php

    $id = $_GET['id'];
    $q = "select * from `thumb_update` where id = ".$_GET['id'];
    $UPDATE = $db->query($q,  database::GET_ROW);

    if ($_GET['page']=='')
     $page=1;
    else
     $page= $_GET['page'];
   
?>

 <div class="panel panel-info width-800">
              <div class="panel-heading">
                <h2 class="panel-title">Edit Update</h2>
              </div>
   <div class="panel-body">
    <form action="editupdate_db.php" method="post" onsubmit="return chkfrm(compulsory,dispError,this)">
             <div class="input-group marginbot-20">
                <span class="input-group-addon"><i class="fa fa-globe"></i> &nbsp;Thumb Link</span>
                <dd><input type="text" class="form-control" value="<?=$UPDATE['thumb']?>" name="thumb" id="" size="70" /></dd>
            </div>
             <div class="input-group marginbot-20">
                <span class="input-group-addon"><i class="fa fa-file"></i> &nbsp;Title</span>
                <textarea name="title" class="form-control" rows="7" cols="70"><?= $UPDATE['title'] ?></textarea>
            </div>
             <div class="input-group marginbot-20">
                <span class="input-group-addon"><i class="fa fa-globe"></i> &nbsp;Link</span>
                <dd><input type="text" class="form-control" value="<?=$UPDATE['link']?>" name="link" id="" size="70" /></dd>
            </div>
            <div class="input-group marginbot-20">
                <span class="input-group-addon"><i class="fa fa-globe"></i> &nbsp;Artist</span>
                <dd><input type="text" class="form-control" value="<?=$UPDATE['artist']?>" name="artist" id="" size="70" /></dd>
            </div>
            <div class="input-group marginbot-20">
                <span class="input-group-addon"><i class="fa fa-globe"></i> &nbsp;Cast</span>
                <dd><input type="text" class="form-control" value="<?=$UPDATE['cast']?>" name="cast" id="" size="70" /></dd>
            </div>
            <div class="pull-right">
            <input type="hidden" name="id" value="<?=$id?>" />
            <input type="hidden" name="page" value="<?=$_GET['page']?>" />
            <button type="submit" class="btn btn-success" name="submit" id="submit" value="Submit Update" />Submit</button>
            <a class="btn btn-primary" href="/admin/thumb-update/index.php?page=<?=$page?>"><i class="fa fa-chevron-left"></i> Back to Update List</a>
            </div>
            <div class="clear"></div>    
    </form>
  </div>
</div>
<?php include $adminfoldername.'/footer.php'; ?>