<?php
include '../header.php';

if ($_GET['name'] == '')
    exit;
    $name = $_GET['name'];
    $id= $_GET['id'];
?>
<div class="panel panel-info width-800">
              <div class="panel-heading">
                <h2 class="panel-title">Rename File</h2>
              </div>
            <div class="panel-body text-center">
  <form method="get" action="bulkupload_rename_process.php" class="basic-grey">
            <div class="input-group marginbot-20">
                <span class="input-group-addon"><i class="fa fa-file"></i> &nbsp;Filename</span>
              <input type="text" class="form-control" name="name" id="" value="<?=$name?>" />
            </div>
            
               <input type="hidden" name="oldname" value="<?=$name?>" />
               <input type="hidden" name="id" value="<?=$id?>" />
               <button type="submit" class="btn btn-success" name="submit" id="submit" value="Rename" />Rename</button>
               <a class="btn btn-info" href="bulkupload.php?id=<?=$id?>">Back to File List</a>
  </form>
 </div>
</div>
<?php include $adminfoldername.'/footer.php'; ?>