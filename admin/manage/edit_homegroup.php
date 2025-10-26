<?php include '../header.php'; ?>
<? 
$id = $_GET['id']; 
$q = "select * from homegroup where id = ".$_GET['id'];
$GROUP = $db->query($q,  database::GET_ROW);
?>
<div class="panel panel-info width-800">
<div class="panel-heading">
<h2 class="panel-title"><i class="fa fa-edit fa-2x"></i> Edit Group : <?=$GROUP['name']?></h2>
</div>
<div class="panel-body">
<form class="form-horizontal" method="post" action="edit_homegroup_process.php" onsubmit="return chkfrm(compulsory,dispError,this)" enctype="multipart/form-data">
<div class="input-group marginbot-20">
<span class="input-group-addon">Group Name</span>
<input type="text"  class="form-control" name="name" size="40" id="" value="<?=$GROUP['name']?>">
</div>
<div class="clear marginbot-20"></div>
<input type="hidden" name="id" value="<?=$id?>" />
<input type="submit" name="submit" id="submit" class="btn btn-success" value="Edit Group"/>
</form>
</div>
</div> 
<?php include $adminfoldername.'/footer.php'; ?>